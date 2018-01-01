<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

class Resolution extends Resource
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
            "TakeCompleteDate" => $this->TakeCompleteDate,
            "TakeCompleteStartTime" => $this->TakeCompleteStartTime,
            "TakeCompleteEndTime" => $this->TakeCompleteEndTime,
            "ImageCaptured" => Storage::url($this->ImageCaptured),
            "CallStatus" => $this->CallStatus,
            "CallSolution" => $this->CallSolution,
            "TicketDetail" => new FetchTicket($this->whenLoaded('issuedTicket')),
            "EmployeeDetail" => new EmployeeDetails($this->whenLoaded('employee')),
            "Operation"=>$this->Operation
        ];
    }
}
