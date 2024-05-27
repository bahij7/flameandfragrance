<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index(){
        $products = Product::count();
        return view('dashboard', compact('products'));
    }
}
