<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
class BookController extends Controller
{
    public function create(Request $request){

        $result = Book::create([
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'service_id' => $request->service_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'term' => $request->term,
            'status' => 1,
        ]);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
}
