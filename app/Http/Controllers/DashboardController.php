<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $products = Product::count();
        $orders = Order::count();
        $clients = User::has('orders')->count();
        return view('dashboard', compact('products', 'orders', 'clients'));
    }
}
