<?php

use App\Models\Room;
use App\Models\User;
use App\Models\Services;
use App\Models\Reservation;
use App\Models\Payment;

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

        if ($result) {
            if ($result->status == 0) {
                $return = '<div class="text-xs  bg-gray-600  px-1 rounded-md text-white ml-auto">Pending</div>';
            } else if ($result->status == 1) {
                $return = '<div class="text-xs  bg-green-600  px-1 rounded-md text-white ml-auto">Approved</div>';
            } else if ($result->status == 2) {
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
                $return = '<div class="text-xs  bg-green-600  px-1 rounded-md text-white ml-auto">Paid</div>';
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
