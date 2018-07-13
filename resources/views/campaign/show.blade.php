@extends('layouts.app')

@section('content')
    <div class="container is-fluid is-marginless">
        <div class="columns">
            <div class="column is-12">
                <section class="hero is-clipped {{ $campaign->color->color_class }} is-bold">
                    <div class="hero-body">
                        <div class="container">
                            <div class="columns is-vcentered">
                                <div class="col">
                                    <figure class="image is-64x64">
                                        <img src="{{ $campaign->avatar_path }}" alt="{{ $campaign->title }}" class="is-rounded">
                                    </figure>
                                </div>
                                <div class="col m-l-sm">
                                    <h1 class="title">
                                        <a href="{{ route('campaign.show', $campaign) }}" class="no-underline">{{ $campaign->title }}</a> <span class="has-text-weight-normal">is {{ $campaign->activity }}</span>
                                    </h1>
                                    <h2 class="subtitle">
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-{{ $campaign->category->icon }}"></i>
                                        </span>
                                        {{ $campaign->category->title }}
                                    </span>
                                        <span class="m-l-xl">
                                        <span class="icon">
                                            <i class="fas fa-{{ $campaign->holder ? 'user' : 'users' }}"></i>
                                        </span>
                                            {{ $campaign->holder ? 'One Person Company' : 'Public Company' }}
                                    </span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="columns is-centered">
            <div class="column is-2">
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
                <p class="buttons has-text-centered">
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
                <p>Goals...</p>
            </div>
            <div class="column is-5">
                <div class="box">
                    {{ $campaign->description }}
                </div>
            </div>
            <div class="column is-2">
                <a href="#" class="button is-rounded is-medium is-fullwidth {{ $campaign->color->color_class }}">
                    <span class="icon">
                        <i class="fas fa-hands-helping"></i>
                    </span>
                    <span>Support</span>
                </a>
                <p>Pledges...</p>
            </div>
        </div>
    </div>
@endsection
