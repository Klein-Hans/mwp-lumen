<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class UserTypes extends Model {

    use SoftDeletes;
    
    protected $fillable = ["name", "level", "description"];

    protected $dates = [];

    public static $rules = [
        "name" => "required",
    ];

    // Relationships

}
