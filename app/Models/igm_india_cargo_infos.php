<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class igm_india_cargo_infos extends Model
{
    use HasFactory;
    protected $fillable = [
        'igm_id', 'pod2', 'imo2', 'call_sign2', 'igm_india_voyage_id', 'line_number',
        'bill_of_landing_id', 'pol_code', 'pol_code_sub', 'final_destination',
        'vessel_type2', 'other_cargo', 'local_cargo', 'local_sfc', 'total_packages',
        'pkg_units', 'total_gross', 'gross_units', 'marks_numbers', 'cargo_des2',
        'cargo_class', 'ul_number', 'rail_number', 'rail_operator', 'train_road',
        'pan_number', 'client_id_consignee', 'client_id_notify', 'unit_count', 'shipping_from',
        'remarks'
    ];
}
