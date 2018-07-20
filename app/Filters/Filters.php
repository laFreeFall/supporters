<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var $request
     */
    protected $request;

    /**
     * @var $builder
     */
    protected $builder;

    /**
     * @var $filters
     */
    protected $filters = [];

    /**
     * PostFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Applies filter to the query.
     *
     * @param  $builder
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        foreach($this->request->only($this->filters) as $filter => $value) {
            if(method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }
}