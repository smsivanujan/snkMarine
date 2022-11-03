<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class igm_lanka_do_containers extends Model
{
    use HasFactory;
    protected $fillable = ['igm_id', 'equipment_id', 'seal_no', 'description', 'weight', 'measurement'];
}
