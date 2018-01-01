<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResolutionsModel extends Model
{
    protected $table = "resolutions";
    protected $primaryKey = "Sno";
    public $timestamps = false;

    public function issuedTicket() {
        return $this->belongsTo('App\TicketModel', 'TicketAPIid', 'TicketAPIid');
    }
    public function employee() {
        return $this->hasOne('App\EmployeeModel', 'EmployeeAPIid', 'EmployeeAPIid');
    }
}
