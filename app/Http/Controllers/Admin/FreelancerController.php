<?php
namespace App\Http\Controllers\Admin;

use App\Helper\Uploader;
use App\Models\Freelancer;
use App\Models\FreelancerLevel;
use App\Models\FreelancerRequest;
use Illuminate\Support\Facades\Validator;

class FreelancerController extends BaseController
{

    public function index()
    {

        $rows = Freelancer::paginate($this->perPage);

        return view("admin.freelancers.index", compact("rows"));
    }

    public function create()
    {
        return view("admin.freelancers.create");
    }

    public function show($id)
    {
        $edit = Freelancer::find($id);

        return view("admin.freelancers.create", compact("edit"));
    }

    public function store()
    {

        $validator = \Validator::make(request()->all(), [
            "first_name" => "required",
            "last_name"  => "required",
            "age"        => "required|numeric",
            "is_active"  => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $data = request()->all();

        if (! empty(request()->file("image"))) {

            $image = Uploader::_()->uploadImage(request()->file("image"));

            $data["avatar"] = $image;
        }

        Freelancer::create($data);

        return redirect()->route("admin.freelancers.index");

    }

    public function update($id)
    {

        $validator = \Validator::make(request()->all(), [
            "first_name" => "required",
            "last_name"  => "required",
            "age"        => "required|numeric",
            "is_active"  => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $data = request()->all();

        if (! empty(request()->file("image"))) {

            $image = Uploader::_()->uploadImage(request()->file("image"));

            $data["avatar"] = $image;
        }

        Freelancer::find($id)->update($data);

        return redirect()->route("admin.freelancers.index");

    }

    public function remove($id)
    {

        Freelancer::find($id)->delete();

        return redirect()->route("admin.freelancers.index");
    }

    public function removeImage($id)
    {

        $item = Freelancer::find($id);

        Uploader::_()->removeImage($item->avatar);

        $item->avatar = "";

        $item->save();

        return redirect()->route("admin.freelancers.show", [
            "id" => $id,
        ]);
    }

    public function freelancers()
    {
        return response()->json(Freelancer::where("is_active", 1)->orderByDesc("created_at")->paginate(6));
    }

    public function showFreelancer($id)
    {
        return response()->json(Freelancer::where("id", $id)->where("is_active", 1)->orderByDesc("created_at")->paginate(50));
    }

    public function level()
    {
        $validator = Validator::make(request()->all(), [
            "first_name"         => "required",
            "last_name"          => "required",
            "level"              => "required",
            "avatar"             => "required",
            "gender"             => "required|in:male,female",
            "school"             => "required",
            "field"              => "required",
            "courses" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error"   => true,
                "data"    => [],
                "message" => $validator->errors()->first(),
            ]);
        }

        $data = request()->all();

        $user = auth()->user();

        $checkUser = FreelancerLevel::where("user_id", $user->id)->exists();

        if ($checkUser) {
            return response()->json([
                "error"   => true,
                "data"    => [],
                "message" => "درخواست شما در حال بررسی می‌باشد",
            ]);
        }

        if (! empty(request()->file("avatar"))) {

            $image = Uploader::_()->uploadImage(request()->file("avatar"));

            $data["avatar"] = $image;

        }

        $data["user_id"] = $user->id;

        $data["courses"] = count(explode(",", $data["courses"]));
        
        $data["level_result"]  = "basic";

        if( ($data["level"] >=1 && $data["level"] <= 3) && $data["courses"] > 3){
            $data["level_result"]  = "junior";
        }

        if($data["level"] >= 3 && $data["level"] <= 6 ){

            $data["level_result"]  = "junior";

            if( $data["courses"] > 3 ){
                $data["level_result"]  = "expert_junior";
            }

        }

        if($data["level"] >= 7 && $data["level"] <= 12 ){

            $data["level_result"]  = "junior";

            if( $data["courses"] > 1  ){
                $data["level_result"]  = "expert_junior";
            }

            if( $data["courses"] > 3 ){
                $data["level_result"]  = "senior";
            }

        }

        $level = FreelancerLevel::create($data);

        return response()->json([
            "error" => false,
            "data"  => [
                $level,
            ],
        ]);

    }

    public function showLevel()
    {

        $user = auth()->user();

        $level = FreelancerLevel::where("user_id", $user->id)->get();

        return response()->json([
            "error" => false,
            "data"  => $level,
        ]);
    }

    public function request()
    {
        $validator = Validator::make(request()->all(), [
            "owner"               => "required",
            "mobile"              => "required",
            "address"             => "required",
            "stack"               => "required",
            "project_file"        => "required",
            "project_name"        => "required",
            "project_description" => "required",
            "freelancer_id"       => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error"   => true,
                "data"    => [],
                "message" => $validator->errors()->first(),
            ]);
        }

        $data = request()->all();

        if (! empty(request()->file("project_file"))) {

            $projectFile = Uploader::_()->uploadImage(request()->file("project_file"));

            $data["project_file"] = $projectFile;

        }


        $request = FreelancerRequest::create($data);

        return response()->json([
            "error" => false,
            "data"  => [
                $request,
            ],
        ]);

    }

}
