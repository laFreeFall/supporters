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
        $this->call(CampaignsGoalsTableSeeder::class);
        $this->call(CampaignsPledgesTableSeeder::class);
        $this->call(CampaignsPostsPrivaciesTableSeeder::class);
        $this->call(CampaignsTagsTableSeeder::class);
    }
}
