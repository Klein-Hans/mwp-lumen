<?php

namespace App\Http\Controllers;

use App\Models\Inquiries;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InquiriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $table;

    public function __construct(Inquiries $table)
    {
        $this->table = $table;
    }
    
    // Fetch All Data
    public function getInquiries()
    {
        $data = $this->get($this->table);
        return $this->responseOk($data);
    }

    // Fetch Data by ID
    public function getInquiriesById($id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        return $this->responseOk($data);
    }

    // Delete/Archive Data
    public function deleteInquiries($id)
    {   
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data = array( "name" => $data->name );
        $this->table->destroy($id);
        return $this->responseOk($data);
    }

    // Restore Data
    public function restoreInquiries($id)
    {
        $data = $this->table->onlyTrashed()->find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->restore();
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }
}
