<?php

namespace App\Http\Controllers;

use App\Models\Townships;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TownshipsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $table;

    public function __construct(Townships $table)
    {
        $this->table = $table;
    }
    
    // Fetch All Data
    public function getTownships()
    {
        $data = $this->get($this->table);
        return $this->responseOk($data);
    }

    // Fetch Data by ID
    public function getTownshipsById($id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        return $this->responseOk($data);
    }

    // Add Data
    public function postTownships(Request $request)
    {
        $data = $this->table;
        // $data->name = $request->input('name');
        // $data->updated_by = $request->input('updated_by');
        $data->fill($request->all());
        $data->save();
        return $this->responseCreated($data);
    }

    // Update Data
    public function putTownships(Request $request, $id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->fill($request->all());
        $data->save();
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }

    // Delete/Archive Data
    public function deleteTownships($id)
    {   
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data = array( "name" => $data->name );
        $this->table->destroy($id);
        return $this->responseOk($data);
    }

    // Restore Data
    public function restoreTownships($id)
    {
        $data = $this->table->onlyTrashed()->find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->restore();
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }
}
