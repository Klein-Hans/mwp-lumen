<?php

namespace App\Http\Controllers;

use App\Models\UserTypes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserTypesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $table;

    public function __construct(UserTypes $table)
    {
        $this->table = $table;
    }
    
    // Fetch All Data
    public function getUserTypes()
    {
        $data = $this->get($this->table);
        return $this->responseOk($data);
    }

    // Fetch Data by ID
    public function getUserTypesById($id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        return $this->responseOk($data);
    }

    // Add Data
    public function postUserTypes(Request $request)
    {
        $data = $this->table;
        var_dump($request->input('name'));  
        $data->fill($request->all());
        $data->save();
        return $this->responseCreated($data);
    }

    // Update Data
    public function putUserTypes(Request $request, $id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->fill($request->all());
        $data->save();
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }

    // Delete/Archive Data
    public function deleteUserTypes($id)
    {   
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data = array( "name" => $data->name );
        $this->table->destroy($id);
        return $this->responseOk($data);
    }

    // Restore Data
    public function restoreUserTypes($id)
    {
        $data = $this->table->onlyTrashed()->find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->restore();
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }
}
