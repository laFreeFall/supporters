@extends('layouts.app')

@section('content')
    <div class="container is-fluid is-marginless">
        <div class="columns">
            <div class="column is-12">
                @include('campaigns._hero', ['campaign' => $campaign])
            </div>
        </div>
        <div class="columns is-centered">
            <div class="column is-6">
                @include('campaigns.posts._show', ['campaign' => $campaign, 'post' => $post])

                <div id="comments">
                    @forelse($post->comments as $comment)
                        @include('campaigns.posts.comments._show', ['campaign' => $campaign, 'post' => $post, 'comment' => $comment])
                    @empty
                        <div class="notification">
                            There are no comments at the moment. Write first one below!
                        </div>
                    @endforelse
                </div>

                @include('campaigns.posts.comments._form', [
                    'action' => route('campaigns.posts.comments.store', ['campaign' => $campaign, 'post' => $post]),
                    'method' => 'post',
                    'button' => 'Post',
                    'comment' => $emptyComment,
                ])
            </div>
        </div>
    </div>
@endsection
