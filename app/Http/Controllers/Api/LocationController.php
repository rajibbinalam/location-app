<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class LocationController extends Controller
{




    public function sendLocation(Request $request){
        try {
            $location = Location::updateOrCreate([
                'user_id'   => auth()->id(),
            ],[
                'date'      => date('Y-m-d'),
                'latitude'  => $request->latitude,
                'longitude' => $request->longitude,
                'time'      => date('H:i:s'),
                'date_time' => date('Y-m-d H:i:s'),
                'status'    => 1
            ]);

            return response()->json([
                'status'    => 200,
                'message'   => 'Location Send Success',
                'data'      => $location
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'    => 404,
                'message'   => 'Location Send Failed',
                'data'      => null
            ]);
        }
    }





    public function getLocation(Request $request){
        try {
            $users = User::with('location')->whereHas('location')->when($request->filled('user_id'), fn($q)=>$q->where('user_id', $request->user_id))->get();

            return response()->json([
                'status'    => 200,
                'message'   => 'Location get Success',
                'data'      => $users
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'    => 404,
                'message'   => 'Location get Failed',
                'data'      => null
            ]);
        }
    }
}
