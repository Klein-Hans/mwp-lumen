<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $table;

    private $rulesPost = array(
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'firstname' => 'required',
        'lastname' => 'required'
        // 'user_type' => 'user_type',
    );

    public function __construct(Users $table)
    {
        $this->table = $table;
    }
    
    // Fetch All Data
    public function getUsers()
    {
        $data = $this->get($this->table);
        return $this->responseOk($data);
    }

    // Fetch Data by ID
    public function getUsersById($id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        return $this->responseOk($data);
    }

    public function postUsers(Request $request)
    {
        // $errors = $this->validator($request->all(), $this->rulesPost);
        // if ($errors) 
        // {
        //     return $this->responseError($errors);
        // }

        $data = new $this->table;
        $data->fill($request->all());
        $data->password = Hash::make($request->input('password'));
        $data->save();

        return $this->responseCreated($data);
    }

    // Update Data
    public function putUsers(Request $request, $id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->fill($request->except(['password']));
        if($request->input('password') != null){
            $data->password = Hash::make($request->input('password'));
        }

        $data->save();
        $data = array( "name" => $data->firstname." ".$data->lastname );
        return $this->responseOk($data);
    }

    // Delete/Archive Data
    public function deleteUsers($id)
    {   
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data = array( "name" => $data->firstname." ".$data->lastname );
        $this->table->destroy($id);
        return $this->responseOk($data);
    }

    // Restore Data
    public function restoreUsers($id)
    {
        $data = $this->table->onlyTrashed()->find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->restore();
        $data = array( "name" => $data->firstname." ".$data->lastname );
        return $this->responseOk($data);
    }
}
