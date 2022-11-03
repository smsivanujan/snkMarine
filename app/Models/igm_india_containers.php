<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class igm_india_containers extends Model
{
    use HasFactory;
    protected $fillable = [
        'igm_id', 'cargo_info_number', 'pod', 'imo', 'vessel', 'voyage', 'line', 'sub_line',
        'equipment_id', 'seal', 'pan', 'type', 'pkgs', 'gross_weight', 'con_code'
    ];
}
