<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Events\TripStartedEvent;
use App\Events\TripAcceptedEvent;
use App\Events\TripLocationUpdatedEvent;

class TripController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "origin" => "required",
            "destination" => "required",
            "destination_name" => "required",

        ]);

        return $request->user()->trips()->create($request->only(["origin", "destination", "destination_name"]));
        
    }

    public function show(Trip $trip)
    {
        if ($trip->user->id == auth()->user()->id) {
            return $trip;
        } elseif ($trip->driver && request()->user()->driver) {

            if ($trip->driver->id == auth()->user()->driver->id) {
                return $trip;
            }
        } else {
            return response()->json(['message' => "Can't find your requested trip"], 404);

        }
    }

    public function accept(Request $request, Trip $trip)
    {

        $request->validate([
            "driver_location"=> "required",
        
        ]);

        $trip->update([
            "driver_id"=>$request->user()->id,
            "driver_location"=>$request->driver_location,

        ]);

        $trip->load("driver.user");

        TripAcceptedEvent::dispatch($trip, request()->user());

        return $trip;


    }

    public function start(Request $request, Trip $trip)
    {

       $trip->update([
        "is_started"=>true
       ]);

        $trip->load("driver.user");
        
        TripStartedEvent::dispatch($trip, request()->user());

        return $trip;
        
    }
    public function location(Request $request, Trip $trip)
    {


        $request->validate([
            "driver_location"=> "required",
        
        ]);

       $trip->update([
        "driver_location"=>$request->driver_location,
       ]);

        $trip->load("driver.user");
        TripLocationUpdatedEvent::dispatch($trip, request()->user());
        return $trip;
        
    }

}
