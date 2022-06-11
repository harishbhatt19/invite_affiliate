<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class InviteController extends Controller
{
    public function index()
    {
        $path = public_path('affiliates.txt');
        $conents_arr = file($path, FILE_IGNORE_NEW_LINES);
        foreach ($conents_arr as $key => $value) {
            $conents_arr[$key]  = rtrim($value, "\r");
            $conents_arr[$key]  = json_decode($conents_arr[$key]);
        }
        usort($conents_arr, function ($a, $b) {
            return $a->affiliate_id - $b->affiliate_id;
        });
        foreach ($conents_arr as $key => $value) {
            $distance = $this->getDistanceFromOffice($value->latitude, $value->longitude);
            if($distance <= 100){
                $conents_arr[$key]->distance = $distance;
            }else{
                unset($conents_arr[$key]);
            }
        }
        return view('invite_list', compact('conents_arr'));
    }

    public function getDistanceFromOffice($lat2, $lon2, $unit = 'K')
    {
        $lat1 = '53.3340285';$lon1 = '-6.2535495'; //GPS coordinates of our Dublin office

        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}
