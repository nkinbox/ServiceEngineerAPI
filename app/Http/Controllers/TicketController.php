<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketModel;
use App\EmployeeModel;
use App\Http\Resources\FetchTicket;
use App\Http\Resources\FetchTicketCollection;
use Validator;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TicketId' => 'required|max:10',
            'TicketDate' => 'required|date|max:10',
            'TicketTime' => 'required|max:8',
            'ClientName' => 'required|max:60',
            'ClientAddress' => 'required|max:250',
            'ClientLocation' => 'required|max:50',
            'ClientContactNo' => 'max:13',
            'CallCategory' => 'required|max:45',
            'CallSubCategory' => 'max:45',
            'Model' => 'required|max:45',
            'ContactPerson' => 'required|max:45',
            'ContactPersonNo' => 'required|max:13',
            'CBID' => 'required|numeric',
            'CallTransferDateTime' => 'date',
            'CallProblem' => 'required|max:250',          
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->add("success","0"));
        }
        $EmployeeAPIid = EmployeeModel::where('CBID', $request->CBID)->value('EmployeeAPIid');
        $ticket = new TicketModel;
        $ticket->TicketId = $request->TicketId;
        $ticket->TicketDate = $request->TicketDate;
        $ticket->TicketTime = $request->TicketTime;
        $ticket->ClientName = $request->ClientName;
        $ticket->ClientAddress = $request->ClientAddress;
        $ticket->ClientLocation = $request->ClientLocation;
        $ticket->ClientContactNo = $request->ClientContactNo;
        $ticket->CallCategory = $request->CallCategory;
        $ticket->CallSubCategory = $request->CallSubCategory;
        $ticket->Model = $request->Model;
        $ticket->ContactPerson = $request->ContactPerson;
        $ticket->ContactPersonNo = $request->ContactPersonNo;
        $ticket->EmployeeAPIid = $EmployeeAPIid;
        $ticket->CallTransferDateTime = $request->CallTransferDateTime;
        $ticket->CallProblem = $request->CallProblem;
        $ticket->save();
        return response()->json(["success" => 1]);
    }

    public function show($id)
    {
        $tickets = TicketModel::where('EmployeeAPIid',$id)
        ->where('Operation','!=','D')
        ->whereDoesntHave('status', function($query) use ($id){
            $query->where('EmployeeAPIid',$id);
        })->get();
        return new FetchTicketCollection($tickets);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'TicketId' => 'required|max:10',
            'TicketDate' => 'required|date|max:10',
            'TicketTime' => 'required|max:8',
            'ClientName' => 'required|max:60',
            'ClientAddress' => 'required|max:250',
            'ClientLocation' => 'required|max:50',
            'ClientContactNo' => 'max:13',
            'CallCategory' => 'required|max:45',
            'CallSubCategory' => 'max:45',
            'Model' => 'required|max:45',
            'ContactPerson' => 'required|max:45',
            'ContactPersonNo' => 'required|max:13',
            'CBID' => 'required|numeric',
            'CallTransferDateTime' => 'date',
            'CallProblem' => 'required|max:250',          
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->add("success","0"));
        }
        $EmployeeAPIid = EmployeeModel::where('CBID', $request->CBID)->value('EmployeeAPIid');
        $ticket = TicketModel::find($id);
        $ticket->TicketId = $request->TicketId;
        $ticket->TicketDate = $request->TicketDate;
        $ticket->TicketTime = $request->TicketTime;
        $ticket->ClientName = $request->ClientName;
        $ticket->ClientAddress = $request->ClientAddress;
        $ticket->ClientLocation = $request->ClientLocation;
        $ticket->ClientContactNo = $request->ClientContactNo;
        $ticket->CallCategory = $request->CallCategory;
        $ticket->CallSubCategory = $request->CallSubCategory;
        $ticket->Model = $request->Model;
        $ticket->ContactPerson = $request->ContactPerson;
        $ticket->ContactPersonNo = $request->ContactPersonNo;
        $ticket->EmployeeAPIid = $EmployeeAPIid;
        $ticket->CallTransferDateTime = $request->CallTransferDateTime;
        $ticket->Synced = "N";
        $ticket->Operation = "E";
        $ticket->CallProblem = $request->CallProblem;
        $ticket->save();
        return response()->json(["success" => 1]);
    }

    public function destroy($id)
    {
        $ticket = TicketModel::find($id);
        $ticket->Synced = "N";
        $ticket->Operation = "D";
        $ticket->save();
        return response()->json(["success" => 1]);
    }
}
