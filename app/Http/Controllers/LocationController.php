<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeLocationModel;
use App\Http\Resources\LocationResourceCollection;

class LocationController extends Controller
{
    public function index($id) {
        $location = EmployeeLocationModel::where('EmployeeAPIid', $id)->orderBy('Sno','desc')->paginate(20);
        return new LocationResourceCollection($location);
    }
    public function store(Request $request, $id) {
        $location = new EmployeeLocationModel;
        $location->EmployeeAPIid = $id;
        $location->TrackDateTime = $request->TrackDateTime;
        $location->LocationLat = $request->LocationLat;
        $location->LocationLong = $request->LocationLong;
        $location->save();
        return response()->json(["success" => 1]);
    }
}
