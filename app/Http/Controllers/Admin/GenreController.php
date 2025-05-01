<?php
namespace App\Http\Controllers\Admin;

use App\Models\Genre;
 
class GenreController extends BaseController
{

    public function index()
    {

        $rows = Genre::paginate($this->perPage);

        return view("admin.genres.index", compact("rows"));
    }

    public function create()
    {
        return view("admin.genres.create");
    }

    public function show($id)
    {
        $edit = Genre::find($id);

        return view("admin.genres.create", compact("edit"));
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

        Genre::create(request()->all());

        return redirect()->route("admin.genres.index");

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

      
        Genre::find($id)->update(request()->all());

        return redirect()->route("admin.genres.index");

    }

    public function remove($id){
     
        Genre::find($id)->delete();

        return redirect()->route("admin.genres.index");
    }

    
}
