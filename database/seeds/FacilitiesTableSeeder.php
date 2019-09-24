<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facilities')->insert([
            'project_id' => 1,
            'name' => 'Lorem Ipsum Facilities',
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()            
        ]);
    }
}
