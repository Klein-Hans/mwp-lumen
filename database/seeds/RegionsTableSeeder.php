<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
            'name' => 'Ipsum Region',
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()            
        ]);
        
        DB::table('regions')->insert([
            'name' => 'Metro Manila',
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()            
        ]);
    }
}
