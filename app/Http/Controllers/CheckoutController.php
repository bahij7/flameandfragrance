<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'required|string',
        ]);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->totalPrice = $this->calculateTotalPrice(); 
        $order->address = $request->address;
        $order->status = 'pending';
        $order->order_number = uniqid();

        $order->save();

        foreach (Auth::user()->cart->items as $item) {
            $order->products()->attach($item->id, [
                'quantity' => $item->pivot->quantity,
                'color' => $item->pivot->color,
            ]);
        }

        Auth::user()->cart->items()->detach();

        return redirect()->route('order.confirmation', ['order' => $order->id]);
    }

    private function calculateTotalPrice()
    {

    }
}
