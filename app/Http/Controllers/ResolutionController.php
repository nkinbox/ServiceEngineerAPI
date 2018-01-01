<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResolutionsModel;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Http\Resources\ResolutionCollection;

class ResolutionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TicketAPIid' => 'required|numeric',
            'EmployeeAPIid' => 'required|numeric',
            'TakeCompleteDate' => 'max:10',
            'TakeCompleteStartTime' => 'max:8',
            'TakeCompleteEndTime' => 'max:8',
            'CallStatus' => 'required|max:45',
            'CallSolution' => 'required|max:250'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->add("success","0"));
        }
        $filename = '';
        if(!empty($request->ImageCaptured)) {
            $filename = $request->TicketAPIid . time() .'.jpg';
            $image = str_replace(' ', '+', $request->ImageCaptured);
            $image = base64_decode($image);
            Storage::put('images/'.$filename, $image);
        }
        $resolution = new ResolutionsModel;
        $resolution->TicketAPIid = $request->TicketAPIid;
        $resolution->EmployeeAPIid = $request->EmployeeAPIid;
        $resolution->TakeCompleteDate = $request->TakeCompleteDate;
        $resolution->TakeCompleteStartTime = $request->TakeCompleteStartTime;
        $resolution->TakeCompleteEndTime = $request->TakeCompleteEndTime;
        $resolution->ImageCaptured = $filename;
        $resolution->CallStatus = $request->CallStatus;
        $resolution->CallSolution = $request->CallSolution;
        $resolution->save();
        return response()->json(["success" => 1]);
    }

    public function index()
    {
        $resolution = ResolutionsModel::where('Synced','=','N')
        ->with('issuedTicket', 'employee')->get();
        //return response()->json($resolution);
        return new ResolutionCollection($resolution);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'TicketAPIid' => 'required|numeric',
            'EmployeeAPIid' => 'required|numeric',
            'TakeCompleteDate' => 'max:10',
            'TakeCompleteStartTime' => 'max:8',
            'TakeCompleteEndTime' => 'max:8',
            'CallStatus' => 'required|max:45',
            'CallSolution' => 'required|max:250'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->add("success","0"));
        }
        $resolution = ResolutionsModel::find($id);
        $resolution->TicketAPIid = $request->TicketAPIid;
        $resolution->EmployeeAPIid = $request->EmployeeAPIid;
        $resolution->TakeCompleteDate = $request->TakeCompleteDate;
        $resolution->TakeCompleteStartTime = $request->TakeCompleteStartTime;
        $resolution->TakeCompleteEndTime = $request->TakeCompleteEndTime;
        $resolution->CallStatus = $request->CallStatus;
        $resolution->Synced = 'N';
        $resolution->Operation = 'E';
        $resolution->CallSolution = $request->CallSolution;
        $resolution->save();
        return response()->json(["success" => 1]);
    }

    public function destroy($id)
    {
        $resolution = ResolutionsModel::find($id);
        $resolution->Synced = 'N';
        $resolution->Operation = 'D';
        $resolution->save();
        return response()->json(["success" => 1]);
    }
}
