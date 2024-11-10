<?php

namespace App\Http\Controllers;


class GlobalController extends Controller{
    function GetComboBoxes(){
        $room_statuse = ['فارغة', 'محجوزة',"غير مؤهلة"];

        $ComboBoxes = array(
            "room_statuse" => $room_statuse,

        );
        return $ComboBoxes;
    }

}
