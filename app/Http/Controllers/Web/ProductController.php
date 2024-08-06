<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function all()
    {
        $products = Product::all();
        return view("User.home", compact("products"));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view("User.show", compact("product"));
    }
    public function search(Request $request)
    {
        $key = $request->key;
        $products = Product::where("name", "like", "%$key%")->get();
        return view("User.home", compact("products"));
    }
/*
    public function addToCart(Request $request, $id)
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->back()->with("error", "You Must Login First");
        } else {

            $qty = $request->quantity;

            $product = Product::findOrFail($id);
            if (!$product) {
                abort(404);
            } else {

                //
                if ($qty < 1 || $qty > $product->quantity) {
                    return redirect()->back()->with("error", "Quantity must be from 1 to equal the Available");
                } else {
                    //
                    $cart = session()->get("cart");
                    if (!$cart) {
                        //////////////// create cart
                        $cart = [
                            $id => [
                                "Name" => $product->name,
                                "Price" => $product->price,
                                "Image" => $product->image,
                                "Quantity" => $qty,
                            ]
                        ];
                        //////////////// add cart to session
                        session()->put("cart", $cart);
                        return redirect()->back()->with("success", "Product Added to Cart");
                    } else {
                        if (isset($cart[$id])) {
                            $cart[$id]["Quantity"] = $qty;
                            session()->put("cart", $cart);
                            return redirect()->back()->with("success", "Product Added to Cart");
                        }
                        $cart[$id] = [
                            "Name" => $product->name,
                            "Price" => $product->price,
                            "Image" => $product->image,
                            "Quantity" => $qty,
                        ];

                        session()->put("cart", $cart);
                        return redirect()->back()->with("success", "Product Added to Cart");
                    }
                }

            }

        }

    }

    public function myCart()
    {
        $products = session()->get("cart");
        $user = Auth::user();
        if ($user == null) {
            return redirect()->back()->with("error", "You Must Login First");
        } else {
            return view("User.myCart", compact("products", "user"));
        }
    }
*/
    public function makeOrder(Request $request)
    {

        $requiredDate = $request->day;
        $products = session()->get("cart");
        $user = Auth::user()->id;
        $order = Order::create([
            "requireDate" => $requiredDate,
            "user_id" => $user
        ]);
        foreach ($products as $id => $product) {
            OrderDetails::create([
                "order_id" => $order->id,
                "product_id" => $id,
                "quantity" => $product["Quantity"],
                "price" => $product["Price"]
            ]);
            $pro = Product::find($id);
            $pro->update([
                "quantity" => $pro->quantity - $product["Quantity"]
            ]);
        }
        session()->forget("cart");
        return redirect(url(""))->with("success", "Your Orderd submitted Successfully");
    }

}

