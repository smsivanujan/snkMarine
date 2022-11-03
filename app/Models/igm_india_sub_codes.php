<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class igm_india_sub_codes extends Model
{
    use HasFactory;
    protected $fillable = ['port_name', 'port_code', 'sub_code'];
}
