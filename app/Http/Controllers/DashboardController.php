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
        $latestOrders = Order::with('user')->where('status', '!=', 'delivered')->latest()->take(4)->get();
        $sales = Order::with('user')->where('status', 'delivered')->latest()->take(4)->get();
        $revenue = Order::where('status', 'delivered')->sum('totalPrice');

        $topSellingProduct = Product::select('products.*')
        ->join('order_lines', 'products.id', '=', 'order_lines.product_id')
        ->join('orders', 'order_lines.order_id', '=', 'orders.id')
        ->where('orders.status', 'delivered')
        ->groupBy('products.id')
        ->orderByRaw('SUM(order_lines.quantity) DESC')
        ->first();


        return view('dashboard', compact('products', 'orders', 'clients', 'latestOrders', 'sales', 'revenue', 'topSellingProduct'));
    }
}
