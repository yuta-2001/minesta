<?php

namespace Database\Seeders;

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
            [
                'name' => 'test1',
                'email' => 'test1@test.com',
                'password' => 'password123',
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test.com',
                'password' => 'password123',
            ],
            [
                'name' => 'test3',
                'email' => 'test3@test.com',
                'password' => 'password123',
            ],
            [
                'name' => 'test4',
                'email' => 'test4@test.com',
                'password' => 'password123',
            ],
        ]);
    }
}
