<?php

use Illuminate\Database\Seeder;

class CampaignsGoalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns_goals')->insert([
            [
                'campaign_id' => 1,
                'title' => 'First goal',
                'description' => 'I\'ll start working on project',
                'amount' => 1000
            ],
            [
                'campaign_id' => 1,
                'title' => 'Second goal',
                'description' => 'I\'ll dedicate half time on the project',
                'amount' => 2000
            ],
            [
                'campaign_id' => 1,
                'title' => 'Third goal',
                'description' => 'I\'ll start dedicate full time on the project',
                'amount' => 3000
            ],
            [
                'campaign_id' => 1,
                'title' => 'Final goal',
                'description' => 'I\'ll work on improving project in free time',
                'amount' => 5000
            ]
        ]);
    }
}
