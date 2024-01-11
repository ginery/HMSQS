<?php

namespace App\Http\Controllers;

use App\Models\PaymentAccount;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
{
    //
    public function index() : View {
        $paymentAccounts = PaymentAccount::all();

        return view('payment-account', ['paymentAccounts' => $paymentAccounts]);
    }

    public function create(Request $request){
        if ($request->image != null) {
            $image = $request->image;
            $imageName = $image->getClientOriginalName();
            $imagePath = public_path('assets/uploads/payment_account/' . $imageName); 
            $image->move(public_path('assets/uploads/payment_account'), $imageName);
    
            $payload = [
                'account_name'        => $request->account_name,
                'account_holder_name' => $request->account_holder_name,
                'account_number'      => $request->account_number,
                'image'               => $imageName, 
                'status'              => 1,
            ];

        } else {
    
            $payload = [
                'account_name'        => $request->account_name,
                'account_holder_name' => $request->account_holder_name,
                'account_number'      => $request->account_number,
                'image'               => '',
                'status'              => 1,
            ];
        }

        $result = PaymentAccount::create($payload);
     
        if($result){
            echo 1;
        }else{
            echo 0;
        }
        
    }

    public function delete(Request $request){
        $deleted = 0;
        foreach($request->items as $val){
            $res = PaymentAccount::where('id', $val)->delete();
            $deleted += $res ? 1 : 0;
        }

        echo $deleted;
    }
}
