<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class EmployeeDetails extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "EmployeeAPIid"=>$this->EmployeeAPIid,
            "CBID"=>$this->CBID,
            "EmpId"=>$this->EmpId,
            "EmpName"=>$this->EmpName,
            "EmpMobNo"=>$this->EmpMobNo,
            "EmpEmailId"=>$this->EmpEmailId,
            "Operation"=>$this->Operation
        ];
    }
}
