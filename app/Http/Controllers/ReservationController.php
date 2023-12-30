<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Services;
class ReservationController extends Controller
{
    public function index() : View {
        $rooms = Room::where('status', '1')->get();
        $services = Services::all();
        $reservations = Reservation::orderBy('created_at', 'DESC')->get();
        return view('reservation', ['rooms' => $rooms, 'reservations' => $reservations, 'services' => $services]);
    }
    public function create(Request $request){

        $result = Reservation::create([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'pax' => $request->adult,
            'total_amount' => 0,
            'terms' => 3,
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
