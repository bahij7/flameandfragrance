<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('pages.products', compact('products'));
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        do {
            $slug = Str::random(12);
        } while (Product::where('slug', $slug)->exists());

        $product = new Product();
        $product->slug = $slug;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->oldPrice = $request->oldPrice;
        $product->price = $request->price;
        $product->pack_id = null;
        
        $product->save();

        return redirect()->back()->with('success', 'Product created successfully!');

        
    }

    public function fetch(){
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.show', compact('product'));
    }

}
