<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
class ReservationController extends Controller
{
    public function index() : View {
        $rooms = Room::where('status', '1')->get();
        $reservations = Reservation::orderBy('created_at', 'DESC')->get();
        return view('reservation', ['rooms' => $rooms, 'reservations' => $reservations]);
    }
    public function create(Request $request){

        $result = Reservation::create([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'checkin_date' => $request->checkin,
            'checkout_date' => $request->checkout,
            'status' => 1,
        ]);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function reserve(Request $request){

    }
}
