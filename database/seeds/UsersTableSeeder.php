<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = \Carbon\Carbon::now();
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('password'),
                'created_at' => $timestamp
            ],
            [
                'name' => 'test',
                'email' => 'test@mail.com',
                'password' => bcrypt('password'),
                'created_at' => $timestamp
            ],
            [
                'name' => 'user',
                'email' => 'user@mail.com',
                'password' => bcrypt('password'),
                'created_at' => $timestamp
            ],
        ]);

        DB::table('profiles')->insert([
            [
                'user_id' => 1,
                'first_name' => 'Admin',
                'last_name' => 'Adminovich'
            ],
            [
                'user_id' => 2,
                'first_name' => 'Test',
                'last_name' => 'Testovich'
            ],
            [
                'user_id' => 3,
                'first_name' => 'User',
                'last_name' => 'Userovich'
            ],
        ]);
    }
}
