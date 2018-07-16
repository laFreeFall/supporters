<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     */
    public function test()
    {
        return 'test';
    }
}
