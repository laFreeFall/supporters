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

                @forelse($post->comments as $comment)
                    @include('campaigns.posts.comments._show', ['campaign' => $campaign, 'post' => $post, 'comment' => $comment])
                @empty
                    <p>there are no comments at the moment</p>
                @endforelse

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
