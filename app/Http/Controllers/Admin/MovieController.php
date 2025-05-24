<?php
namespace App\Http\Controllers\Admin;

use App\Helper\Uploader;
use App\Models\Genre;
use App\Models\Movie;

class MovieController extends BaseController
{

    public function index()
    {

        $rows = Movie::paginate($this->perPage);

        return view("admin.movies.index", compact("rows"));
    }

    public function create()
    {
        $genres = Genre::all();

        return view("admin.movies.create", compact("genres"));
    }

    public function show($id)
    {
        $edit = Movie::find($id);

        $genres = Genre::all();

        return view("admin.movies.create", compact("edit", "genres"));
    }

    public function store()
    {

        $validator = \Validator::make(request()->all(), [
            "name"        => "required",
            "content"     => "required",
            "description" => "required",
            "age_group"   => "required",
            "genre_id"    => "required",
            "is_active"   => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $data = request()->all();

        if (! empty(request()->file("image"))) {

            $image = Uploader::_()->uploadImage(request()->file("image"));

            $data["image"] = $image;
        }

        Movie::create($data);

        return redirect()->route("admin.movies.index");

    }

    public function update($id)
    {

        $validator = \Validator::make(request()->all(), [
            "name"        => "required",
            "content"     => "required",
            "description" => "required",
            "age_group"   => "required",
            "genre_id"    => "required",
            "is_active"   => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $data = request()->all();

        if (! empty(request()->file("image"))) {

            $image = Uploader::_()->uploadImage(request()->file("image"));

            $data["image"] = $image;
        }

        Movie::find($id)->update($data);

        return redirect()->route("admin.movies.index");

    }

    public function remove($id)
    {

        Movie::find($id)->delete();

        return redirect()->route("admin.movies.index");
    }

    public function removeImage($id)
    {

        $item = Movie::find($id);

        Uploader::_()->removeImage($item->image);

        $item->image = "";

        $item->save();

        return redirect()->route("admin.movies.show", [
            "id" => $id,
        ]);
    }

    public function movies()
    {
        return response()->json(Movie::with("genre")->where("is_active", 1)->where("is_offer", 1)->orderByDesc("created_at")->paginate(6));
    }

    public function showMovie($id)
    {
        return response()->json(Movie::with("genre")->where("is_active", 1)->where("id", $id)->paginate(6));
    }

}
