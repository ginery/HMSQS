<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Services;
use Illuminate\Support\Facades\File;

class ServicesController extends Controller
{
    public function index(): View
    {
        $services = Services::where('status', '1')->get();
        return view('services', ['services' => $services]);
    }
    public function create(Request $request)
    {
        $image = $request->image;
        $imageName = $image->getClientOriginalName();
        $imagePath = public_path('assets/uploads/service/' . $imageName); 
        $image->move(public_path('assets/uploads/service'), $imageName);
        $result = Services::create([
            'service_name' => $request->service_name,
            'service_type' => $request->service_type,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageName,
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

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $data = Services::where('id', $request->id)->get()->first();
                $file_to_delete = public_path('assets/uploads/service/'.$data->image);
                if (File::exists($file_to_delete)) {
                    File::delete($file_to_delete);
                }

                $image = $request->image;
                $imageName = $image->getClientOriginalName();
                $imagePath = public_path('assets/uploads/service/' . $imageName); 
                $image->move(public_path('assets/uploads/service'), $imageName);
                $data = [
                    'service_name' => $request->service_name,
                    'service_type' => $request->service_type,
                    'price' => $request->price,
                    'image' => $imageName,
                    'description' => $request->description,
                ];
            } else {
                $data = [
                    'service_name' => $request->service_name,
                    'service_type' => $request->service_type,
                    'price' => $request->price,
                    'description' => $request->description,
                ];
            }
        } else {
            $data = [
                'service_name' => $request->service_name,
                'service_type' => $request->service_type,
                'price' => $request->price,
                'description' => $request->description,
            ];
        }

        $result = Services::where('id', $request->id)->update($data);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
