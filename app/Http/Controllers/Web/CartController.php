<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
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
}
