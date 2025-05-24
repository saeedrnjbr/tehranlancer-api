<?php
namespace App\Http\Controllers\Admin;

use App\Helper\Uploader;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EventController extends BaseController
{

    public function index()
    {

        $rows = Event::paginate($this->perPage);

        return view("admin.events.index", compact("rows"));
    }

    public function requests()
    {

        $rows = EventRequest::paginate($this->perPage);

        return view("admin.events.requests", compact("rows"));
    }

    public function create()
    {
        $event_categories = EventCategory::all();

        return view("admin.events.create", compact("event_categories"));
    }

    public function show($id)
    {
        $edit = Event::find($id);

        $event_categories = EventCategory::all();

        return view("admin.events.create", compact("edit", "event_categories"));
    }

    public function store()
    {

        $validator = \Validator::make(request()->all(), [
            "name"       => "required",
            "image"      => "required",
            "expired_at" => "required",
            "is_active"  => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        request()->merge(["expired_at" => $this->convert2english(request("expired_at"))]);

        $data = request()->all();

        if (! empty(request()->file("image"))) {

            $image = Uploader::_()->uploadImage(request()->file("image"));

            $data["image"] = $image;
        }

        Event::create($data);

        return redirect()->route("admin.events.index");

    }

    public function update($id)
    {

        $validator = \Validator::make(request()->all(), [
            "name"       => "required",
            "expired_at" => "required",
            "is_active"  => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        request()->merge(["expired_at" => $this->convert2english(request("expired_at"))]);

        $data = request()->all();

        if (! empty(request()->file("image"))) {

            $image = Uploader::_()->uploadImage(request()->file("image"));

            $data["image"] = $image;
        }

        Event::find($id)->update($data);

        return redirect()->route("admin.events.index");

    }

    public function remove($id)
    {

        Event::find($id)->delete();

        return redirect()->route("admin.events.index");
    }

    public function removeImage($id)
    {

        $item = Event::find($id);

        Uploader::_()->removeImage($item->image);

        $item->image = "";

        $item->save();

        return redirect()->route("admin.events.show", [
            "id" => $id,
        ]);
    }

    public function events()
    {
        return response()->json(Event::where("is_active", 1)->orderByDesc("created_at")->paginate(6));
    }

    public function showEvent($id)
    {
        return response()->json(Event::where("is_active", 1)->where("id", $id)->paginate(6));
    }

    public function storeEvent()
    {

        $validator = Validator::make(request()->all(), [
            'first_name'         => 'required',
            'last_name'          => 'required',
            'mobile'             => 'required',
            'alternative_mobile' => 'required',
            'level'              => 'required',
            'event_id'           => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error"   => true,
                "data"    => [],
                "message" => $validator->errors()->first(),
            ]);
        }

        $event = Event::find(request("event_id"));

        if ($event->expired_at < Carbon::now()->getTimestamp()) {
            return response()->json([
                "error"   => true,
                "data"    => [],
                "message" => "کاربر گرامی تاریخ دوره منقضی شده است",
            ]);
        }

        $eventRequest = EventRequest::create(request()->all());

        return response()->json([
            "error" => false,
            "data"  => [$eventRequest],
        ]);

    }
}
