@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Adding new post</h1>

                    @include('campaigns.posts._form', [
                        'action' => route('campaigns.posts.store', ['campaign' => $campaign]),
                        'method' => 'post',
                        'button' => 'Create Post',
                        'post' => $post,
                        'privacies' => $privacies,
                        'tags' => $tags
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
