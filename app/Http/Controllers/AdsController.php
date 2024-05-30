<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class AdsController extends Controller
{
    public function index(){
        $ad = Ad::first();
        return view('admin.ad', compact('ad'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ad_content' => 'required|string|max:255',
        ]);

        $ad = new Ad();
        $ad->ad_content = $validated['ad_content'];
        $ad->save();

        return redirect('/dashboard/ad/')->with('success', 'Ad created successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'ad_content' => 'required|string|max:255',
        ]);

        $ad = Ad::first();
        $ad->ad_content = $request->ad_content;
        $ad->save();

        return redirect('/dashboard/ad')->with('success', 'Ad updated successfully!');
    }

    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->delete();

        return redirect()->back()->with('success', 'Ad deleted successfully');
    }
}
