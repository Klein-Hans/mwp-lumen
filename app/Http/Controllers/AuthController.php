<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller 
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;
    private $table;
    protected $jwt;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Users $table, JWTAuth $jwt) 
    {
        $this->table = $table;
        $this->jwt = $jwt;
    }

    public function authenticate(Request $request) 
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'    
        ]);

        $user = $this->table->where('email', $request->input('email'))->first();
        if(!$user) {
            return $this->responseError('Invalid Email');
        }
        
        $check;
        
        if (!( $check = Hash::check($request->input('password'), $user->password)))
        {
            return $this->responseError('Invalid Password');
        }

        $request->password = $user->password;
        // var_dump($request->input('password'));
        // var_dump($user->password);
        // var_dump($request->password = $user->password);
        // exit;

        $token;
        try{
            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'error' => 'Invalid Email or Password'], 
                    401);                
            }
        }
        catch(JWTException $e){
            return response()->json([
                'error' => 'Could not Create Token'], 
                500);                
        }

        return response()->json([
            'token' => $token, 
            'id' => $user->id, 
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
        ],
            200);
    }
}