<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CitiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $table;

    public function __construct(Cities $table)
    {
        $this->table = $table;
    }
    
    // Fetch All Data
    public function getCities()
    {
        $Cities = $this->table::all();

        foreach($cities as $key => $val){
            $cities[$key]->region = $cities[$key]->regions->name;
            unset($cities[$key]->regions_id);
        }
    
        return $this->responseOk($cities);
    }

    // Fetch Data by ID
    public function getCitiesById($id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        return $this->responseOk($data);
    }

    // Add Data
    public function postCities(Request $request)
    {
        $data = new $this->table;
        $data->fill($request->all());
        $data->save();        
        return $this->responseCreated($data);
    }

    // Update Data
    public function putCities(Request $request, $id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->fill($request->all());
        $data->save();
        // $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }

    // Delete/Archive Data
    public function deleteCities($id)
    {   
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $this->table->destroy($id);
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }

    // Restore Data
    public function restoreCities($id)
    {
        $data = $this->table->onlyTrashed()->find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->restore();
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }
}
