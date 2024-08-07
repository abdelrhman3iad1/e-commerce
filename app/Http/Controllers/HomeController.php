<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirectTo()
    {
        $products = Product::all();
        return view("User.home",compact("products"));
    }
}
