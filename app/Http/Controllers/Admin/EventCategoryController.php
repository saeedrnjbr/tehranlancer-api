<?php
namespace App\Http\Controllers\Admin;

use App\Models\EventCategory;
 
class EventCategoryController extends BaseController
{

    public function index()
    {

        $rows = EventCategory::paginate($this->perPage);

        return view("admin.event_categories.index", compact("rows"));
    }

    public function create()
    {
        return view("admin.event_categories.create");
    }

    public function show($id)
    {
        $edit = EventCategory::find($id);

        return view("admin.event_categories.create", compact("edit"));
    }

    public function store()
    {   

        $validator = \Validator::make(request()->all(), [
            "name" => "required",
            "is_active" => "required"
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        EventCategory::create(request()->all());

        return redirect()->route("admin.event_categories.index");

    }

    public function update($id)
    {   

        $validator = \Validator::make(request()->all(), [
            "name" => "required",
            "is_active" => "required"
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        EventCategory::find($id)->update(request()->all());

        return redirect()->route("admin.event_categories.index");

    }

    public function remove($id){
     
        EventCategory::find($id)->delete();

        return redirect()->route("admin.event_categories.index");
    }

    
    public function categories()
    {
        return response()->json(EventCategory::where("is_active", 1)->orderByDesc("created_at")->paginate(10));
    }

}
