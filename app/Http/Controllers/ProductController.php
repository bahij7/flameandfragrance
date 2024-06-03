<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Pack;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('isPublished', true);
        $sort = $request->query('sort', '');
    
        if ($sort) {
            switch ($sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                
                    break;
            }
        }
    
        $products = $query->get(); 
    
        return view('pages.products', compact('products', 'sort'));
    }

    public function view($slug){
        $product = Product::where('slug', $slug)->firstOrFail();
        $suggestedProducts = Product::where('slug', '!=', $slug)->inRandomOrder()->take(3)->get();
        return view('pages.view', compact('product', 'suggestedProducts'));
    }

    public function create(){
        $packs = Pack::all();
        return view('admin.create', compact('packs'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'oldPrice' => 'nullable|numeric',
            'tag' => 'nullable|string|max:255',
            'pack_id' => 'nullable|integer|exists:packs,id',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:10480',
        ]);

        $baseSlug = Str::slug($request->name);
        do {
            $slug = $baseSlug . '-' . Str::random(8);
        } while (Product::where('slug', $slug)->exists());

        $product = new Product();
        $product->slug = $slug;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->oldPrice = $request->oldPrice;
        $product->price = $request->price;
        $product->tags = $request->tags;
        $product->pack_id = $request->pack_id;

        $filePath = null; 
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move('images', $fileName);
            $filePath = 'images/' . $fileName;
            $product->image = $filePath;
        }
        
        $product->save();

        return redirect()->route('product.show', $product->id)->with('success', 'Product created successfully!');

        
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


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'oldPrice' => 'nullable|numeric',
        'tag' => 'nullable|string|max:255',
        'pack_id' => 'nullable|integer|exists:packs,id',
        'image' => 'nullable|mimes:png,jpg,jpeg|max:10480',
    ]);

    $product = Product::findOrFail($id);

    $product->name = $request->name;
    $product->description = $request->description;
    $product->oldPrice = $request->oldPrice;
    $product->price = $request->price;
    $product->tags = $request->tags;
    $product->pack_id = $request->pack_id;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move('images', $fileName);
        $filePath = 'images/' . $fileName;
        $product->image = $filePath;
    }

    $product->save();

    return redirect()->route('product.index')->with('success', 'Product updated successfully!');
}


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }


    public function publish($id)
    {
        $product = Product::findOrFail($id);

        $product->isPublished = !$product->isPublished;

        $product->save();

        return redirect()->route('product.show', ['id' => $product->id])->with('success', 'Product publish status toggled successfully!');
    }


    public function search(Request $request)
{
    $query = $request->input('query');
    $isPublished = $request->input('isPublished');

    $products = Product::query();

    if ($query) {
        $products->where('name', 'like', "%$query%")
                 ->orWhere('tags', 'like', "%$query%");
    }

    if ($isPublished !== null) {
        $products->where('isPublished', $isPublished);
    }

    $products = $products->get();

    return view('admin.products', compact('products'));
}


}
