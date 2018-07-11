@extends('layouts.app')

@section('content')
<section class="hero">
    <div class="hero-body">
        <div class="container">
            <h1 class="subtitle">
                @auth
                    You're logged in, {{ auth()->user()->name }}!
                @endauth
                @guest
                    Please <a href="{{ route('register') }}">register</a> or <a href="{{ route('login') }}">log in</a> to use our website.
                @endguest
            </h1>
            @if (session('status'))
                <article class="message is-success">
                    <div class="message-header">
                        <p>Status</p>
                    </div>
                    <div class="message-body">
                        {{ session('status') }}
                    </div>
                </article>
            @endif
        </div>
    </div>
</section>
@endsection
