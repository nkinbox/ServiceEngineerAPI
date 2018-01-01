<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeModel;
use App\ResolutionsModel;
use App\TicketModel;


class SyncService extends Controller
{
    private $changes;
    public function pending() {
        $count = array();
        $count[0] = EmployeeModel::where('Synced','N')->count();
        $count[1] = ResolutionsModel::where('Synced','N')->count();
        $count[2] = TicketModel::where('Synced','N')->count();
        $this->changes = $count[0] + $count[1] + $count[2];
        return response()->json(["PendingSync"=>$this->changes]);
    }
    public function syncnow($num) {
        $this->pending();
        if($this->changes == $num) {
            $this->sync();
            return response()->json(["success"=>1]);
        }
        return response()->json(["success"=>0,"message"=>"Sync Failed. New Changes Found on Server."]);
    }
    private function sync() {
        EmployeeModel::where('Synced','N')->update(['Synced'=>'Y']);
        ResolutionsModel::where('Synced','N')->update(['Synced'=>'Y']);
        TicketModel::where('Synced','N')->update(['Synced'=>'Y']);
    }

}
