<?php

namespace App\Filters;

use App\Category;
use App\Profile;
use App\Tag;
use App\User;
use Carbon\Carbon;

class CampaignFilters extends Filters
{

    /**
     * @var $filters
     */
    protected $filters = ['category', 'holder', 'by'];


    /**
     * Filter the query by given month.
     *
     * @param  $category
     * @return mixed
     */
    protected function category($category)
    {
        if($category === 'all') return $this->builder;

        $category = Category::whereTitle($category)->first();
        return $this->builder->where('campaigns.category_id', $category->id);
    }

    /**
     * Filter the query by given year.
     *
     * @param  $holder
     * @return mixed
     */
    protected function holder($holder)
    {
        if($holder === 'all') return $this->builder;

        return $this->builder->whereHolder($holder === 'single');
    }

    /**
     * Filter the query by given year.
     *
     * @param  $by
     * @return mixed
     */
    protected function by($by)
    {
        $profile = Profile::whereUsername($by)->first();
        return $this->builder->where('user_id', $profile->user_id);
    }
}