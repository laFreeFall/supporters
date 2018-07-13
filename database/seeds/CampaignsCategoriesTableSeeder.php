<?php

use Illuminate\Database\Seeder;

class CampaignsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns_categories')->insert([
            [
                'title' => 'Education',
                'icon' => 'graduation-cap'
            ],
            [
                'title' => 'Sport',
                'icon' => 'wheelchair'
            ],
            [
                'title' => 'Craft',
                'icon' => 'drafting-compass'
            ],
            [
                'title' => 'IT',
                'icon' => 'code'
            ],
            [
                'title' => 'Art',
                'icon' => 'paint-brush'
            ]
        ]);
    }
}
