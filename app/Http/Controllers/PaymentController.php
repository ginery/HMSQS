<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Payment;
use App\Models\Services;
use App\Models\AddOns;
use App\Models\PaymentAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class PaymentController extends Controller
{
    public function index() : View {
        $user_id = Auth::id();
        if(Auth::user()->role > 0){
            $payments = Payment::where('user_id', $user_id)->get();  

            // $add_ons = DB::connection('mysql')->table('add_ons')
            // ->leftJoin('payment', 'add_ons.id', '=', 'payment.add_ons_id')
            // ->where('add_ons.user_id', $user_id)
            // ->whereNull('payment.add_ons_id')->orWhere('payment.status', 2)
            // ->select('add_ons.*')
            // ->get();

            $add_ons = DB::connection('mysql')->table('add_ons')
            ->leftJoin('payment', function($join) {
                $join->on('add_ons.id', '=', 'payment.add_ons_id')
                     ->where('payment.id', function($query) {
                         $query->select(DB::raw('MAX(id)'))
                               ->from('payment')
                               ->whereColumn('add_ons.id', 'payment.add_ons_id');
                     });
            })
            ->where('add_ons.user_id', $user_id)
            ->where(function($query) {
                $query->whereNull('payment.add_ons_id')
                      ->orWhere('payment.status', 2);
            })
            ->select('add_ons.*')
            ->get();

            // $reservations = DB::connection('mysql')->table('reservation')
            // ->leftJoin('payment', 'reservation.id', '=', 'payment.reservation_id')
            // ->where('reservation.user_id', $user_id)
            // ->whereNull('payment.reservation_id')
            // ->select('reservation.*')
            // ->get();

            $reservations = DB::connection('mysql')->table('reservation')
            ->leftJoin('payment', function($join) {
                $join->on('reservation.id', '=', 'payment.reservation_id')
                     ->where('payment.id', function($query) {
                         $query->select(DB::raw('MAX(id)'))
                               ->from('payment')
                               ->whereColumn('reservation.id', 'payment.reservation_id');
                     });
            })
            ->where('reservation.user_id', $user_id)
            ->where(function($query) {
                $query->whereNull('payment.reservation_id')
                      ->orWhere('payment.status', 2);
            })
            ->select('reservation.*')
            ->get();

        }else{
            $payments = Payment::all();
            $add_ons = DB::connection('mysql')->table('add_ons')->select('add_ons.*')
            ->leftJoin('payment', 'payment.add_ons_id', '=', 'add_ons.id')
            ->whereNull('payment.add_ons_id')
            ->get();
          
            $reservations = DB::connection('mysql')->table('reservation')->select('reservation.*')
            ->leftJoin('payment', 'payment.reservation_id', '=', 'reservation.id')
            ->whereNull('payment.reservation_id')
            ->get();
        }
        $rooms = Room::where('status', '1')->get();
        $payment_method = PaymentAccount::where('status', 1)->get();
        return view('payment', ['rooms' => $rooms, 'reservations' => $reservations, 'payments' => $payments, 'add_ons' => $add_ons, 'payment_method' => $payment_method]);
    }
    public function create(Request $request){
        $image = $request->image;
        $imageName = $image->getClientOriginalName();
        $imagePath = public_path('assets/uploads/payments/' . $imageName); 
        $image->move(public_path('assets/uploads/payments'), $imageName);

        $stats = !$request->partial_amount ? 1 : ( $request->partial_amount == $request->total_amount ? 1 : 2 );

        if($request->partial_amount == $request->total_amount){
            $data = [
                'status' => 1,
            ];
            $result = Payment::where('add_ons_id', $request->add_ons_id)->where('status', 2)->where('reservation_id', $request->reservation_id)->update($data);
        }

        $result = Payment::create([
            'user_id'           => $request->user_id,
            'add_ons_id'        => $request->add_ons_id,
            'reservation_id'    => $request->reservation_id == 0 ? $request->input_reservation_id : $request->reservation_id,
            'payment_type'      => $request->payment_type  == 'Online' ? 'O': $request->payment_type,
            'reference_number'  => $request->reference_number,
            'account'           => $request->payment_account_id,
            'partial_amount'    => $request->partial_amount ? $request->partial_amount : 0,
            'total_amount'      => $request->total_amount,
            'status'            => $stats,
            'image'             => $imageName, 
        ]);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
        // echo  $request->reservation_id == 0 ? $request->input_reservation_id : $request->reservation_id;
    }
    public function invoice($payment_id) : View {
        $payment = Payment::where('id', $payment_id)->get()->first();
        $payments = Payment::where('id', $payment_id)->get(); 
       
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
            'ao.qty as qty',
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
    public function approve(Request $request)
    {
        $data = [
            'status' => 1,
        ];
        $result = Payment::where('id', $request->payment_id)->update($data);
    }
    public function decline(Request $request)
    {
        $data = [
            'status' => 2,
        ];
        $result = Payment::where('id', $request->payment_id)->update($data);
    }
}
