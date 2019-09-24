<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Facilities extends Model
{
    use SoftDeletes;
    
    protected $fillable = 
    [
        'project_id',
        'name',
        'updated_by',
    ];
}
