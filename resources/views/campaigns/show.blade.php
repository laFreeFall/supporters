@extends('layouts.app')

@section('content')
    <div class="container is-fluid is-marginless">
        <div class="columns is-multiline">
            <div class="column is-12">
                @include('campaigns._hero', ['campaign' => $campaign])
            </div>
            <div class="column is-12">
                @include('campaigns._tabs', ['active' => 'bio'])

                @if(auth()->check() && auth()->user()->can('update', $campaign) && (!$campaign->goals->count() || !$campaign->pledges->count()))
                    <div class="column is-10 is-offset-1">
                        @if(!$campaign->goals->count())
                            <div class="notification">
                                <p>Currently you haven`t created any goal. Create few if you want more attention to your campaign</p>
                                <a href="{{ route('campaigns.goals.create', ['campaign' => $campaign]) }}" class="button is-white">Create first goal</a>
                            </div>
                        @endif
                        @if(!$campaign->pledges->count())
                            <div class="notification">
                                <p>Currently you haven`t created any pledge. Create few if you want more attention to your campaign</p>
                                <a href="{{ route('campaigns.pledges.create', ['campaign' => $campaign]) }}" class="button is-white">Create first pledge</a>
                            </div>
                        @endif
                    </div>
                @endif
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
                    @auth
                        <follow-button :follow="{{ json_encode($campaign->hasFollower(auth()->user())) }}" :request-url="{{ json_encode(route('campaigns.follows.store', ['campaign' => $campaign, 'user' => auth()->user()])) }}"></follow-button>
                    @endauth
                    <a href="#" class="button is-rounded is-outlined is-info">
                        <span class="icon">
                            <i class="fas fa-share-alt"></i>
                        </span>
                        <span>Share</span>
                    </a>
                </p>
                <p class="has-text-centered m-b-sm">
                    <a href="{{ route('campaigns.goals.index', ['campaign' => $campaign]) }}" class="is-size-4">Goals</a>
                </p>
                @if($campaign->goals->count())
                    <campaign-goals :goals="{{ json_encode($campaign->goals) }}" :colors="{{ json_encode($campaign->colors) }}"></campaign-goals>
                @else
                    <div class="notification">
                        <p class="m-b-md">There are no goals at the moment</p>
                        <a href="{{ route('campaigns.goals.create', ['campaign' => $campaign]) }}" class="button is-white is-fullwidth">Create first one</a>
                    </div>
                @endif
            </div>

            <div class="column is-5">
                <div class="level">
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">
                                {{ str_plural('Follower', $campaign->followersCount) }}
                            </p>
                            <p class="title">
                                {{ $campaign->followersCount }}
                            </p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Supporters</p>
                            <p class="title">0</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">
                                {{ str_plural('Post', $campaign->postsCount) }}
                            </p>
                            <p class="title">
                                {{ $campaign->posts_count }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box">
                    {!! Markdown::convertToHtml($campaign->description) !!}
                </div>
            </div>

            <div class="column is-2">
                @can('update', $campaign)
                    <a href="{{ route('campaigns.edit', compact('campaign')) }}" class="button is-rounded is-medium is-fullwidth is-light m-b-lg">
                        <span class="icon">
                            <i class="fas fa-cog"></i>
                        </span>
                        <span>Settings</span>
                    </a>
                @endcan
                <p class="has-text-centered m-b-sm">
                    <a href="{{ route('campaigns.pledges.index', ['campaign' => $campaign]) }}" class="is-size-4">Pledges</a>
                </p>
                @forelse($campaign->pledges as $pledge)
                    @include('campaigns.pledges._show', ['pledge' => $pledge, 'campaign' => $campaign, 'colors' => $campaign->colors])
                @empty
                    <div class="notification">
                        <p class="m-b-md">There are no pledges at the moment</p>
                        <a href="{{ route('campaigns.pledges.create', ['campaign' => $campaign]) }}" class="button is-white is-fullwidth">Create first one</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
