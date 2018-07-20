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
                <div class="top has-text-centered">
                    <h2 class="is-size-3 m-b-md">
                        Campaign posts
                        <span class="tag is-medium">
                            {{ $posts->count() }}
                        </span>
                    </h2>
                    @can('update', $campaign)
                        <a href="{{ route('campaigns.posts.create', ['campaign' => $campaign]) }}" class="button {{ $campaign->colors->color_class }} m-b-lg">
                            Create new post
                        </a>
                    @endcan
                </div>
                @foreach($posts as $post)
                    @include('campaigns.posts._show', ['campaign' => $campaign, 'post' => $post])
                @endforeach
            </div>
            <div class="column is-2">
                <div class="columns is-multiline">
                    <div class="column is-12">

                        <div class="tags-list m-b-md">
                            @include('campaigns.tags._index', compact('campaign'))
                        </div>
                        @can('update', $campaign)
                            @include('campaigns.tags._form', [
                                'action' => route('campaigns.tags.store', ['campaign' => $campaign]),
                                'method' => 'post',
                                'button' => 'Add Tag',
                                'campaign' => $campaign,
                                'tag' => $emptyTag
                            ])
                        @endcan
                    </div>
                    <div class="column is-12">
                        @include('campaigns.archives._index', compact('campaign'))
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
