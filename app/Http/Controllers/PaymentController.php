<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class PaymentController extends Controller
{
    public function index() : View {
        $user_id = Auth::id();
        if(Auth::user()->role > 0){
            $payments = Payment::where('status', 1)->where('user_id', $user_id)->get();            
        }else{
            $payments = Payment::where('status', 1)->get();
        }
        $rooms = Room::where('status', '1')->get();
        $reservations = Reservation::where('status', '1')->orderBy('created_at', 'DESC')->get();
       
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
        $payment_data = DB::connection('mysql')->table('payment as p')
        ->join('reservation as r', 'r.id', '=', 'p.reservation_id')
        ->join('add_ons as ao', 'p.reservation_id', '=', 'ao.reservation_id')
        ->select(
            'r.id',
            'r.room_id',
            'r.total_amount',
            'ao.total_amount as ao_total',
            'p.payment_type',
            'p.reference_number',
            'r.total_amount as r_total',
            DB::raw('(r.total_amount + ao.total_amount) AS total_amount'),
            'ao.service_id'
        )
        ->where('p.id', '=', $payment_id)
        ->get();
        // dd(json_encode($payment_data));
        return view('invoice', ['payment'=> $payment, 'payment_data' => $payment_data]);
    }
    
    public function delete(Request $request){

        $result = Payment::where('id', $request->payment_id)->delete();

        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
}
