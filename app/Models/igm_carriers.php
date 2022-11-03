<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class igm_carriers extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id', 'customs_office_code', 'place_of_destination_code',
        'sender_id', 'pan_number', 'receiver_id', 'version_no', 'client_id_shipper'
    ];
}
