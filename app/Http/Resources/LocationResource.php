<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class LocationResource extends Resource
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
            "TrackDateTime"=> $this->TrackDateTime,
            "LocationLat"=> $this->LocationLat,
            "LocationLong"=> $this->LocationLong,
        ];
    }
}
