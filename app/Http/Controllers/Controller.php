<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Response;
// use Illuminate\Validation\Validator;
use Illuminate\Validation\Factory;
use Validator;

class Controller extends BaseController
{

  public function __construct(Response $response)
  {
    //
  }
  
  public function get($table){
    return $table::where('deleted_at', null)
                  ->orderBy('created_at', 'updated_at')
                  ->get();  
  }

  public function responseOk($data){
    return response()->json($data, Response::HTTP_OK);
  }
  
  public function responseCreated($data){
    return response()->json($data, Response::HTTP_CREATED);
  }

  public function responseError($data){
    return response()->json($data, Response::HTTP_BAD_REQUEST);
  }

  public function validator($data,$rules)
  {
    $validator = Validator::make($data, $rules);
    if ($validator->fails()) 
    {
        return $validator->errors();
    }
    return false;
  }

}
