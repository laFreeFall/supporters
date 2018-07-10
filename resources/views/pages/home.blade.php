@extends('layouts.app')

@section('content')
<section class="hero">
    <div class="hero-body">
        <div class="container">
            <h1 class="subtitle">
                You're logged in, {{ auth()->user()->name }}!
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
