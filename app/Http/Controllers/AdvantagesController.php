<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advantages;

class AdvantagesController extends Controller
{
    public function index(){
        return view('admin.advantage');
    }

    public function fetch()
    {
        $goodQuality = Advantage::where('id', '1')->first();
        $reasonablePrice = Advantage::where('id', '2')->first();
        $deliveryAllInMorocco = Advantage::where('id', '3')->first();
        $goodService = Advantage::where('id', '4')->first();

        return view('home.index', compact('goodQuality', 'reasonablePrice', 'deliveryAllInMorocco', 'goodService'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'text' => 'required|string',
        ]);

        $advantage = new Advantages();
        $advantage->name = $request->name;
        $advantage->text = $request->text;
        $advantage->save();

        return redirect()->back()->with('success', 'Advantages saved successfully!');
    }


}
