<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Services;

class ServicesController extends Controller
{
    public function index(): View
    {
        $services = Services::where('status', '1')->get();
        return view('services', ['services' => $services]);
    }
    public function create(Request $request)
    {

        $result = Services::create([
            'service_name' => $request->service_name,
            'service_type' => $request->service_type,
            'price' => $request->price,
            'description' => $request->description,
            'status' => 1,
        ]);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete(Request $request)
    {

        $result = Services::where('id', $request->service_id)->delete();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }

    
    public function update(Request $request)
    {
        $data = [
            'service_name' => $request->service_name,
            'service_type' => $request->service_type,
            'price' => $request->price,
            'description' => $request->description,
        ];

        $result = Services::where('id', $request->id)->update($data);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
