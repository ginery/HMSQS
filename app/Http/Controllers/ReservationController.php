<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index() : View {
        return view('reservation');
    }
    public function create(){
        
    }
}
