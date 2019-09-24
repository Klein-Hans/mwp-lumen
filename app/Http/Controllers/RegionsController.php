<?php

namespace App\Http\Controllers;

use App\Models\Regions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $table;

    public function __construct(Regions $table)
    {
        $this->table = $table;
    }
    
    // Fetch All Data
    public function getRegions()
    {
        $data = $this->get($this->table);
        return $this->responseOk($data);
    }

    // Fetch Data by ID
    public function getRegionsById($id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        return $this->responseOk($data);
    }

    // Add Data
    public function postRegions(Request $request)
    {
        $data = $this->table;
        // $data->name = $request->input('name');
        // $data->updated_by = $request->input('updated_by');
        $data->fill($request->all());
        $data->save();
        return $this->responseCreated($data);
    }

    // Update Data
    public function putRegions(Request $request, $id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->fill($request->all());
        $data->save();
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }

    // Delete/Archive Data
    public function deleteRegions($id)
    {   
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data = array( "name" => $data->name );
        $this->table->destroy($id);
        return $this->responseOk($data);
    }

    // Restore Data
    public function restoreRegions($id)
    {
        $data = $this->table->onlyTrashed()->find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->restore();
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }
}
