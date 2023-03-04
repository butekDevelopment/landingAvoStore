<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

function checkEvent()
{
    $dateNow = date('Y-m-d', strtotime(now()));
    $dateSample = date('Y-m-d', strtotime("2021-01-28"));
    $event =  DB::table('event')->get();

    if(count($event) != 0){
        foreach ($event as $key) {
            $idevent = $key->idevent;
            $start_event = $key->start_event;
            $end_event = $key->end_event;
        }
    
        if($dateNow >= $start_event && $dateNow <= $end_event){
            DB::table('event')
                    ->where('idevent', '=', $idevent)
                    ->update([
                        'status' => 1,
                        'update_at' => now()
                    ]);
            return true;
        }else{
            DB::table('event')
                    ->where('idevent', '=', $idevent)
                    ->update([
                        'status' => 0,
                        'update_at' => now()
                    ]);
            return false;
        }
    }else{
        return false;
    }
}
