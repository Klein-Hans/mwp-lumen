<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Units extends Model
{
    use SoftDeletes;

    protected $fillable = 
    [
        'unit_type_id',
        'project_id',
        'lowest_size',
        'highest_size',
        'lowest_price',
        'highest_price',
        'updated_by',
    ];

    // public function project()
    // {
    //     return $this->belongsTo('App\Models\Projects', 'project_id');
    // }

    public function unitType()
    {
        return $this->belongsTo('App\Models\UnitTypes', 'unit_type_id');
    }
}
