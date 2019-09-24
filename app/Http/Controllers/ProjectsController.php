<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $table;

    public function __construct(Projects $table)
    {
        $this->table = $table;
    }
    
    // Fetch All Data
    public function getProjects()
    {
        $projects = $this->table::all();
        // var_dump($projects);exit;
        foreach ($projects as $i => $val) 
        {   
            $lowest_size = $highest_size = $lowest_price = $highest_price = array(); 
            foreach($projects[$i]->unitDetails as $j => $val){
                array_push($lowest_price, $projects[$i]->unitDetails[$j]->lowest_price);
                array_push($highest_price, $projects[$i]->unitDetails[$j]->highest_price);
                array_push($lowest_size, $projects[$i]->unitDetails[$j]->lowest_size);
                array_push($highest_size, $projects[$i]->unitDetails[$j]->highest_size);
            }
            
            $projects[$i]->lowest_price = min($lowest_price);
            $projects[$i]->highest_price = max($highest_price);
            $projects[$i]->lowest_size = min($lowest_size);
            $projects[$i]->highest_size = max($highest_size);
            
            $projects[$i]->locations = $projects[$i]->address.", ".$projects[$i]->location->city.", ".$projects[$i]->location->regions->name;
            $projects[$i]->city = $projects[$i]->location->city;
            $projects[$i]->region = $projects[$i]->location->regions->name;
            
            // unset($projects[$i]->description);
            unset($projects[$i]->address);
            // unset($projects[$i]->location_id);
            unset($projects[$i]->location);
            unset($projects[$i]->deletedAt);
            unset($projects[$i]->updatedBy);
            unset($projects[$i]->address);
            unset($projects[$i]->unitDetails);
        }
        // exit;
        return $this->responseOk($projects);
    }

    public function getProjectsFiltered($column, $value)
    {
        if($value == "null"){
            $value = null;
        }
        $projects = $this->table::where($column, $value)->get();
        // var_dump($value);
        // var_dump($projects);exit;
        foreach ($projects as $i => $val) 
        {   
            $lowest_size = $highest_size = $lowest_price = $highest_price = array(); 
            foreach($projects[$i]->unitDetails as $j => $val){
                array_push($lowest_price, $projects[$i]->unitDetails[$j]->lowest_price);
                array_push($highest_price, $projects[$i]->unitDetails[$j]->highest_price);
                array_push($lowest_size, $projects[$i]->unitDetails[$j]->lowest_size);
                array_push($highest_size, $projects[$i]->unitDetails[$j]->highest_size);
            }
            
            $projects[$i]->lowest_price = min($lowest_price);
            $projects[$i]->highest_price = max($highest_price);
            $projects[$i]->lowest_size = min($lowest_size);
            $projects[$i]->highest_size = max($highest_size);
            
            $projects[$i]->locations = $projects[$i]->address.", ".$projects[$i]->location->city.", ".$projects[$i]->location->regions->name;
            $projects[$i]->city = $projects[$i]->location->city;
            $projects[$i]->region = $projects[$i]->location->regions->name;
            $projects[$i]->facades_images = $projects[$i]->images()->where('foreign_table', 'facades')->get();

            // if($projects[$i]->facades_images){
            //     foreach ($projects[$i]->facades_images as $key => $value) {
            //         $projects[$i]->facades_images[$key] = (Storage::get($projects[$i]->facades_images[$key]->image_name));
            //     }
            // }

            $projects[$i]->facades_images = $projects[$i]->facades_images[0]->image_name;

            // return $this->$projects;
            // unset($projects[$i]->description);
            unset($projects[$i]->address);
            unset($projects[$i]->location_id);
            unset($projects[$i]->location);
            unset($projects[$i]->deletedAt);
            unset($projects[$i]->updatedBy);
            unset($projects[$i]->unitDetails);
        }
        // exit;
        return $this->responseOk($projects);
    }

    // Fetch Data by ID
    public function getProjectsById($id)
    {
        $project = $this->table::find($id);
        $locations = $project->location;
        $unitDetails = $project->unitDetails;
        $project['facades'] = $project::find($project->id)->facades;
        $project['amenities'] = $project::find($project->id)->amenities;
        $project['facilities'] = $project::find($project->id)->facilities;
        $project['floor_plans'] = $project::find($project->id)->floorPlans;
        $project['hlurb'] = $project::find($project->id)->hlurbs;
        $project['nearbies'] = $project::find($project->id)->nearbies;
        $project['location_images'] = $project->images()->where('foreign_table', 'projects')->get();
        $project['facades_images'] = $project->images()->where('foreign_table', 'facades')->get();
        $project['amenities_images'] = $project->images()->where('foreign_table', 'amenities')->get();
        $project['floor_plans_images'] = $project->images()->where('foreign_table', 'floor_plans')->get();
        $project['brochure'] = $project::find($project->id)->brochures;
        if($project['brochure'] != null){
            // $project['brochure']->file = base64_encode(Storage::get($project['brochures']->name));
            $project['brochure'] = $project['brochures']->name;
        }
        
        foreach ($project['location_images'] as $key => $value) {
            $data = array( 
                "id" => $project['location_images'][$key]->id,
                "name" => $project['location_images'][$key]->image_name,
            );
            $project['location_images'][$key] = $data;
            // $project['location_images'][$key]->image = base64_encode(Storage::get($project['location_images'][$key]->image_name));
        }

        foreach ($project['facades_images'] as $key => $value) {
            $data = array( 
                "id" => $project['facades_images'][$key]->id,
                "name" => $project['facades_images'][$key]->image_name,
            );
            $project['facades_images'][$key] = $data;
            // $project['facades_images'][$key]->image = base64_encode(Storage::get($project['facades_images'][$key]->image_name));
        }

        foreach ($project['amenities_images'] as $key => $value) {
            $data = array( 
                "id" => $project['amenities_images'][$key]->id,
                "name" => $project['amenities_images'][$key]->image_name,
            );
            $project['amenities_images'][$key] = $data;
            // $project['amenities_images'][$key]->image = base64_encode(Storage::get($project['amenities_images'][$key]->image_name));
        }

        foreach ($project['floor_plans_images'] as $key => $value) {
            $data = array( 
                "id" => $project['floor_plans_images'][$key]->id,
                "name" => $project['floor_plans_images'][$key]->image_name,
            );
            $project['floor_plans_images'][$key] = $data;
            // $project['floor_plans_images'][$key]->image = base64_encode(Storage::get($project['floor_plans_images'][$key]->image_name));
        }

        $lowest_price = $highest_price = array(); 
        foreach($project->unitDetails as $j => $val){
            array_push($lowest_price, $project->unitDetails[$j]->lowest_price);
            array_push($highest_price, $project->unitDetails[$j]->highest_price);
        }
        
        $project->lowest_price = min($lowest_price);
        $project->highest_price = max($highest_price);

        if(!$project) return $this->responseError("No record(s) found");
        $project['locations'] = $project->address.", ".$locations->city.", ".$project->location->regions->name;
        $project['city'] = $locations->city;
        $project['region'] = $project->location->regions->name;
        $project['unit_details'] = $unitDetails;
        $project['youtube_url'] = $project->youtube_url;
        
        foreach ($unitDetails as $key => $value) {
            // var_dump($project->unitDetails[$key]->id);
            // if ( ! isset($project['unit_details'][$key]->unit_type_name) ||
            //      ! isset($project['unit_details'][$key]->lowest_size) ||
            //      ! isset($project['unit_details'][$key]->highest_size) ||
            //      ! isset($project['unit_details'][$key]->lowest_price) ||
            //      ! isset($project['unit_details'][$key]->highest_price)) {
            //     $project['unit_details'][$key]->unit_type_name = null;
            //     $project['unit_details'][$key]->lowest_size = null;
            //     $project['unit_details'][$key]->highest_size = null;
            //     $project['unit_details'][$key]->lowest_price = null;
            //     $project['unit_details'][$key]->highest_price = null;
            // }
            $project['unit_details'][$key]->id = $project->unitDetails[$key]->id;
            $project['unit_details'][$key]->unit_type_name = $project->unitDetails[$key]->unitType->name;
            $project['unit_details'][$key]->lowest_size = $project->unitDetails[$key]->lowest_size;
            $project['unit_details'][$key]->highest_size = $project->unitDetails[$key]->highest_size;
            $project['unit_details'][$key]->lowest_price = $project->unitDetails[$key]->lowest_price;
            $project['unit_details'][$key]->highest_price = $project->unitDetails[$key]->highest_price;   
            $project['unit_details'][$key]->model_units = 
                $project->images()
                ->where('foreign_id', $project['id'])
                ->where('foreign_table', $project['unit_details'][$key]->unit_type_id.'model_units')
                ->get();
            $project['unit_details'][$key]->unit_layouts = 
                $project->images()
                ->where('foreign_id', $project['id'])
                ->where('foreign_table', $project['unit_details'][$key]->unit_type_id.'unit_layouts')
                ->get();
            foreach ($project['unit_details'][$key]->model_units as $k => $v) {
                $data = array( 
                    "id" => $project['unit_details'][$key]->model_units[$k]->id,
                    "name" => $project['unit_details'][$key]->model_units[$k]->image_name,
                );
                $project['unit_details'][$key]->model_units[$k] = $data;
            }
    
            foreach ($project['unit_details'][$key]->unit_layouts as $k => $v) {
                $data = array( 
                    "id" => $project['unit_details'][$key]->unit_layouts[$k]->id,
                    "name" => $project['unit_details'][$key]->unit_layouts[$k]->image_name,
                );
                $project['unit_details'][$key]->unit_layouts[$k] = $data;
                // $project['unit_details'][$key]->unit_layouts[$k] = $project['unit_details'][$key]->unit_layouts[$k]->image_name;
            }
        }
        
        unset($project['location_id']); unset($project->location); 
        return $this->responseOk($project);
    }

    // Add Data
    public function postProjects(Request $request)
    {
        $data = new $this->table;
        // return $this->responseOk($request);
        $data->name = $request->input('name');
        $data->project_type = $request->input('project_type');
        $data->description = $request->input('description');
        $data->updated_by = $request->input('updated_by');
        $data->address = $request->input('address');
        $data->youtube_url = $request->input('youtube_url');
        $data->location_id = $request->input('location_id');
        $data->location->region_id = $request->input('region_id');
        // $data->unitDetails->
        $data->save();
        
        foreach($request->input('units') as $key => $val){
            // return $this->responseCreated($request->input('units')[$key]);
            $unitDetails = $data->unitDetails()->create([
                'project_id' => $data->id,
                'unit_type_id' => $request->input('units')[$key]['unit_type'],
                'lowest_price' => $request->input('units')[$key]['lowest_price'],
                'highest_price' => $request->input('units')[$key]['highest_price'],
                'lowest_size' => $request->input('units')[$key]['lowest_size'],
                'highest_size' => $request->input('units')[$key]['highest_size'],
                'updated_by' => $request->input('updated_by'),
            ]);
            $unitDetails->push();

            if(sizeof($request->input('units')[$key]['model_units']) != 0){
                foreach ($request->input('units')[$key]['model_units'] as $k => $v) {
                    Storage::disk('local')->put(
                        $request->input('units')[$key]['model_units'][$k]['name'], 
                        base64_decode($request->input('units')[$key]['model_units'][$k]['image'])
                    );
                    $images = $data->images()->create([
                        'foreign_id' => $data->id,
                        'foreign_table' => $request->input('units')[$key]['unit_type'] . 'model_units',                
                        'image_name' => $request->input('units')[$key]['model_units'][$k]['name'],
                        'image_path' => 'null',
                        'updated_by' => $request->input('updated_by'),
                    ]);
                    $images->push();
                }
            }
            
            if(sizeof($request->input('units')[$key]['unit_layouts']) != 0){
                foreach ($request->input('units')[$key]['unit_layouts'] as $k => $v) {
                    Storage::disk('local')->put(
                        $request->input('units')[$key]['unit_layouts'][$k]['name'], 
                        base64_decode($request->input('units')[$key]['unit_layouts'][$k]['image'])
                    );
                    $images = $data->images()->create([
                        'foreign_id' => $data->id,
                        'foreign_table' => $request->input('units')[$key]['unit_type'] . 'unit_layouts',                
                        'image_name' => $request->input('units')[$key]['unit_layouts'][$k]['name'],
                        'image_path' => 'null',
                        'updated_by' => $request->input('updated_by'),
                    ]);
                    $images->push();
                }
            }
        }

        //amenities
        foreach($request->input('amenities') as $key => $val){
            $amenities = $data->amenities()->create([
                'project_id' => $data->id,
                'name' => $request->input('amenities')[$key]['value'],
                'updated_by' => $request->input('updated_by'),
            ]);
            $amenities->push();
        }

        
        //facilities
        foreach($request->input('facilities') as $key => $val){
            $facilities = $data->facilities()->create([
                'project_id' => $data->id,
                'name' => $request->input('facilities')[$key]['value'],
                'updated_by' => $request->input('updated_by'),
            ]);
            $facilities->push();
        }
        
        //nearbies
        foreach($request->input('nearbies') as $key => $val){
            $nearbies = $data->facilities()->create([
                'project_id' => $data->id,
                'name' => $request->input('nearbies')[$key]['value'],
                'updated_by' => $request->input('updated_by'),
            ]);
            $nearbies->push();
        }

        // $facades = $data->facades()->create([
        //     'project_id' => $data->id,
        //     'name' => $request->input('facades'),
        //     'updated_by' => $request->input('updated_by')
        // ]);
        
        // $amenities = $data->amenities()->create([
        //     'project_id' => $data->id,
        //     'name' => $request->input('amenities'),
        //     'updated_by' => $request->input('updated_by')
        // ]);
        
        // $floorPlans = $data->floorPlans()->create([
        //     'project_id' => $data->id,
        //     'name' => $request->input('floor_plans'),
        //     'updated_by' => $request->input('updated_by')
        // ]);
        
        // $facades->push();
        // $amenities->push();
        // $floorPlans->push();
        
        // location images
        if($request->input('location_images') !== null){
            foreach ($request->input('location_images') as $key => $val) {
                // $exploded = explode(',', $request->input('location_images')[$key]['image']);
                // $image = base64_decode($exploded[1]);
                // $image_name = $request->input('location_images')[$key]['name'];
                Storage::disk('local')->put(
                    $request->input('location_images')[$key]['name'],  
                    base64_decode(base64_decode($request->input('location_images')[$key]['image']))
                );
                $images = $data->images()->create([
                    'foreign_id' => $data->id,
                    'foreign_table' => 'projects',                
                    'image_name' => $request->input('location_images')[$key]['name'],
                    'image_path' => 'null',
                    'updated_by' => $request->input('updated_by'),
                ]);
                $images->push();
            }
        }

        // facades images
        if($request->input('facades_images') !== null){
            foreach ($request->input('facades_images') as $key => $val) {
                // $exploded = explode(',', $request->input('facades_images')[$key]['image']);
                // $image = base64_decode($exploded[1]);
                // return $this->responseOk($request->input('location_images')[$key]['name']);
                Storage::disk('local')->put(
                    $request->input('facades_images')[$key]['name'],
                    base64_decode($request->input('facades_images')[$key]['image'])
                );
                
                $images = $data->images()->create([
                    'foreign_id' => $data->id,
                    'foreign_table' => 'facades',                
                    'image_name' => $request->input('facades_images')[$key]['name'],
                    'image_path' => 'null',
                    'updated_by' => $request->input('updated_by'),
                ]);
                $images->push();
            }
        }

        // amenities images
        if($request->input('amenities_images') !== null){
            foreach ($request->input('amenities_images') as $key => $val) {
                Storage::disk('local')->put(
                    $request->input('amenities_images')[$key]['name'],  
                    base64_decode($request->input('amenities_images')[$key]['image'])
                );
                $images = $data->images()->create([
                    'foreign_id' => $data->id,
                    'foreign_table' => 'amenities',                
                    'image_name' => $request->input('amenities_images')[$key]['name'],
                    'image_path' => 'null',
                    'updated_by' => $request->input('updated_by'),
                ]);
                $images->push();
            }
        }

        // floor_plans images
        if($request->input('floor_plans_images') !== null){
            foreach ($request->input('floor_plans_images') as $key => $val) {
                Storage::disk('local')->put(
                    $request->input('floor_plans_images')[$key]['name'],  
                    base64_decode($request->input('floor_plans_images')[$key]['image'])
                );
                $images = $data->images()->create([
                    'foreign_id' => $data->id,
                    'foreign_table' => 'floor_plans',                
                    'image_name' => $request->input('floor_plans_images')[$key]['name'],
                    'image_path' => 'null',
                    'updated_by' => $request->input('updated_by'),
                ]);
                $images->push();
            }
        }
        
        if($request->input('brochure') !== null){
            // if($request->input('brochure')['id'] == 0 && $request->input('brochure')['file'] != 0){
                // Storage::disk('local')->put(
                //     $request->input('brochure')['file_name'],
                //     base64_decode($request->input('brochure')['file'])
                // );  
            // }
            $brochure = $data->brochures()->create([
                'project_id' => $data->id,
                // 'name' => $request->input('brochure')['file_name'],
                'name' => $request->input('brochure'),
                'updated_by' => $request->input('updated_by'),
            ]);
            $brochure->push();
        }

        return $this->responseCreated($data);
    }

    // Update Data
    public function putProjects(Request $request, $id)
    {
        $data = $this->table::find($id);
        $unitDetails = $data->unitDetails;
        
        if(!$data) return $this->responseError("No record(s) found");
        $data->name = $request->input('name');
        $data->project_type = $request->input('project_type');
        $data->description = $request->input('description');
        $data->updated_by = $request->input('updated_by');
        $data->address = $request->input('address');
        $data->youtube_url = $request->input('youtube_url');
        $data->location_id = $request->input('location_id');
        $data->location->region_id = $request->input('region_id'); 
        // $data->unitDetails->
        $data->save();
        
        //units
        $projectsUnits = $data->unitDetails()
        ->where('project_id', $data->id)
        ->get();
        
        foreach($request->input('units') as $key => $val){
            foreach($projectsUnits as $k => $v){
                if($request->input('units')[$key]['id'] == $projectsUnits[$k]['id']){
                    $projectsUnits[$k]['id'] = null;
                }
            }
            
            if($request->input('units')[$key]['id'] == 0){
                $unitDetails = $data->unitDetails()->create([
                    'project_id' => $data->id,
                    'unit_type_id' => $request->input('units')[$key]['unit_type'],
                    'lowest_price' => $request->input('units')[$key]['lowest_price'],
                    'highest_price' => $request->input('units')[$key]['highest_price'],
                    'lowest_size' => $request->input('units')[$key]['lowest_size'],
                    'highest_size' => $request->input('units')[$key]['highest_size'],
                    'updated_by' => $request->input('updated_by'),
                ]);
                $unitDetails->push();
            }else{
                $unitDetails = $data->unitDetails()->find($request->input('units')[$key]['id']);
                $unitDetails->project_id = $data->id;
                $unitDetails->unit_type_id = $request->input('units')[$key]['unit_type'];
                $unitDetails->lowest_price = $request->input('units')[$key]['lowest_price'];
                $unitDetails->highest_price = $request->input('units')[$key]['highest_price'];
                $unitDetails->lowest_size = $request->input('units')[$key]['lowest_size'];
                $unitDetails->highest_size = $request->input('units')[$key]['highest_size'];
                $unitDetails->updated_by = $request->input('updated_by');
                $unitDetails->push();
            }
            
            $this->updateCreateImagesUnit(
                $data,
                $unitDetails->unit_type_id,
                'model_units',
                $request->input('units')[$key]['model_units'], 
                $request->input('updated_by'));
            $this->updateCreateImagesUnit(
                $data,
                $unitDetails->unit_type_id, 
                'unit_layouts', 
                $request->input('units')[$key]['unit_layouts'], 
                $request->input('updated_by')
            );
        }

        foreach ($projectsUnits as $key => $value) {
            if($projectsUnits[$key]['id'] != null){
                $projectsUnits[$key]->delete();
            }
        }
        
        //amenities
        $projectAmenities = $data->amenities()->where('project_id', $data->id)->get();
        foreach($request->input('amenities') as $key => $val){
            foreach($projectAmenities as $k => $v){
                if($request->input('amenities')[$key]['id'] == $projectAmenities[$k]['id']){
                    $projectAmenities[$k]['id'] = null;
                }
            }
            
            if($request->input('amenities')[$key]['id'] == 0){
                $amenities = $data->amenities()->create([
                    'project_id' => $data->id,
                    'name' => $request->input('amenities')[$key]['value'],
                    'updated_by' => $request->input('updated_by'),
                ]);
                $amenities->push();
            }else{
                $amenities = $data->amenities()->find($request->input('amenities')[$key]['id']);
                $amenities->project_id = $data->id;
                $amenities->name = $request->input('amenities')[$key]['value'];
                $amenities->updated_by = $request->input('updated_by');
                $amenities->push();
            }
        }

        foreach ($projectAmenities as $key => $value) {
            if($projectAmenities[$key]['id'] != null){
                $projectAmenities[$key]->delete();
            }
        }
        
        //facilities
        $projectFacilities = $data->facilities()->where('project_id', $data->id)->get();
        foreach($request->input('facilities') as $key => $val){
            foreach($projectFacilities as $k => $v){
                if($request->input('facilities')[$key]['id'] == $projectFacilities[$k]['id']){
                    $projectFacilities[$k]['id'] = null;
                }
            }

            if($request->input('facilities')[$key]['id'] == 0){
                $facilities = $data->facilities()->create([
                    'project_id' => $data->id,
                    'name' => $request->input('facilities')[$key]['value'],
                    'updated_by' => $request->input('updated_by'),
                ]);
                $facilities->push();
            }
            // else{
            //     $facilities = $data->facilities()->find($request->input('facilities')[$key]['id']);
            //     $facilities->project_id = $data->id;
            //     $facilities->name = $request->input('facilities')[$key]['value'];
            //     $facilities->updated_by = $request->input('updated_by');
            //     $facilities->push();
            // }
        }
        
        foreach ($projectFacilities as $key => $value) {
            if($projectFacilities[$key]['id'] != null){
                $projectFacilities[$key]->delete();
            }
        }

        //nearbies
        $projectNearbies = $data->nearbies()->where('project_id', $data->id)->get();
        foreach($request->input('nearbies') as $key => $val){
            foreach($projectNearbies as $k => $v){
                if($request->input('nearbies')[$key]['id'] == $projectNearbies[$k]['id']){
                    $projectNearbies[$k]['id'] = null;
                }
            }

            if($request->input('nearbies')[$key]['id'] == 0){
                $nearbies = $data->nearbies()->create([
                    'project_id' => $data->id,
                    'name' => $request->input('nearbies')[$key]['value'],
                    'updated_by' => $request->input('updated_by'),
                ]);
                $nearbies->push();
            }
        }
        
        foreach ($projectNearbies as $key => $value) {
            if($projectNearbies[$key]['id'] != null){
                $projectNearbies[$key]->delete();
            }
        }
        
        // brochure
        // $projectBrochures = $data->brochures()->where('project_id', $data->id)->get();
        // foreach($projectBrochures as $k => $v){
        //     if(($request->input('brochure')['id']) == $projectBrochures[$k]['id']){
        //         $projectBrochures[$k]['id'] = null;
        //     }
        // }

        if($request->input('brochure') !== null){
            // if($request->input('brochure')['id'] == 0 && $request->input('brochure')['file'] != 0){
                // Storage::disk('local')->put(
                //     $request->input('brochure')['file_name'],
                //     base64_decode($request->input('brochure')['file'])
                // );  
            // }
            $brochure = $data->brochures()->create([
                'project_id' => $data->id,
                'name' => $request->input('brochure'),
                'updated_by' => $request->input('updated_by'),
            ]);
            $brochure->push();
        }

        // foreach ($projectBrochures as $key => $value) {
        //     if($projectBrochures[$key]['id'] != null){
        //         $projectBrochures[$key]->delete();
        //         Storage::delete($projectBrochures[$key]['name']);
        //     }
        // }
        
        // hlurb
        if($request->input('hlurb')['id'] == 0){
            $hlurb = $data->hlurbs()->create([
                'project_id' => $data->id,
                'name' => $request->input('hlurb')['name'],
                'updated_by' => $request->input('updated_by'),
            ]);
            $hlurb->push();
        }else{
            $hlurb = $data->hlurbs()->find($request->input('hlurb')['id']);    
            $hlurb->name = $request->input('hlurb')['name'];
            $hlurb->updated_by = $request->input('updated_by');
            $hlurb->push();
        }
        
        // location images
        $this->updateCreateImages(
            $data, 
            'projects', 
            $request->input('location_images'), 
            $request->input('updated_by')
        );
        
        // facades images
        $this->updateCreateImages(
            $data, 
            'facades', 
            $request->input('facades_images'), 
            $request->input('updated_by')
        );
        
        // floor_plans images
        $this->updateCreateImages(
            $data, 
            'floor_plans', 
            $request->input('floor_plans_images'), 
            $request->input('updated_by')
        );
        
        // amenities images
        $this->updateCreateImages(
            $data, 
            'amenities', 
            $request->input('amenities_images'), 
            $request->input('updated_by')
        );

        return $this->responseOk($data);
    }

    public function putProjectsMass(Request $request)
    {
        if(is_array($request->input('id'))){
            foreach($request->input('id') as $key => $value){
                $data = $this->table::find($value);
                if(!$data) return $this->responseError("No record(s) found");
                if($request->input('remarks') == "null"){
                    $data->remarks = null;
                }else{
                    $data->remarks = $request->input('remarks');   
                }
                $data->updated_by = $request->input('updated_by');
                $data->save();
            }
        }else{
            $data = $this->table::find($request->input('id'));
            if(!$data) return $this->responseError("No record(s) found");
            if($request->input('remarks') == "null"){
                $data->remarks = null;
            }else{
                $data->remarks = $request->input('remarks');   
            }
            $data->updated_by = $request->input('updated_by');
            $data->save();
        }        

        return $this->responseOk($data);
        // $data->fill($request->all());
        // $data->save();
        // $data = array( "name" => $data->name );
    }

    // Delete/Archive Data
    public function deleteProjects($id)
    {   
        $data = $this->table::find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data = array( "name" => $data->name );
        $this->table->destroy($id);
        return $this->responseOk($data);
    }

    // Restore Data
    public function restoreProjects($id)
    {
        $data = $this->table->onlyTrashed()->find($id);
        if(!$data) return $this->responseError("No record(s) found");
        $data->restore();
        $data = array( "name" => $data->name );
        return $this->responseOk($data);
    }

    //Update Or Create Images
    public function updateCreateImages($data, $foreign_table, $requestImages, $requestBy){
        $projectImages = $data->images()
        ->where('foreign_id', $data->id)
        ->where('foreign_table', $foreign_table)->get();
        
        foreach($requestImages as $key => $val){
            foreach($projectImages as $k => $v){
                if($requestImages[$key]['id'] == $projectImages[$k]['id']){
                    $projectImages[$k]['id'] = null;
                }
            }
            
            if($requestImages[$key]['id'] != 0){
                $images = $data->images()->find($requestImages[$key]['id']);
                $images->foreign_id = $data->id;
                $images->foreign_table = $foreign_table;
                $images->image_name = $requestImages[$key]['name'];                
                $images->updated_by = $requestBy;
                $images->push();
            }else{
                Storage::disk('local')->put(
                    $requestImages[$key]['name'],
                    base64_decode($requestImages[$key]['image'])
                );

                $images = $data->images()->create([
                    'foreign_id' => $data->id,
                    'foreign_table' => $foreign_table,
                    'image_name' => $requestImages[$key]['name'],
                    'image_path' => 'null',
                    'updated_by' => $requestBy,
                ]);
                $images->push();
            }
        }
        
        foreach ($projectImages as $key => $value) {
            if($projectImages[$key]['id'] != null){
                $projectImages[$key]->delete();
                Storage::delete($projectImages[$key]['name']);
            }
        }
    }

    //Update Or Create Images for Units
    public function updateCreateImagesUnit($project, $id, $foreign_table, $requestImages, $requestBy){
        $projectImages = $project->images()
        ->where('foreign_id', $project->id)
        ->where('foreign_table', $id . $foreign_table)->get();
        
        foreach($requestImages as $key => $val){
            foreach($projectImages as $k => $v){
                if($requestImages[$key]['id'] == $projectImages[$k]['id']){
                    $projectImages[$k]['id'] = null;
                }
            }
            
            if($requestImages[$key]['id'] != 0){
                $images = $project->images()->find($requestImages[$key]['id']);
                $images->foreign_id = $project->id;
                $images->foreign_table = $id . $foreign_table;
                $images->image_name = $requestImages[$key]['name'];                
                $images->updated_by = $requestBy;
                $images->push();
            }else{
                Storage::disk('local')->put(
                    $requestImages[$key]['name'],
                    base64_decode($requestImages[$key]['image'])
                );

                $images = $project->images()->create([
                    'foreign_id' => $project->id,
                    'foreign_table' => $id . $foreign_table,
                    'image_name' => $requestImages[$key]['name'],
                    'image_path' => 'null',
                    'updated_by' => $requestBy,
                ]);
                $images->push();
            }
        }
        
        foreach ($projectImages as $key => $value) {
            if($projectImages[$key]['id'] != null){
                $projectImages[$key]->delete();
            }
        }
    }
}
