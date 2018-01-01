<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    protected $table = "employee";
    protected $primaryKey = "EmployeeAPIid";
    public $timestamps = false;
}
