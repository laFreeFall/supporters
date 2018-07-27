@extends('layouts.app')

@section('content')
    <div class="container is-fluid is-marginless">
        <div class="columns is-multiline">
            <div class="column is-12">
                @include('campaigns._hero', ['campaign' => $campaign])
            </div>
            <div class="column is-12">
                @include('campaigns._tabs', ['active' => 'feed'])
            </div>
        </div>
        <div class="columns is-centered">
            <div class="column is-6">
                @include('campaigns.posts._show', ['campaign' => $campaign, 'post' => $post])

                <div id="comments">
                    @forelse($comments as $comment)
                        @include('campaigns.posts.comments._show', ['campaign' => $campaign, 'post' => $post, 'comment' => $comment])
                    @empty
                        <div class="notification">
                            There are no comments at the moment. Write first one below!
                        </div>
                    @endforelse
                    <div class="m-t-md">
                        {{ $comments->links() }}
                    </div>
                </div>

                @auth
                    @include('campaigns.posts.comments._form', [
                        'action' => route('campaigns.posts.comments.store', ['campaign' => $campaign, 'post' => $post]),
                        'method' => 'post',
                        'button' => 'Post',
                        'comment' => $emptyComment,
                    ])
                @endauth
            </div>
        </div>
    </div>
@endsection
