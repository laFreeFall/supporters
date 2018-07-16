<?php

use Illuminate\Database\Seeder;

class CampaignsPledgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns_pledges')->insert([
            [
                'campaign_id' => 1,
                'title' => 'Junior supporter',
                'amount' => 1,
                'privileges' => 'You\'ll receive weekly email'
            ],
            [
                'campaign_id' => 1,
                'title' => 'Middle supporter',
                'amount' => 10,
                'privileges' => 'You\'ll receive daily letter'
            ],
            [
                'campaign_id' => 1,
                'title' => 'Senior supporter',
                'amount' => 50,
                'privileges' => 'You\'ll receive all above and 1 hour talk per month'
            ],
        ]);
    }
}
