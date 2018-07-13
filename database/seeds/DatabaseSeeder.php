<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(CampaignsCategoriesTableSeeder::class);
         $this->call(CampaignsColorsTableSeeder::class);
         $this->call(CampaignsTableSeeder::class);
    }
}
