<?php

use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns')->insert([
            [
                'user_id' => 1,
                'category_id' => 4,
                'color_id' => 2,
                'title' => 'Microsoft',
                'slug' => 'microsoft',
                'activity' => 'creating software',
                'description' => 'Nothing to say more...',
                'holder' => false
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'color_id' => 3,
                'title' => 'Github',
                'slug' => 'github',
                'activity' => 'hosting opensource',
                'description' => 'Nothing to say more...',
                'holder' => false
            ],
            [
                'user_id' => 2,
                'category_id' => 1,
                'color_id' => 4,
                'title' => 'Youtube',
                'slug' => 'youtube',
                'activity' => 'hosting video',
                'description' => 'Nothing to say more...',
                'holder' => false
            ],
            [
                'user_id' => 2,
                'category_id' => 2,
                'color_id' => 5,
                'title' => 'Hewlett Packard',
                'slug' => 'hp',
                'activity' => 'creating laptops',
                'description' => 'Nothing to say more...',
                'holder' => false
            ],
            [
                'user_id' => 3,
                'category_id' => 3,
                'color_id' => 6,
                'title' => 'Richard Dawkins',
                'slug' => 'dawkins',
                'activity' => 'writing books',
                'description' => 'Nothing to say more...',
                'holder' => true
            ]
        ]);
    }
}
