<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Services;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
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
        $pax = array($request->adult, $request->child);
        $paxString = implode(', ', $pax);

        $result = Room::create([
            'room_name'     => $request->room_name,
            'room_type'     => $request->room_type,
            'pax'           => $paxString,
            'price'         => $request->price,
            'description'   => $request->description,
            'image'         => $imageName, 
            'status'        => 1,
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

    public function get_services() : View {
        $rooms = Room::all();
        $services = Services::all();
        $amenities = Services::where('service_type', 2)->get();

        return view('book', ['rooms' => $rooms, 'services' => $services, 
        'amenities' => $amenities]);
    }

    public function available_rooms(Request $request){
        // Config::set('app.timezone', 'Asia/Manila');
        $checkInDate = date("Y-m-d", strtotime(str_replace(",","", $request->checkin_date)));
        $checkOutDate = date("Y-m-d", strtotime(str_replace(",","", $request->checkout_date)));
        
        $rooms = DB::connection('mysql')
        ->table('rooms')
        ->whereNotIn('id', function($query) use ($checkInDate, $checkOutDate) {
            $query->select('room_id')
                ->from('reservation')
                ->where(function($query) use ($checkInDate, $checkOutDate) {
                    $query->whereBetween('reservedate_in', [$checkInDate, $checkOutDate])
                          ->orWhereBetween('reservedate_out', [$checkInDate, $checkOutDate]);
                })
                ->where('status', 1);
        })
        ->get();

        echo json_encode($rooms);
    }
}
