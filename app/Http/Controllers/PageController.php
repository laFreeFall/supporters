<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Message;

class PageController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function home() {
        return view('pages.home');
    }

    /**
     * Tests some stuff.
     *
     * @return mixed
     */
    public function test()
    {
        $campaign = Campaign::first();
//        return 'test';
        return Message::first();
        return $campaign->messages;
    }
}
