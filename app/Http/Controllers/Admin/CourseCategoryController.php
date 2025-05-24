<?php
namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\CourseCategory;

class CourseCategoryController extends BaseController
{

    public function buildTree($elements, $parentId = 0, $childName = 'children')
    {
        $categories = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id'], $childName);
                if ($children) {
                    $element[$childName] = $children;
                }
                $categories[$element['id']] = $element;
                unset($elements[$element['id']]);
            }
        }
        usort($categories, function ($a, $b) {
            return $a["id"] > $b["id"];
        });
        return $categories;
    }

    public function index()
    {

        $rows = CourseCategory::paginate($this->perPage);

        return view("admin.course_categories.index", compact("rows"));
    }

    public function create()
    {
        $categories = CourseCategory::all();

        return view("admin.course_categories.create", compact("categories"));
    }

    public function show($id)
    {

        $categories = CourseCategory::whereNot("id", $id)->get();

        $edit = CourseCategory::find($id);

        return view("admin.course_categories.create", compact("edit", "categories"));
    }

    public function store()
    {

        $validator = \Validator::make(request()->all(), [
            "name"      => "required",
            "is_active" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $data = request()->all();

        if (empty($data["parent_id"])) {
            $data["parent_id"] = 0;
        }

        CourseCategory::create($data);

        return redirect()->route("admin.course_categories.index");

    }

    public function update($id)
    {

        $validator = \Validator::make(request()->all(), [
            "name"      => "required",
            "is_active" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $data = request()->all();

        if (empty($data["parent_id"])) {
            $data["parent_id"] = 0;
        }

        CourseCategory::find($id)->update($data);

        return redirect()->route("admin.course_categories.index");

    }

    public function remove($id)
    {

        CourseCategory::find($id)->delete();

        return redirect()->route("admin.course_categories.index");
    }

    public function categories()
    {
        return response()->json(CourseCategory::where("is_active", 1)->orderByDesc("created_at")->paginate(10));
    }

    public function tree($id = 0)
    {
        return response()->json(CourseCategory::where("parent_id", $id)->where("is_active", 1)->orderByDesc("created_at")->paginate(50));
    }

    public function showCourseCategory($id)
    {
        return response()->json(CourseCategory::where("is_active", 1)->where("id", $id)->paginate(6));
    }

    public function showCourses($id)
    {
        return response()->json(Course::where("course_category_id", $id)->where("is_active", 1)->paginate(6));
    }
}
