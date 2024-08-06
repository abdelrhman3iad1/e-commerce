<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
    public function all()
    {
        $products = Product::all();
        if ($products == null) {
            return response()->json([
                "Msg" => "There is no Products"
            ], 404);
        } else {
            return ProductResource::collection($products);
        }
    }
    public function show($id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return response()->json([
                "Msg" => "Your Product Doesn't Exist"
            ], 404);
        }
        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            "name" => "required|string|max:255|unique:products,name",
            "description" => "required|string",
            "image" => "image|required|mimes:png,jpg,jpeg",
            "quantity" => "required|integer",
            "price" => "required|numeric",
            "category_id" => "required|exists:categories,id"
        ]);
        if ($Validation->fails()) {
            return response()->json([
                "Errors" => $Validation->errors()
            ], 301);
        } else {
            $request->image = Storage::putFile("Products", $request->image);
            Product::create([
                "name" => $request->name,
                "quantity" => $request->quantity,
                "price" => $request->price,
                "image" => $request->image,
                "description" => $request->description,
                "category_id" => $request->category_id,
            ]);
            return response()->json([
                "Msg" => "Product Added Successfully"
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validations = Validator::make($request->all(), [
            "name" => "required|string|max:255|unique:products,name," . $id,
            "description" => "required|string",
            "price" => "numeric|required",
            "quantity" => "required|integer",
            "image" => "image|mimes:png,jpg,jpeg",
            "category_id" => "required|exists:categories,id"
        ]);

        if ($validations->fails()) {
            return response()->json([
                "Errors" => $validations->errors()
            ], 301);
        } else {
            $product = Product::find($id);
            if ($product == null) {
                return response()->json([
                    "Msg" => "Product don't Exist"
                ], 404);
            }else{
                $imageName = $product->image;
                if($request->has("image")){
                    if($product->image !== null){
                    Storage::delete($product->image);
                    }
                    $imageName = Storage::putFile("Products",$request->image);
                }
                $product->update([
                    "name" => $request->name,
                    "quantity" => $request->quantity,
                    "price" => $request->price,
                    "image" => $imageName,
                    "description" => $request->description,
                    "category_id" => $request->category_id
                ]);

                return response()->json([
                    "Msg" => "Product Updated Successfully",
                    "Product" => new ProductResource($product)
                ],201);
            }
        }
        

    }
    public function delete($id)
    {
        $product = Product::find($id);
        if($product == null){
            return response()->json([
                "Error"=>"Product Not Found"
            ],404);
        }else{
            if($product->image !== null){
                Storage::delete($product->image);
            }
            $product->delete();
            return response()->json([
                "Success"=>"Product deleted successfully"
            ],201);
        }
    }

}
