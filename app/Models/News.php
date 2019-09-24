<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class News extends Model {

    use SoftDeletes;

    protected $dates = [];

    protected $fillable = 
    [
        'name',
        'published_date',
        'published_by',
        'description',
        'updated_by',
    ];

    public static $rules = [
        "name" => "required"
    ];

    public function files()
    {
        return $this->hasOne('App\Models\Files', 'foreign_id');
    }

}
