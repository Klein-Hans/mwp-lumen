<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $table;

    public function __construct(News $table)
    {
        $this->table = $table;
    }
    
    // Fetch All Data
    public function getNews()
    {
        $data = $this->get($this->table);
        foreach ($data as $i => $val) 
        {   
            $data[$i]->file = $data[$i]->images()->where('foreign_table', 'news')->get();

            foreach ($data[$i]->file as $key => $value) {
                // $data[$i]->file[$key]->file = base64_encode(Storage::get($data[$i]->file[$key]->image_name));
                $data[$i]->file[$key]->file = "";
                $data[$i]->file[$key]->file_name = $data[$i]->file[$key]->image_name;
            }
        }
        return $this->responseOk($data);
    }

    // Fetch Data by ID
    public function getNewsById($id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data['file'] = $data->images()->where('foreign_table', 'news')->get();
        foreach ($data['file'] as $key => $value) {
            // $data['file'][$key]->file = base64_encode(Storage::get($data['file'][$key]->image_name));
            $data['file'][$key]->file = null;
            $data['file'][$key]->file_name = $data['file'][$key]->image_name;
        }
        return $this->responseOk($data);
    }

    // Add Data
    public function postNews(Request $request)
    {
        $data = new $this->table;
        $data->fill($request->except(['file']));
        $data->save();   
        
        Storage::disk('local')->put(
            $request->input('file')['file_name'],
            base64_decode($request->input('file')['file'])
        );  
        $images = $data->images()->create([
            'foreign_id' => $data->id,
            'foreign_table' => 'news',
            'image_name' => $request->input('file')['file_name'],
            'image_path' => 'news',
            'updated_by' => $request->input('updated_by'),
        ]);
        $images->push();
             
        return $this->responseCreated($data);
    }

    // Update Data
    public function putNews(Request $request, $id)
    {
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->fill($request->except(['file']));
        $file = $data->images()
        ->where('foreign_id', $data->id)
        ->where('foreign_table', 'news')
        ->get();
        // exit;
        
        
        if($request->input('file')['id'] == $file[0]['id']){
            $file[0]['id'] = null;
        }
        
        if($request->input('file')['id'] == 0){
            Storage::disk('local')->put(
                $request->input('file')['file_name'],
                base64_decode($request->input('file')['file'])
            );  
            $images = $data->images()->create([
                'foreign_id' => $data->id,
                'foreign_table' => 'news',
                'image_name' => $request->input('file')['file_name'],
                'image_path' => 'news',
                'updated_by' => $request->input('updated_by'),
            ]);
            $images->push();
            
        }

        if($file[0]['id'] != null){
            $file[0]->delete();
        }

        $data->save();
        // $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }

    // Delete/Archive Data
    public function deleteNews($id)
    {   
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $this->table->destroy($id);
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }

    // Restore Data
    public function restoreNews($id)
    {
        $data = $this->table->onlyTrashed()->find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->restore();
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }
}
