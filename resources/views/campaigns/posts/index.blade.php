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
                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title is-centered">
                                {{ $post->title }}
                            </p>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                @can('view', $post)
                                    <p>{{ $post->body}}</p>
                                @else
                                    <p>YOU ARE NOT ALLOWED TO READ THIS POST</p>
                                @endcan
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="card-footer-item">Posted on {{ $post->created_at->format('Y M d') }}</div>
                            <div class="card-footer-item">Available {{ $post->privacy->title }}</div>
                            <div class="card-footer-item">Comments: 0</div>
                        </div>
                        <div class="card-footer">
                            @can('update', $campaign)
                                <a href="{{ route('campaigns.posts.edit', ['campaign' => $campaign, 'post' => $post]) }}" class="card-footer-item">
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                    Edit
                                </a>
                                <a href="{{ route('campaigns.posts.destroy', ['campaign' => $campaign, 'post' => $post]) }}" onclick="event.preventDefault(); document.getElementById('destroy-post-{{ $post->id }}-form').submit();" class="card-footer-item">
                                    <span class="icon">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    Delete
                                </a>
                                <form id="destroy-post-{{ $post->id }}-form" action="{{ route('campaigns.posts.destroy', ['campaign' => $campaign, 'post' => $post]) }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {!! method_field('delete') !!}
                                </form>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
