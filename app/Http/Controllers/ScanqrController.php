<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Payment;
use Illuminate\Support\Facades\Config;
class ScanqrController extends Controller
{
    public function index() : View {
        return view('scanqr');
    }
    public function scanQR(Request $request)  {

        $explode = explode('-', $request->scan_data);
        if($explode[1] == 'RES'){
            // Config::set('app.timezone', 'Asia/Manila');
            $reservation = Reservation::where('id', $explode[2])->get()->first();        
            $date = date('Y-m-d H:i:s');
            if($reservation->checkin_date == NULL){

                if(date('Y-m-d') == date('Y-m-d', strtotime($reservation->reservedate_in))){
              
                    $data = [
                        'checkin_date' => $date,
                    ];
                    $room = [
                        'status' => 0,
                    ];
                 
                    $result = Reservation::where('id', $explode[2])->update($data);
                            Room::where('id', $reservation->room_id)->update($room);
                    if($result){
                        return 1;
                    }else{
                        return 0;
                    }

                } else {
                    return 2;
                }
            }
        }else{
            $this->checkOut($request->scan_data);
        }
    
    }
    public function checkOut($scan_data){
        $explode = explode('-', $scan_data);
        // Config::set('app.timezone', 'Asia/Manila');
        $reservation = Reservation::where('id', $explode[2])->get()->first();        
        $date = date('Y-m-d H:i:s');
        $data = [
            'checkout_date' => $date,
        ];
        $room = [
            'status' => 1,
        ];
        $result = Reservation::where('id', $explode[2])->update($data);
                Room::where('id', $reservation->room_id)->update($room);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }
}
