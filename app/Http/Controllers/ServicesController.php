<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Services;
class ServicesController extends Controller
{
    public function index() : View {
        $services = Services::where('status', '1')->get();
        return view('services', ['services' => $services]);
    }
    public function create(Request $request){

        $result = Services::create([
            'service_name' => $request->service_name,
            'price' => $request->price,
            'description' => $request->description,
            'status' => 1,
        ]);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
}
