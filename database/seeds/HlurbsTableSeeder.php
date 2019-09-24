<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HlurbsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hlurbs')->insert([
            'project_id' => 1,
            'name' => 'Lorem Ipsum HLURB',
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()            
        ]);
    }
}
