<?php
namespace App\Http\Controllers\Admin;

use App\Helper\Uploader;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends BaseController
{

    public function index()
    {

        $rows = Product::paginate($this->perPage);

        return view("admin.products.index", compact("rows"));
    }

    public function create()
    {
        $product_categories = ProductCategory::all();

        return view("admin.products.create", compact("product_categories"));
    }

    public function show($id)
    {
        $edit = Product::find($id);

        $product_categories = ProductCategory::all();

        return view("admin.products.create", compact("edit", "product_categories"));
    }

    public function store()
    {   

        $validator = \Validator::make(request()->all(), [
            "name" => "required",
            "image" => "required",
            "content" => "required",
            "product_category_id" => "required",
            "description" => "required",
            "price" => "required",
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

        Product::create($data);

        return redirect()->route("admin.products.index");

    }

    public function update($id)
    {   

        $validator = \Validator::make(request()->all(), [
            "name" => "required",
            "price" => "required",         
            "content" => "required",
            "product_category_id" => "required",
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


        Product::find($id)->update($data);

        return redirect()->route("admin.products.index");

    }

    public function remove($id){
     
        Product::find($id)->delete();

        return redirect()->route("admin.products.index");
    }

    public function removeImage($id){
     
        $item = Product::find($id);

        Uploader::_()->removeImage($item->image);

        $item->image = ""; 

        $item->save();

        return redirect()->route("admin.products.show", [
            "id" => $id
        ]);
    }

    public function products()
    {

        $products  = Product::where("is_active", 1)->orderByDesc("created_at");

        if(!empty(request("category_id"))){
            $products->where("product_category_id", request("category_id"));
        }

        return response()->json($products->paginate(request("perPage", 6)));
    }

    public function showProduct($id)
    {
        return response()->json(Product::where("id", $id)->where("is_active", 1)->orderByDesc("created_at")->paginate(50));
    }

}
