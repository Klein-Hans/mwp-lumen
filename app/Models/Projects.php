<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Projects extends Model
{
    use SoftDeletes;

    protected $fillable = 
    [
        'name',
        'project_type',
        'description',
        'address',
        'youtube_url',
        'updated_by',
    ];

    public function location()
    {
        return $this->belongsTo('App\Models\Locations');
    }

    public function unitDetails()
    {
        return $this->hasMany('App\Models\UnitDetails', 'project_id');
    }

    public function facades()
    {
        return $this->hasMany('App\Models\Facades', 'project_id');
    }

    public function amenities()
    {
        return $this->hasMany('App\Models\Amenities', 'project_id');
    }

    public function facilities()
    {
        return $this->hasMany('App\Models\Facilities', 'project_id');
    }

    public function nearbies()
    {
        return $this->hasMany('App\Models\Nearbies', 'project_id');
    }

    public function hlurbs()
    {
        return $this->hasOne('App\Models\Hlurbs', 'project_id');
    }

    public function floorPlans()
    {
        return $this->hasMany('App\Models\FloorPlans', 'project_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Images', 'foreign_id');
    }

    public function brochures()
    {
        return $this->hasOne('App\Models\Brochures', 'project_id');
    }
}
