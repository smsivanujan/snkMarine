<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class igm_india_terminals extends Model
{
    use HasFactory;
    protected $fillable = ['terminal', 'code', 'port'];
}
