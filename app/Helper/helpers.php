<?php
if (!function_exists('getRole')) {
    function getRole($role) {
        if($role == 0){
            return "Administrator";
        }else{
            return "Customer";
        }
    }
}
?>