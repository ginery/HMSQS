<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(): View
    {
        return view('reports');
    }

    public function index1(): View
    {
        return view('reports1');
    }

    public function transactions(Request $request)
    {
        $checkInDate = date("Y-m-d", strtotime(str_replace(",","", $request->start)));
        $checkOutDate = date("Y-m-d", strtotime(str_replace(",","", $request->end)));
        
        $res = Reservation::whereBetween('checkin_date', [$checkInDate, $checkOutDate])
        ->whereBetween('checkout_date', [$checkInDate, $checkOutDate])
        ->where('status', 1)->get();

        foreach ($res as $reservation) {
            if($reservation->user_id){
                $reservation["customer_name"] = getUserName($reservation->user_id);
                $reservation["room_name"] = getRoomName($reservation->room_id);
            }
        }

        $reservationArray = $res->toArray();

        return response()->json(['data' => $reservationArray]);

    }

    public function sales(Request $request)
    {
        $checkInDate = date("Y-m-d", strtotime(str_replace(",","", $request->start)));
        $checkOutDate = date("Y-m-d", strtotime(str_replace(",","", $request->end)));
        
        $res = Payment::whereBetween('created_at', [$checkInDate, $checkOutDate])
        ->where('status', 1)->get();

        $total = 0;
        foreach ($res as $payment) {
            if($payment->user_id){
                $amount = $payment->partial_amount != 0 ? $payment->partial_amount : $payment->total_amount;
                $total += $amount;

                $payment["customer_name"] = getUserName($payment->user_id);
                $payment["payment_id"] = $payment->id;
                $payment["is_add_ons"] = $payment->add_ons_id != 0 ? "YES" : "NO";
                $payment["amount"] = number_format($amount,2);
                $payment["total_amount"] = number_format($total,2);
            }
        }

        $paymentArray = $res->toArray();

        return response()->json(['data' => $paymentArray]);

    }

}
