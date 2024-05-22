<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class BasicController extends Controller
{
    public function index(){

        $ad = Ad::first();
        return view('welcome', ['ad' => $ad]);
    }
}
