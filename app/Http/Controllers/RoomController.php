<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    //

    public function create(Request $request){
        Room::create([
            'room_name' => $request->room_name,
            'description' => $request->description,
            'image' => $request->image,
            'status' => 0,
        ]);
    }
}
