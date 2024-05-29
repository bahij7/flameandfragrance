<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(){
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Please log in to view your cart.');
        }

       

        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->save();
        }
        
        $cartItems = $cart ? $cart->items : [];

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->price * $item->pivot->quantity;
        }

        return view('pages.cart', compact('cartItems', 'totalPrice'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to add products to your cart.');
        }

        $user = Auth::user();
        $cart = $user->cart()->firstOrCreate([]);

        $product = Product::find($request->input('product_id'));
        $quantity = $request->input('quantity', 1);
        $color = $request->input('color', 'White');

        $cart->items()->attach($product->id, ['quantity' => $quantity, 'color' => $color]);

        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    public function delete($id)
    {

        $user = Auth::user();
        $user->cart->items()->detach($id);
    
        return redirect()->route('cart')->with('success', 'Item removed from cart successfully.');
    }
}
