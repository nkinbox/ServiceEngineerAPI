<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SyncData extends Model
{
    protected $table = "syncservice";
    public $timestamp = false;
    protected $primaryKey = "SyncId";
}
