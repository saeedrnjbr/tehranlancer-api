<?php
namespace App\Http\Controllers\Admin;

use App\Helper\Uploader;
use App\Models\Slider;
 
class SliderController extends BaseController
{

    public function index()
    {

        $rows = Slider::paginate($this->perPage);

        return view("admin.sliders.index", compact("rows"));
    }

    public function create()
    {
        return view("admin.sliders.create");
    }

    public function show($id)
    {
        $edit = Slider::find($id);

        return view("admin.sliders.create", compact("edit"));
    }

    public function store()
    {   

        $validator = \Validator::make(request()->all(), [
            "name" => "required",
            "image" => "required",
            "link" => "required",
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

        Slider::create($data);

        return redirect()->route("admin.sliders.index");

    }

    public function update($id)
    {   

        $validator = \Validator::make(request()->all(), [
            "name" => "required",
            "link" => "required",
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


        Slider::find($id)->update($data);

        return redirect()->route("admin.sliders.index");

    }

    public function remove($id){
     
        Slider::find($id)->delete();

        return redirect()->route("admin.sliders.index");
    }

    public function removeImage($id){
     
        $item = Slider::find($id);

        Uploader::_()->removeImage($item->image);

        $item->image = ""; 

        $item->save();

        return redirect()->route("admin.sliders.show", [
            "id" => $id
        ]);
    }

    public function sliders()
    {
        return response()->json(Slider::where("is_active", 1)->orderByDesc("created_at")->paginate(6));
    }

}
