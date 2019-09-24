<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    private $rulesRequest = array(
        'email' => 'required|email',
        'password' => 'required'    
    );
}
