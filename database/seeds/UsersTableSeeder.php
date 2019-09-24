<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Test',
            'lastname' => 'Test',
            'email' => 'test@test.com',
            'password' => Hash::make('test123456'),
            'user_type' => '1',
            'updated_by' => '1',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
            // date('m/d/Y h:i:s a', time())
        ]);

        DB::table('users')->insert([
            'firstname' => 'Klein-Hans',
            'lastname' => 'Escuton',
            'email' => 'escutonklein@gmail.com',
            'password' => Hash::make('admin123456'),
            'user_type' => '1',
            'updated_by' => '1',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
            // date('m/d/Y h:i:s a', time())
        ]);

        DB::table('users')->insert([
            'firstname' => 'Nhilly-ann',
            'lastname' => 'Contreras',
            'email' => 'nhilly.contreras@gmail.com',
            'password' => Hash::make('admin123456'),
            'user_type' => '1',
            'updated_by' => '1',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
            // date('m/d/Y h:i:s a', time())
        ]);

        DB::table('users')->insert([
            'firstname' => 'Mark',
            'lastname' => 'Paningbatan',
            'email' => 'mark.affluent@gmail.com',
            'password' => Hash::make('admin123456'),
            'user_type' => '1',
            'updated_by' => '1',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
            // date('m/d/Y h:i:s a', time())
        ]);
    }
}
