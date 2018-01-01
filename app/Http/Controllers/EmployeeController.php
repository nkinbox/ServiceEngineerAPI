<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeModel;
use App\Http\Resources\EmployeeDetailsCollection;
use Validator;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'CBID' => 'required|max:10',
            'EmpMobNo' => 'required|max:13',
            'Password' => 'required',
            'DeviceId' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->add("success","0"));
        }
        $login = EmployeeModel::where('CBID', $request->CBID)
        ->where('Operation','!=','D')
        ->first();
        $EmployeeAPIid = $login->EmployeeAPIid;
        if(!empty($login) && Hash::check($request->Password, $login->Password)) {
            $login->DeviceId = $request->DeviceId;
            $login->save();
            return response()->json(["success" => 1,"EmployeeAPIid" => $EmployeeAPIid]);
        }
        return response()->json(["success" => 0]);
    }
    public function index()
    {
        $employee = EmployeeModel::where('Synced','=','N')->get();
        return new EmployeeDetailsCollection($employee);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'CBID' => 'required|max:10',
            'Password' => 'required',
            'EmpId' => 'max:10',
            'EmpName' => 'required|max:60',
            'EmpMobNo' => 'required|max:13',
            'EmpEmailId' => 'email|max:60',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->add("success","0"));
        }
        $employee = new EmployeeModel;
        $employee->CBID = $request->CBID;
        $employee->Password = Hash::make($request->Password);
        $employee->EmpId = $request->EmpId;
        $employee->EmpName = $request->EmpName;
        $employee->EmpMobNo = $request->EmpMobNo;
        $employee->EmpEmailId = $request->EmpEmailId;
        $employee->save();
        return response()->json(["success" => 1]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'CBID' => 'required|max:10',
            'Password' => 'required',
            'EmpId' => 'max:10',
            'EmpName' => 'required|max:60',
            'EmpMobNo' => 'required|max:13',
            'EmpEmailId' => 'email|max:60',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->add("success","0"));
        }
        $employee = EmployeeModel::find($id);
        $employee->CBID = $request->CBID;
        $employee->Password = Hash::make($request->Password);
        $employee->SessionId = $request->SessionId;
        $employee->EmpId = $request->EmpId;
        $employee->EmpName = $request->EmpName;
        $employee->EmpMobNo = $request->EmpMobNo;
        $employee->EmpEmailId = $request->EmpEmailId;
        $employee->Synced = 'N';
        $employee->Operation = 'E';
        $employee->save();
        return response()->json(["success" => 1]);
    }

    public function destroy($id)
    {
        $employee = EmployeeModel::find($id);
        $employee->Synced = 'N';
        $employee->Operation = 'D';
        $employee->save();
        return response()->json(["success" => 1]);
    }
}
