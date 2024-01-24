<?php

use App\Models\Room;
use App\Models\User;
use App\Models\Services;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\AddOns;
if (!function_exists('getRole')) {
    function getRole($role)
    {
        if ($role == 0) {
            return "Administrator";
        } else if ($role == 1) {
            return "Staff";
        } else {
            return "Customer";
        }
    }
}
if (!function_exists('getRoomName')) {
    function getRoomName($room_id)
    {
        $rooms = Room::where('id', $room_id)->get()->first();
        return $rooms ? $rooms->room_name : 'N/A';
    }
}
if (!function_exists('getServiceName')) {
    function getServiceName($service_id)
    {
        $service = Services::where('id', $service_id)->get()->first();
        return $service ? $service->service_name : 'N/A';
    }
}
if (!function_exists('getRoomPrice')) {
    function getRoomPrice($room_id)
    {
        $rooms = Room::where('id', $room_id)->get()->first();
        return $rooms ? $rooms->price : 0;
    }
}
if (!function_exists('getServicePrice')) {
    function getServicePrice($service_id)
    {
        $service = Services::where('id', $service_id)->get()->first();
        return $service ? $service->price : 0;
    }
}
if (!function_exists('getRoomImage')) {
    function getRoomImage($room_id)
    {
        $rooms = Room::where('id', $room_id)->get()->first();
        return $rooms ? 'assets/uploads/rooms/' . $rooms->image : 'dist/images/preview-4.jpg';
    }
}
if (!function_exists('getUserName')) {
    function getUserName($user_id)
    {
        $user = User::where('id', $user_id)->get()->first();
        return $user ? $user->first_name . " " . $user->last_name : 'N/A';
    }
}
if (!function_exists('getUserEmail')) {
    function getUserEmail($user_id)
    {
        $user = User::where('id', $user_id)->get()->first();
        return $user ? $user->email : 'N/A';
    }
}
if (!function_exists('getReservationStatus')) {
    function getReservationStatus($reservation_id)
    {
        $result = Reservation::where('id', $reservation_id)->get()->first();
        $overDue = date('Y-m-d', strtotime('+ '.$result->terms.' days', strtotime($result->created_at))) <= date('Y-m-d') ? true : false;
        if ($result) {
            if ($result->status == 0 && !$overDue) {
                $return = '<div class="text-xs  bg-gray-600  px-1 rounded-md text-white ml-auto">Pending</div>';
            } else if ($result->status == 1) {
                $return = '<div class="text-xs  bg-green-600  px-1 rounded-md text-white ml-auto">Approved</div>';
            } else if ($result->status == 2 || $overDue) {
                $return = '<div class="text-xs  bg-theme-6  px-1 rounded-md text-white ml-auto">Declined</div>';
            } else {
                $return = "N/A";
            }
        } else {
            $return = "N/A";
        }


        return $return;
    }
}
if (!function_exists('getPaymentStatus')) {
    function getPaymentStatus($reservation_id)
    {
        $result = Payment::where('reservation_id', $reservation_id)->get()->first();

        if ($result) {
            if ($result->status == 0) {
                $return = '<div class="text-xs  bg-gray-600  px-1 rounded-md text-white ml-auto">Pending</div>';
            } else if ($result->status == 1) {
                $return = '<div class="bg-green-600  px-1 rounded-md text-white ml-auto">Paid<div class="text-white text-xs whitespace-no-wrap"> '.date("F d, Y", strtotime($result->created_at)).'</div></div> ';
            } else if ($result->status == 2) {
                $return = '<div class="text-xs  bg-theme-6  px-1 rounded-md text-white ml-auto">Expired/Canceled</div>';
            } else {
                $return = "N/A";
            }
        } else {
            $return = "N/A";
        }


        return $return;
    }
}
if (!function_exists('getServiceType')) {
    function getServiceType($service_id)
    {
        $result = Services::where('id', $service_id)->get()->first();

        if ($result) {
            if ($result->service_type == 0) {
                $return = '<strong>N/A</strong>';
            } else if ($result->service_type == 1) {
                $return = '<strong>Foods</strong>';
            } else if ($result->service_type == 2) {
                $return = '<strong>Others</strong>';
            } else {
                $return = "N/A";
            }
        } else {
            $return = "N/A";
        }


        return $return;
    }
}
if (!function_exists('getServiceImage')) {
    function getServiceImage($service_id)
    {
        $service = Services::where('id', $service_id)->get()->first();
        return $service ? 'assets/uploads/service/' . $service->image : 'dist/images/preview-4.jpg';
    }
}

if (!function_exists('getPaymentStatus1')) {
    function getPaymentStatus1($reservation_id, $add_ons_id)
    {
        $result = Payment::where('reservation_id', $reservation_id)->where('add_ons_id', $add_ons_id)->get()->first();
       
       
            if ($result) {
                $return = '<div class="text-xs  bg-green-600  px-1 rounded-md text-white ml-auto">Paid</div>';
            } else {
                $return = '<div class="text-xs  bg-theme-6  px-1 rounded-md text-white ml-auto">Unpaid</div>';
            } 
       


        return $return;
    }
}
if (!function_exists('getAddOnsPrice')) {
    function getAddOnsPrice($id)
    {
        $data = AddOns::where('id', $id)->get()->first();
        $dataPayment = Payment::where('add_ons_id', $id)->sum('partial_amount');
        return $data ? ( $dataPayment != 0.00 ? $data->total_amount - $dataPayment : $data->total_amount ) : 0;
    }
}
if (!function_exists('countUnpaid')) {
    function countUnpaid()
    {
        $data = Payment::where('status', 0)->get()->toArray();
        return $data ? count($data) : 0;
    }
}

if (!function_exists('getPaymentStatus2')) {
    function getPaymentStatus2($reservation_id)
    {
        $reservation = Reservation::where('id', $reservation_id)->where('status', 1)->count();
        $add_ons = AddOns::where('reservation_id', $reservation_id)->count();
        $paymentReservation = Payment::where('reservation_id', $reservation_id)->where('add_ons_id', 0)->where('status', 1)->count();
        $paymentAddOns = Payment::where('reservation_id', $reservation_id)->where('add_ons_id', '<>', 0)->where('status', 1)->count();
        $paymentPartialAddOns = Payment::where('reservation_id', $reservation_id)
        ->where('add_ons_id', '<>', 0)
        ->where('status', 1)
        ->where('partial_amount', '<>', 0.00)
        ->count();

        $reservationPayStatus = $reservation - $paymentReservation;
        $addOnsPayStatus = $add_ons == 0 ? 0 : ($paymentPartialAddOns == 0 ? $add_ons - $paymentAddOns : 0);

        $status = $reservationPayStatus == 0 && $addOnsPayStatus == 0 ? 0 : 1;

        return $status;
        // return $reservation."-".$add_ons."-".$paymentReservation."-".$paymentAddOns."-".$paymentPartialAddOns;

    }
}

