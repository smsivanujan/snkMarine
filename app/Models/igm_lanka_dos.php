<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class igm_lanka_dos extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_of_landing_id', 'serial_number', 'client_id_forwarding_agent',
        'client_id_consignee', 'do_expire', 'igm_india_voyage_id', 'date_issue',
        'vendor_id_warhouse', 'port_id_loading', 'package_type', 'number_pkg',
        'number_in_word', 'twft', 'foft', 'foft_over', 'vendor_id_yard', 'deleted'
    ];
}
