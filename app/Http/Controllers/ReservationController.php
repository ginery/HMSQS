<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Services;
use Illuminate\Support\Facades\Config;

class ReservationController extends Controller
{
    public function index(): View
    {
        $rooms = Room::where('status', '1')->get();
        $services = Services::all();
        $reservations = Reservation::orderBy('created_at', 'DESC')->get();
        return view('reservation', ['rooms' => $rooms, 'reservations' => $reservations, 'services' => $services]);
    }
    public function create(Request $request)
    {
        $pax = array($request->adult, $request->child);
        $paxString = implode(', ', $pax);
        $result = Reservation::create([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'pax' => $paxString,
            'total_amount' => $request->total_amount,
            'terms' => 3,
            'status' => 0,
        ]);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }
    public function reserve(Request $request)
    {
        Config::set('app.timezone', 'Asia/Manila');
        $reservation = Reservation::where('id', $request->reservation_id)->get()->first();
        $date = date('Y-m-d H:i:s');
        if ($reservation->checkin_date == NULL || $reservation->checkout_date == NULL) {
            if ($reservation->checkin_date == NULL) {
                $data = [
                    'checkin_date' => $date,
                    // 'status' => 0            
                    // Add more fields as needed
                ];
            } else {
                $data = [
                    'checkout_date' => $date,
                    // 'status' => 1            
                    // Add more fields as needed
                ];
            }
            $result = Reservation::where('id', $request->reservation_id)->update($data);
            $result = Room::where('id', $reservation->room_id)->update($data);
            if ($result) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    public function approve(Request $request)
    {
        $data = [
            'status' => 1,
            // 'status' => 0            
            // Add more fields as needed
        ];
        $result = Reservation::where('id', $request->reservation_id)->update($data);
    }
    public function decline(Request $request)
    {
        $data = [
            'status' => 2,
            // 'status' => 0            
            // Add more fields as needed
        ];
        $result = Reservation::where('id', $request->reservation_id)->update($data);
    }
    public function create_guest(Request $request)
    {
        $pax = array($request->adult, $request->child);
        $paxString = implode(', ', $pax);

        $condition = [
            ['room_id', $request->room_id],
            ['user_id', $request->user_id],
            ['reservedate_in', $request->checkin],
            ['reservedate_out', $request->checkout],
        ];

        $count = Reservation::where($condition)->count();

        if($count === 0){
            $result = Reservation::create([
                'room_id' => $request->room_id,
                'user_id' => $request->user_id,
                'service_id' => $request->service_id,
                'pax' => $paxString,
                'total_amount' => $request->total_amount,
                'terms' => 3,
                'status' => 0,
                'reservedate_in' => $request->checkin,
                'reservedate_out' => $request->checkout
            ]);
            if ($result) {
                return 1;
            } else {
                return 0;
            }
        }else{
            echo 2;
        }
    }
    public function view_details($reservation_id): View
    {
        return view('reservation-details');
    }
}
