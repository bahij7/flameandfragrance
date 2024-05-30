<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\orderLine;


class CheckoutController extends Controller
{
    public function index(){

        if (Auth::check() && Auth::user()->cart->items->isNotEmpty()) {

            $cartItems = Auth::user()->cart->items;

            return view('pages.checkout', compact('cartItems'));
        } else {

            return redirect()->back()->with('error', 'Please add items to your cart before proceeding to checkout.');
        }
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);
    
        $user = Auth::user();
    
        $cartItems = $user->cart->items;
    
        $totalOrderPrice = 0;
    
        do {
            $orderNumber = 'ON' . strtoupper(Str::random(6));
        } while (Order::where('order_number', $orderNumber)->exists());
    
        $order = new Order();
        $order->user_id = $user->id;
        $order->order_number = $orderNumber;
        $order->phone = $request->phone;
        $order->address = $request->address;
    
        $order->save();
    
        foreach ($cartItems as $item) {
            $totalProductPrice = $item->price * $item->pivot->quantity;
    
            $totalOrderPrice += $totalProductPrice;
    
            $orderLine = new OrderLine();
            $orderLine->order_id = $order->id;
            $orderLine->product_id = $item->id;
            $orderLine->quantity = $item->pivot->quantity;
            $orderLine->price = $item->price;
            $orderLine->color = $item->pivot->color;
            $orderLine->total_price = $totalProductPrice;
    
            $orderLine->save();
            
        }
    
        $order->totalPrice = $totalOrderPrice;
        $order->save();
    
        $user->cart->items()->detach();
    
        return redirect()->route('product')->with('success', 'Your order has been confirmed.');
    }

    public function confirmed() {

        return view('pages.confirm');
    }
    
    
}