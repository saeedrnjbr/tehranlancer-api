<?php
namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Lesson;
 
class LessonController extends BaseController
{

    public function index()
    {

        $rows = Lesson::paginate($this->perPage);

        return view("admin.lessons.index", compact("rows"));
    }

    public function create()
    {
        $courses = Course::all();

        return view("admin.lessons.create", compact("courses"));
    }

    public function show($id)
    {
        $edit = Lesson::find($id);

        $courses = Course::all();

        return view("admin.lessons.create", compact("edit", "courses"));
    }

    public function store()
    {   

        $validator = \Validator::make(request()->all(), [
            "name" => "required",
            "is_active" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        Lesson::create(request()->all());

        return redirect()->route("admin.lessons.index");

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

        Lesson::find($id)->update(request()->all());

        return redirect()->route("admin.lessons.index");

    }

    public function remove($id){
     
        Lesson::find($id)->delete();

        return redirect()->route("admin.lessons.index");
    }


    public function showLesson($id)
    {
        return response()->json(Lesson::where("is_active", 1)->where("id", $id)->paginate(6));
    }


    
}
