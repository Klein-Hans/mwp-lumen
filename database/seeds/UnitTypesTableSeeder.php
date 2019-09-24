<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UnitTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unit_types')->insert([
            'name' => 'Lorem Ipsum Unit Types',
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()            
        ]);
        
        DB::table('unit_types')->insert([
            'name' => 'Studio',
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()            
        ]);

        DB::table('unit_types')->insert([
            'name' => 'One Bedroom',
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()            
        ]);

        DB::table('unit_types')->insert([
            'name' => 'Two Bedroom',
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()            
        ]);

        DB::table('unit_types')->insert([
            'name' => 'Three Bedroom',
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()            
        ]);
        
        DB::table('unit_types')->insert([
            'name' => 'Penthouse',
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()            
        ]);
    }
}
