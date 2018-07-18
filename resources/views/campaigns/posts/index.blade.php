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
                <div class="top has-text-centered">
                    <h2 class="is-size-3 m-b-md">
                        Campaign posts
                        <span class="tag is-medium">
                            {{ $campaign->posts->count() }}
                        </span>
                    </h2>
                    @can('update', $campaign)
                        <a href="{{ route('campaigns.posts.create', ['campaign' => $campaign]) }}" class="button is-info m-b-lg">
                            Create new post
                        </a>
                    @endcan
                </div>
                @foreach($campaign->posts as $post)
                    @include('campaigns.posts._show', ['campaign' => $campaign, 'post' => $post])
                @endforeach
            </div>
        </div>
    </div>
@endsection
