<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Product;

class BasicController extends Controller
{
    public function index(){

        $ad = Ad::first();
        $products = Product::where('isPublished', true)->take(3)->get();
        $hotProducts = Product::where('tags', 'Hot')->take(3)->get();
        return view('welcome', ["ad" => $ad, "products" => $products, "hotProducts" => $hotProducts]);
    }
}
