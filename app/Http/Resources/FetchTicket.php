<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class FetchTicket extends Resource
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
            "TicketAPIid"=>$this->TicketAPIid,
            "TicketId"=>$this->TicketId,
            "TicketDate"=>$this->TicketDate,
            "TicketTime"=>$this->TicketTime,
            "ClientName"=>$this->ClientName,
            "ClientAddress"=>$this->ClientAddress,
            "ClientLocation"=>$this->ClientLocation,
            "ClientContactNo"=>$this->ClientContactNo,
            "CallCategory"=>$this->CallCategory,
            "CallSubCategory"=>$this->CallSubCategory,
            "Model"=>$this->Model,
            "ContactPerson"=>$this->ContactPerson,
            "ContactPersonNo"=>$this->ContactPersonNo,
            "CallTransferDateTime"=>$this->CallTransferDateTime,
            "CallProblem"=>$this->CallProblem,
            "Operation"=>$this->Operation
        ];
    }
}
