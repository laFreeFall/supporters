<?php

use Illuminate\Database\Seeder;

class CampaignsColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns_colors')->insert([
            [
                'title' => 'White',
                'color_class' => null,
                'background_class' => null,
                'text_class' => null
            ],
            [
                'title' => 'Coral',
                'color_class' => 'is-primary',
                'background_class' => 'has-background-primary',
                'text_class' => 'has-text-white'
            ],
            [
                'title' => 'Blue',
                'color_class' => 'is-info',
                'background_class' => 'has-background-info',
                'text_class' => 'has-text-white'
            ],
            [
                'title' => 'Green',
                'color_class' => 'is-success',
                'background_class' => 'has-background-success',
                'text_class' => 'has-text-white'
            ],
            [
                'title' => 'Yellow',
                'color_class' => 'is-warning',
                'background_class' => 'has-background-warning',
                'text_class' => 'has-text-black'
            ],
            [
                'title' => 'Purple',
                'color_class' => 'is-danger',
                'background_class' => 'has-background-danger',
                'text_class' => 'has-text-white'
            ],
            [
                'title' => 'Light',
                'color_class' => 'is-light',
                'background_class' => 'has-background-light',
                'text_class' => 'has-text-black'
            ],
            [
                'title' => 'Dark',
                'color_class' => 'is-dark',
                'background_class' => 'has-background-dark',
                'text_class' => 'has-text-white'
            ]
        ]);
    }
}
