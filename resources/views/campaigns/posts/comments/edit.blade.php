@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Editing comment</h1>

                    @include('campaigns.posts.comments._form', [
                        'action' => route('campaigns.posts.comments.update', ['campaign' => $campaign, 'post' => $post, 'comment' => $comment]),
                        'method' => 'patch',
                        'button' => 'Save changes',
                        'comment' => $comment,
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
