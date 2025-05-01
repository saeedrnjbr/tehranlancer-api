<?php
namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;
 
class ProductCategoryController extends BaseController
{

    public function index()
    {

        $rows = ProductCategory::paginate($this->perPage);

        return view("admin.product_categories.index", compact("rows"));
    }

    public function create()
    {
        return view("admin.product_categories.create");
    }

    public function show($id)
    {
        $edit = ProductCategory::find($id);

        return view("admin.product_categories.create", compact("edit"));
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

        ProductCategory::create(request()->all());

        return redirect()->route("admin.product_categories.index");

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

        ProductCategory::find($id)->update(request()->all());

        return redirect()->route("admin.product_categories.index");

    }

    public function remove($id){
     
        ProductCategory::find($id)->delete();

        return redirect()->route("admin.product_categories.index");
    }

    
    public function categories()
    {
        return response()->json(ProductCategory::where("is_active", 1)->orderByDesc("created_at")->paginate(50));
    }


    public function showCategory($id)
    {
        return response()->json(ProductCategory::where("id", $id)->where("is_active", 1)->orderByDesc("created_at")->paginate(50));
    }
    
}
