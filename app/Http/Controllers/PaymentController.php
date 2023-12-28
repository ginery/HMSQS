<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Payment;
class PaymentController extends Controller
{
    public function index() : View {
        $rooms = Room::where('status', '1')->get();
        $reservations = Reservation::orderBy('created_at', 'DESC')->get();
        return view('payment', ['rooms' => $rooms, 'reservations' => $reservations]);
    }
    public function create(Request $request){

        $result = Payment::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'total_amount' => $request->description,
            'status' => 1,
        ]);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
}
