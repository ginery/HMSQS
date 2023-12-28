<?php
use App\Models\Room;


if (!function_exists('getRole')) {
    function getRole($role) {
        if($role == 0){
            return "Administrator";
        }else{
            return "Customer";
        }
    }
}
if (!function_exists('getRoomName')) {
   
    function getRoomName($room_id) {
        $rooms = Room::where('id', $room_id)->get()->first();
        
       return $rooms ? $rooms->room_name: 'N/A';
    }
}
if (!function_exists('getRoomPrice')) {   
    function getRoomPrice($room_id) {
        $rooms = Room::where('id', $room_id)->get()->first();
       return $rooms ? $rooms->price: 0;
    }
}
if (!function_exists('getRoomImage')) {   
    function getRoomImage($room_id) {
        $rooms = Room::where('id', $room_id)->get()->first();
       return $rooms ? 'assets/uploads/rooms/'.$rooms->image: 'dist/images/preview-4.jpg';
    }
}
?>