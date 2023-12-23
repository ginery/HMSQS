<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index() : View {
        $users = User::all();

        return view('users', ['users' => $users]);
    }

    public function create(Request $request){
        // Users::create([
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'email' => $request->email,
        //     'password' => Hash::make('12345'),
        //     'role' => $request->role,
        // ]);
        // echo 1;
        return json_encode($request);
    }
}
