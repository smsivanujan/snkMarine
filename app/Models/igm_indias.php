<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class igm_indias extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_of_landing_id', 'sender_id', 'version_no', 'message_id', 'sequence',
        'date1', 'time1', 'pod1', 'imo1', 'call_sign1', 'igm_india_voyage_id', 'line_code',
        'line_pan', 'master_name', 'pod_code', 'last_port1', 'last_port2', 'last_port3',
        'vessel_type1', 'poa', 'cargo_des1', 'date_time', 'light_house', 'igm_india_terminal_id',
        'same_bottom', 'passenger_list', 'ship_stores', 'crew_effect', 'crew_list', 'maritime',
        'vessel_name', 'arrival_date', 'igm_number', 'nationality', 'deleted'
    ];
}
