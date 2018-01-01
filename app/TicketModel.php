<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketModel extends Model
{
    protected $table = "tickets";
    protected $primaryKey = "TicketAPIid";
    public $timestamps = false;

    public function status() {
        return $this->hasMany('App\ResolutionsModel', 'TicketAPIid', 'TicketAPIid');
    }
}
