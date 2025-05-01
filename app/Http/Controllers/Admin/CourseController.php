<?php
namespace App\Http\Controllers\Admin;

use App\Helper\Uploader;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Lesson;

class CourseController extends BaseController
{

    public function index()
    {

        $rows = Course::paginate(perPage: $this->perPage);

        return view("admin.courses.index", compact("rows"));
    }

    public function create()
    {
        $categories = CourseCategory::where("parent_id", ">", 0)->get();

        return view("admin.courses.create", compact("categories"));
    }

    public function show($id)
    {
        $edit = Course::find($id);

        $categories = CourseCategory::where("parent_id", ">", 0)->get();

        return view("admin.courses.create", compact("edit", "categories"));
    }

    public function store()
    {   

        $validator = \Validator::make(request()->all(), [
            "name" => "required",
            "image" => "required",
            "course_category_id" => "required",
            "content" => "required",
            "description" => "required",
            "is_active" => "required"
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $data = request()->all();

        if (!empty(request()->file("image"))) {

            $image = Uploader::_()->uploadImage(request()->file("image"));

            $data["image"] = $image ;
        }

        Course::create($data);

        return redirect()->route("admin.courses.index");

    }

    public function update($id)
    {   

        $validator = \Validator::make(request()->all(), [
            "name" => "required",
            "content" => "required",
            "course_category_id" => "required",
            "description" => "required",
            "is_active" => "required"
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $data = request()->all();

        if (!empty(request()->file("image"))) {

            $image = Uploader::_()->uploadImage(request()->file("image"));

            $data["image"] = $image ;
        }


        Course::find($id)->update($data);

        return redirect()->route("admin.courses.index");

    }

    public function remove($id){
     
        Course::find($id)->delete();

        return redirect()->route("admin.courses.index");
    }

    public function removeImage($id){
     
        $item = Course::find($id);

        Uploader::_()->removeImage($item->image);

        $item->image = ""; 

        $item->save();

        return redirect()->route("admin.courses.show", [
            "id" => $id
        ]);
    }

    public function courses()
    {
        return response()->json( Course::where("is_active", 1)->orderByDesc("created_at")->paginate(50));
    }


    public function lessons($id)
    {
        return response()->json( Lesson::where("course_id", $id)->where("is_active", 1)->orderByDesc("created_at")->paginate(50));
    }

        
    public function showCourse($id)
    {
        return response()->json(Course::where("is_active", 1)->where("id", $id)->paginate(6));
    }

}
