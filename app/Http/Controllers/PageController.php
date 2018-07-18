<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
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
        $post = Post::first();
        $user = User::first();
        $post->likes()->create(['user_id' => $user->id]);
        return 'test';
    }
}
