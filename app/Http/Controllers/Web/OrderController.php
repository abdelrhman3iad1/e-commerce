<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
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
