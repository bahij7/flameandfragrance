<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrdersController extends Controller
{

    public function index(){
        $user = Auth()->user();
        $orders = $user->orders()->get();

        return view('pages.orders', compact('orders'));
    }


    public function admin(){
        $order = Order::count();
        $orders = Order::all();

        return view('admin.orders', compact('order', 'orders'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $status = $request->input('status');
        $order = Order::count();

    
        $orders = Order::query();
    
        if ($query) {
            $orders->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('order_number', 'like', "%$query%")
                    ->orWhereHas('user', function ($queryBuilder) use ($query) {
                        $queryBuilder->where('name', 'like', "%$query%");
                    })
                    ->orWhere('address', 'like', "%$query%");
            });
        }
    
        if ($status) {
            $orders->where('status', $status);
        }
    
        $orders = $orders->get();
    
        return view('admin.orders', compact('orders', 'order'));
    }

    public function display($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        if (Auth::check() && $order->user_id !== Auth::user()->id) {
            return redireect()->back();
        }
    
        return view('pages.order', compact('order'));
    }

    public function delete(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        
        if ($request->user()->id !== $order->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this order.');
        }
        
        $order->delete();

        return redirect()->route('order')->with('success', 'Order cancelled successfully.');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order->load('orderLines.product');
    
        return view('admin.order', compact('order'));
    }


    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.status', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('order.show', $order->id)->with('success', 'Order status updated successfully.');
    }


    public function trackOrderPage()
    {
        return view('pages.track');
    }

    public function trackOrder(Request $request)
    {
        $orderNumber = $request->input('order_number');
        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            return redirect()->route('track.order')->with('error', 'The order number is not valid.');
        }

        return view('pages.track', compact('order'));
    }

    
}