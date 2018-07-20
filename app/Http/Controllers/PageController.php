<?php

namespace App\Http\Controllers;

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
        return 'test';
    }
}
