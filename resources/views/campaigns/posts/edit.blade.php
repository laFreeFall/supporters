@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Editing post</h1>

                    @component('campaigns.posts._form', compact('post', 'privacies'))
                        @slot('form')
                            <form method="POST" action="{{ route('campaigns.posts.update', ['campaign' => $campaign, 'post' => $post]) }}">
                            {!! method_field('patch') !!}
                        @endslot
                        @slot('submit')
                            <div class="control">
                                <button type="submit" class="button is-link">Update Post</button>
                            </div>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </section>
@endsection
