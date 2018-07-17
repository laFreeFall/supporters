<?php

use Illuminate\Database\Seeder;

class CampaignsPostsPrivaciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns_posts_privacies')->insert([
            [
                'title' => 'For everyone',
                'value' => 'all',
                'icon' => 'fa-users'
            ],
            [
                'title' => 'For followers',
                'value' => 'followers',
                'icon' => 'fa-user-friends'
            ],
            [
                'title' => 'For supporters',
                'value' => 'supporters',
                'icon' => 'fa-hands-helping'
            ]
        ]);
    }
}
