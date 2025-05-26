<?php
namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Exports\UserExport;
use App\Helper\Cacher;
use App\Models\OtpCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends BaseController
{
    public function login()
    {
        if (auth()->check()) {
            return redirect()->route("admin.dashboard");
        }
        return view("admin.login");
    }

    public function auth()
    {

        $validator = \Validator::make(request()->all(), [
            "mobile"   => "required",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = User::whereMobile(request("mobile"))->first();

        if (! isset($user->id)) {
            return back()->withErrors(["msg" => __("errors.invalidUser")]);
        }

        if (! $user->is_active) {
            return back()->withErrors(["msg" => __("errors.disabledUser")]);
        }

        if ($user->user_type != UserType::ADMIN->value) {
            return back()->withErrors(["msg" => __("errors.invalidUserRole")]);
        }

        if (! Hash::check(request("password"), $user->password)) {
            return back()->withErrors(["msg" => __("errors.invalidPassword")]);
        }

        auth()->login($user);

        return redirect()->route("admin.dashboard");

    }

    public function index()
    {

        $rows = User::orderByDesc("created_at")->paginate($this->perPage);

        return view("admin.users.index", compact("rows"));
    }

    public function export()
    {
        return Excel::download(new UserExport(request()->all()), 'users-' . time() . '.xlsx');
    }

    public function create()
    {
        return view("admin.users.create");
    }

    public function show($id)
    {
        $edit = User::find($id);

        return view("admin.users.create", compact("edit"));
    }

    public function store()
    {

        $validator = \Validator::make(request()->all(), [
            "mobile"   => "required|iran_mobile|unique:users,mobile,NULL,id,deleted_at,NULL",
            "password" => "required|min:6",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        request()->merge([
            "password" => Hash::make(request("password")),
        ]);

        User::create(request()->all());

        return redirect()->route("admin.users.index");

    }

    public function update($id)
    {

        $validator = \Validator::make(request()->all(), [
            "mobile" => "required|iran_mobile|unique:users,mobile," . $id . ",id,deleted_at,NULL",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        if (! empty(request("password"))) {
            request()->merge([
                "password" => Hash::make(request("password")),
            ]);
        }

        $data = request()->all();

        if (empty(request("password"))) {
            $data = request()->except(["password"]);
        }

        User::find($id)->update($data);

        return redirect()->route("admin.users.index");

    }

    public function remove($id)
    {

        User::find($id)->delete();

        return redirect()->route("admin.users.index");
    }

    public function userAuth()
    {

        request()->merge(["mobile" => $this->convert2english(request("mobile"))]);

        $validator = Validator::make(request()->all(), [
            "mobile" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error"   => true,
                "data"    => [],
                "message" => $validator->errors()->first(),
            ]);
        }

        $user = User::where("mobile", request("mobile"))->first();

        $code = $this->generateNumericOTP();

        if (! isset($user->id)) {

            $newUser = new User();

            $newUser->mobile = request("mobile");

            $newUser->is_active = 1;

            $newUser->coupons = 2;

            $newUser->password = $code;

            $newUser->save();

                $user = $newUser;

            if (! empty(request("referral")) && request("mobile") != request("referral")) {
                User::where("mobile", request("referral"))->increment("coupons", 10);
            }

        }

        $userTried = (int) Cacher::get(request("mobile")) ?? 0;

        if ($userTried > 2) {
            return response()->json([
                "error"   => true,
                "data"    => [],
                "message" => "کاربر گرامی شما تا 5 دقیقه دیگر نمی‌توانید کد ورود دریافت نمایید",
            ]);
        }

        OtpCode::where("user_id", $user->id)->delete();

        $userOtp = new OtpCode();

        $userOtp->code = $code;

        $userOtp->user_id = $user->id;

        $expired = Carbon::now()->addMinutes(3);

        $userOtp->expired_at = $expired->getTimestamp();

        $userOtp->save();

        Cacher::set(request("mobile"), $userTried + 1);

        Cacher::expire(request("mobile"), 60 * 5);

        $user->expired_at = $expired->getTimestamp();

        $data = [
            'username' => 'daneshpazhoh_r',
            'password' => 'g2h3b6',
            'text'     => implode(";", [$code]),
            'to'       => request("mobile"),
            "bodyId"   => 321470,
        ];

        $post_data = http_build_query($data);

        $handle = curl_init('https://rest.payamak-panel.com/api/SendSMS/BaseServiceNumber');

        curl_setopt($handle, CURLOPT_HTTPHEADER, [
            'content-type' => 'application/x-www-form-urlencoded',
        ]);

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);

        curl_exec($handle);

        return response()->json([
            "error" => false,
            "data"  => [
                [
                    "mobile"     => $user->mobile,
                    "expired_at" => $user->expired_at,
                ],
            ],
        ]);

    }

    public function generateNumericOTP()
    {
        return mt_rand(11111, 99999);
    }

    public function userVerify()
    {

        $validator = Validator::make(request()->all(), [
            'code' => 'numeric|required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error"   => true,
                "data"    => [],
                "message" => $validator->errors()->first(),
            ]);
        }

        $otp = OtpCode::with("user")->firstWhere("code", request("code"));

        if (! isset($otp->id)) {
            return response()->json([
                "error"   => true,
                "data"    => [],
                "message" => "کد وارد شده نادرست می‌باشد",
            ]);
        }

        if ($otp->expired_at < Carbon::now()->getTimestamp()) {
            return response()->json([
                "error"   => true,
                "data"    => [],
                "message" => "کد وارد شده منقضی شده است",
            ]);
        }

        $login = auth()->guard("api")->login($otp->user);

        return response()->json([
            "error" => false,
            "data"  => [
                [
                    "token" => $login,
                ],
            ],
        ]);

    }

    public function current()
    {

        $user = auth()->guard("api")->user();

        return response()->json([
            "error" => false,
            "data"  => User::with("freelancer_level")->where("id", $user->id)->get(),
        ]);

    }

    public function userAuthWeb()
    {

        request()->merge(["mobile" => $this->convert2english(request("mobile"))]);

        request()->validate([
            "mobile" => "required",
        ]);

        $user = User::where("mobile", request("mobile"))->first();

        $code = $this->generateNumericOTP();

        if (! isset($user->id)) {

            $newUser = new User();

            $newUser->mobile = request("mobile");

            $newUser->password = $code;

            $newUser->coupons = 2;

            $newUser->is_active = 1;

            $newUser->save();

            $user = $newUser;

            if (! empty(request("referral")) && request("mobile") != request("referral")) {
                User::where("mobile", request("referral"))->increment("coupons", 10);
            }

        }

        $userTried = (int) Cacher::get(request("mobile")) ?? 0;

        if ($userTried > 2) {
            return redirect()->back()->withErrors(['کاربر گرامی شما تا 5 دقیقه دیگر نمی‌توانید کد ورود دریافت نمایید']);
        }

        OtpCode::where("user_id", $user->id)->delete();

        $userOtp = new OtpCode();

        $userOtp->code = $code;

        $userOtp->user_id = $user->id;

        $expired = Carbon::now()->addMinutes(3);

        $userOtp->expired_at = $expired->getTimestamp();

        $userOtp->save();

        Cacher::set(request("mobile"), $userTried + 1);

        Cacher::expire(request("mobile"), 60 * 5);

        $user->expired_at = $expired->getTimestamp();

        return redirect()->back()->with('success', 'ثبت نام شما با موفقیت انجام شد');

    }

    public function userLogin()
    {
        return view("user_login");
    }

}
