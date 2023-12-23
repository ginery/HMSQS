<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
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
