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
        $payments = Payment::where('status', '1')->get();
        return view('payment', ['rooms' => $rooms, 'reservations' => $reservations, 'payments' => $payments]);
    }
    public function create(Request $request){

        $result = Payment::create([
            'user_id' => $request->user_id,
            'reservation_id' => $request->reservation_id,
            'payment_type' => $request->payment_type,
            'reference_number' => $request->reference_number,
            'total_amount' => $request->total_amount,
            'status' => 1,
        ]);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function invoice($payment_id) : View {
        $payment = Payment::where('id', $payment_id)->where('status','1')->get()->first();
        $payments = Payment::where('id', $payment_id)->where('status','1')->get(); 
       
        $reservations = [];
        foreach($payments as $pm){
            $reservation =  Reservation::where('id', $pm->reservation_id)->get();
           
            array_push($reservations, $reservation);
           
        }
        // dd(json_encode($reservations[0]));
        return view('invoice', ['payment'=> $payment, 'reservations' => $reservations[0]]);
    }
}
