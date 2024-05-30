<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        $user = User::count();
        $users = User::all();

        return view('admin.users', compact('user', 'users'));
    }

    public function client(){
        $client = User::count();
        $clients = User::has('orders')->withCount('orders')->get();


        return view('admin.clients', compact('client', 'clients'));
    }
}
