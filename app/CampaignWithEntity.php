<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignWithEntity extends Campaign
{
    /**
     * The relations that loads by default with the instance.
     *
     * @var array
     */
    protected $with = ['category', 'colors'];
}
