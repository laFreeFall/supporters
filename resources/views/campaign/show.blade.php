@extends('layouts.app')

@section('content')
    <div class="container is-fluid is-marginless">
        <div class="columns">
            <div class="column is-12">
                @include('campaign._hero', ['campaign' => $campaign])
            </div>
        </div>
        <div class="columns is-centered">
            <div class="column is-2">
                <a href="#" class="button is-rounded is-medium is-fullwidth {{ $campaign->colors->color_class }} m-b-lg">
                    <span class="icon">
                        <i class="fas fa-hands-helping"></i>
                    </span>
                    <span>Support</span>
                </a>

                <p class="buttons space-between">
                    <a href="#" class="button is-rounded is-outlined is-link">
                        <span class="icon">
                            <i class="fas fa-user-friends"></i>
                        </span>
                        <span>Follow</span>
                    </a>
                    <a href="#" class="button is-rounded is-outlined is-info">
                        <span class="icon">
                            <i class="fas fa-share-alt"></i>
                        </span>
                        <span>Share</span>
                    </a>
                </p>
                @include('campaign.goal._index', ['goals' => $campaign->goals, 'colors' => $campaign->colors, 'slug' => $campaign->slug])
            </div>
            <div class="column is-5">
                <div class="level">
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Followers</p>
                            <p class="title">3,456</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Supporters</p>
                            <p class="title">123</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Posts</p>
                            <p class="title">456K</p>
                        </div>
                    </div>
                </div>
                <div class="box">
                    {{ $campaign->description }}
                </div>
            </div>
            <div class="column is-2">
                <a href="#" class="button is-rounded is-medium is-fullwidth {{ $campaign->colors->color_class }} m-b-lg">
                    <span class="icon">
                        <i class="fas fa-hands-helping"></i>
                    </span>
                    <span>Support</span>
                </a>
                <p class="has-text-centered m-b-sm">
                    <a href="{{ route('campaign.pledge.index', ['campaign' => $campaign]) }}" class="is-size-4">Pledges</a>
                </p>
                @foreach($campaign->pledges as $pledge)
                    @include('campaign.pledge._show', ['pledge' => $pledge, 'campaign' => $campaign, 'colors' => $campaign->colors])
                @endforeach
            </div>
        </div>
    </div>
@endsection
