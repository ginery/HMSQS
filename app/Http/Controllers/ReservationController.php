<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Services;
use App\Models\Payment;
use App\Models\AddOns;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
class ReservationController extends Controller
{
    public function index(): View
    {
        $user_id = Auth::id();
        if(Auth::user()->role > 0){
            $reservations = Reservation::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        }else{
            $reservations = Reservation::orderBy('created_at', 'DESC')->get();
        }
        $rooms = Room::where('status', 1)->get();
        $services = Services::all();
        
        if(Auth::user()->role != 2){
            $reservations = Reservation::orderBy('created_at', 'DESC')->get();
        }else{
            $reservations = Reservation::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        }
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
        $reservation = Reservation::where('id',$reservation_id)->get()->first();
        $reservations = Reservation::where('id',$reservation_id)->get();
        $payment = Payment::where('id',$reservation_id)->get()->first();
        $add_ons = AddOns::where('reservation_id',$reservation_id)->get();
        $services = Services::all();
        return view('reservation-details', ['reservation' => $reservation, 'payment' => $payment, 'services' => $services, 'reservations' => $reservations, 'add_ons' => $add_ons]);
    }
    public function add_ons(Request $request){
        $service = Services::where('id',$request->service_id)->get()->first();
        $result = AddOns::create([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'reservation_id' => $request->reservation_id,
            'total_amount' => $service->price,
            'status' => 0,
        ]);
        // if ($result) {
        //     return 1;
        // } else {
        //     return 0;
        // }
       return $result;
    }

    public function delete(Request $request){
        $res = Reservation::where('id', $request->reservation_id)->delete();
        echo $res ? 1 : 0;
    }

    public function update(Request $request)
    {
        $pax = array($request->adult, $request->child);
        $paxString = implode(', ', $pax);
        $data = [
            'room_id' => $request->room_id,
            'service_id' => $request->service_id,
            'pax' => $paxString,
            'total_amount' => $request->total_amount,
        ];
        
        $result = Reservation::where('id', $request->id)->update($data);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }
    public function view_add_ons($reservation_id) : View {
        $services = Services::all();

        return view('add-ons', ['services' => $services]);
    }
    public function add_ons_insert(Request $request){
        return $request->service_id;
    }
}
