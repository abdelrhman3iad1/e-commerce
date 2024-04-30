<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create(){
        $categories = Category::all();
        return view("Admin.create",compact("categories"));
    }

    public function store(Request $request){
        $data = $request->validate([
            "name"=>"required|string|max:255|unique:products,name",
            "description"=>"required|string",
            "image"=>"required|image|mimes:png,jpg,jpeg",
            "price"=>"required|numeric",
            "quantity"=>"required|integer",
            "category_id"=>"required|exists:categories,id"
        ]);
        
        $data['image'] = Storage::putFile("Products",$data['image']);
        
        Product::create($data);

        return redirect(url("products/create"))->with("success","Product Inserted Successfully");
    }

    public function allProducts(){
        $products = Product::all();
        return view("Admin.all",compact("products"));
    }
    public function show($id){
        $product = Product::findOrFail($id);
        return view("Admin.show",compact("product"));
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $categories =Category::all();
        return view("Admin.edit",compact("product","categories"));
    }
    public function update(Request $request,$id){
        $data = $request->validate([
            "name"=>"required|string|max:255|unique:products,name,".$id,
            "description"=>"required|string",
            "price"=>"numeric|required",
            "quantity"=>"required|integer",
            "image"=>"image|mimes:png,jpg,jpeg",
            "category_id"=>"required|exists:categories,id"
        ]);
            $product = Product::findOrFail($id);
            if($request->has('image')){
                    Storage::delete($product->image);
                    $data['image'] = Storage::putFile("Products",$data['image']);
            }
            $product->update($data);

            return redirect(url("products/show/$id"))->with("success","Data Updated Successfully");

    }

    public function delete($id){
        $product = Product::findOrFail($id);
        if($product->image){
        Storage::delete($product->image);
        }
        $product->delete();
        return redirect("products")->with("success","Product Deleted Successfully");
    }
}
