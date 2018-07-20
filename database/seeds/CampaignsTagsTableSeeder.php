<?php

use Illuminate\Database\Seeder;

class CampaignsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns_tags')->insert([
            [
                'campaign_id' => 1,
                'name' => 'Personal'
            ],
            [
                'campaign_id' => 1,
                'name' => 'Educational'
            ],
            [
                'campaign_id' => 1,
                'name' => 'Work'
            ],
            [
                'campaign_id' => 1,
                'name' => 'Hobby'
            ],
            [
                'campaign_id' => 1,
                'name' => 'Lifestyle'
            ]
        ]);
    }
}
