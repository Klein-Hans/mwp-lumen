<?php 

namespace App\Models    ;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class UserTypes extends Model {

    use SoftDeletes;
    
    protected $fillable = ["name", "level", "description". "updated_by"];

    protected $dates = [];

    public static $rules = [
        "name" => "required",
    ];

    // Relationships

}
