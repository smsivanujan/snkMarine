<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class igm_containers extends Model
{
    use HasFactory;
    protected $fillable = ['igm_id', 'bill_of_landing_id', 'no_of_packages', 'type_of_container', 'empty_Full', 'deleted'];
}
