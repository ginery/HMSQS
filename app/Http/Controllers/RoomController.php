<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\View\View;
class RoomController extends Controller
{
    //
    public function index() : View {
        $rooms = Room::all();

        return view('rooms', ['rooms' => $rooms]);
    }

    public function create(Request $request){
    
        $image = $request->image;
        $imageName = $image->getClientOriginalName();
        $imagePath = public_path('assets/uploads/rooms/' . $imageName); 
        $image->move(public_path('assets/uploads/rooms'), $imageName);


        $result = Room::create([
            'room_name' => $request->room_name,
            'room_type' => $request->room_type,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageName, 
            'status' => 1,
        ]);
     
        if($result){
            echo 1;
        }else{
            echo 0;
        }
        
    }

    public function delete(Request $request){
        $deleted = 0;
        foreach($request->rooms as $val){
            $res = Room::where('id', $val)->delete();
            $deleted += $res ? 1 : 0;
        }

        echo $deleted;
    }

    public function available_rooms() : View {
        $rooms = Room::where('status', 1)->get();

        return view('available-rooms', ['rooms' => $rooms]);
    }
}
