<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'Faisal rabbani',
            'email' => 'farzad.edsoft@gmail.com',
            'password' => bcrypt('123456'),
            'user_type' => 'system',
            'belongs_to' => 0,
            'role_id' => 1,
            'permissions' => 'create, read, update, delete',
            'status' => 1,
            'created_at' => Carbon::now(),
            'created_by' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('123456'),
            'user_type' => 'teacher',
            'belongs_to' => 0,
            'role_id' => 1,
            'permissions' => 'create, read, update, delete',
            'status' => 1,
            'created_at' => Carbon::now(),
            'created_by' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'password' => bcrypt('123456'),
            'user_type' => 'student',
            'belongs_to' => 0,
            'role_id' => 2,
            'permissions' => 'create, read, update',
            'status' => 1,
            'created_at' => Carbon::now(),
            'created_by' => 1
        ]);

       

    }
}
