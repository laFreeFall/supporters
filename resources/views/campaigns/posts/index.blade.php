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
            <div class="column is-2">
                <div class="top has-text-centered">
                    <h2 class="is-size-3 m-b-md">
                        Tags
                        <span class="tag is-medium">
                            {{ $tags->count() }}
                        </span>
                    </h2>
                </div>
                <div class="tags-list m-b-md">
                    @forelse($tags as $tag)
                        <span class="tag is-light">
                            <strong>{{ $tag->name }}</strong>
                            @if($tag->posts_count)
                                : {{ $tag->posts_count }}
                            @endif
                            <a href="{{ route('campaigns.tags.destroy', ['campaign' => $campaign, 'tag' => $tag]) }}" class="delete is-small m-r-md" onclick="event.preventDefault(); document.getElementById('destroy-tag-{{ $tag->id }}-form').submit();"></a>
                        </span>
                        <form id="destroy-tag-{{ $tag->id }}-form" action="{{ route('campaigns.tags.destroy', ['campaign' => $campaign, 'tag' => $tag]) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {!! method_field('delete') !!}
                        </form>
                    @empty
                        <div class="notification">
                            There are no tags at the moment. Add one below!
                        </div>
                    @endforelse
                </div>
                @can('update', $campaign)
                    @include('campaigns.tags._form', [
                        'action' => route('campaigns.tags.store', ['campaign' => $campaign]),
                        'method' => 'post',
                        'button' => 'Add Tag',
                        'tag' => $emptyTag
                    ])
                @endcan
            </div>
        </div>
    </div>
@endsection
