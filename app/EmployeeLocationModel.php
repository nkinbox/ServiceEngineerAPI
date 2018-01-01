<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLocationModel extends Model
{
    protected $table = "employee_location";
    protected $primaryKey = "Sno";
    public $timestamps = false;
}
