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
                'email' => 'admin@mail.com',
                'password' => bcrypt('password'),
                'created_at' => $timestamp
            ],
            [
                'email' => 'test@mail.com',
                'password' => bcrypt('password'),
                'created_at' => $timestamp
            ],
            [
                'email' => 'user@mail.com',
                'password' => bcrypt('password'),
                'created_at' => $timestamp
            ],
        ]);

        DB::table('profiles')->insert([
            [
                'username' => 'admin',
                'user_id' => 1,
                'first_name' => 'Admin',
                'last_name' => 'Adminovich'
            ],
            [
                'username' => 'test',
                'user_id' => 2,
                'first_name' => 'Test',
                'last_name' => 'Testovich'
            ],
            [
                'username' => 'user',
                'user_id' => 3,
                'first_name' => 'User',
                'last_name' => 'Userovich'
            ],
        ]);
    }
}
