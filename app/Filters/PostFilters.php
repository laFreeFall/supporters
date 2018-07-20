<?php

namespace App\Filters;

use App\Tag;
use Carbon\Carbon;

class PostFilters extends Filters
{

    /**
     * @var $filters
     */
    protected $filters = ['tag', 'month', 'year'];


    /**
     * Filter the query by given month.
     *
     * @param $tag
     * @return mixed
     */
    protected function tag($tag)
    {
        $tag = Tag::whereName($tag)->first();
        return $this->builder->join('post_tag', 'campaigns_posts.id', '=', 'post_tag.post_id')->where('post_tag.tag_id', $tag->id);
    }

    /**
     * Filter the query by given year.
     *
     * @param $month
     * @return mixed
     */
    protected function month($month)
    {
        return $this->builder->whereMonth('created_at', Carbon::parse($month)->month);
    }

    /**
     * Filter the query by given year.
     *
     * @param $year
     * @return mixed
     */
    protected function year($year)
    {
        return $this->builder->whereYear('created_at', Carbon::parse($year)->year);
    }
}