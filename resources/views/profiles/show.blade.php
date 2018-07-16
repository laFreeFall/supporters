@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <figure class="image is-64x64 is-rounded">
                                    <img src="{{ $profile->avatar_path }}" alt="{{ $profile->full_name }}" class="">
                                </figure>
                                <span class="is-size-2">
                            {{ $profile->full_name }}
                        </span>
                        <span class="is-size-3 has-text-grey-light">
                            ({{ '@' . $profile->username }})
                        </span>
                            </div>
                        </div>
                        <div class="level-right">
                            <h2 class="subtitle is-4">
                                <span>member since {{ $profile->user->created_at->format('d M Y') }}</span>
                            </h2>
                        </div>
                    </div>
                    <h3 class="title is-3 has-text-centered">Activity summary</h3>
                    <nav class="level">
                        <div class="level-item is-narrow has-text-centered">
                            <div>
                                <p class="heading">Campaigns run</p>
                                <p class="title">0</p>
                            </div>
                        </div>
                        <div class="level-item is-narrow has-text-centered">
                            <div>
                                <p class="heading">Campaigns followed</p>
                                <p class="title">0</p>
                            </div>
                        </div>
                        <div class="level-item is-narrow has-text-centered">
                            <div>
                                <p class="heading">Campaigns supported</p>
                                <p class="title">0</p>
                            </div>
                        </div>
                        <div class="level-item is-narrow has-text-centered">
                            <div>
                                <p class="heading">Comments left</p>
                                <p class="title">0</p>
                            </div>
                        </div>
                        <div class="level-item is-narrow has-text-centered">
                            <div>
                                <p class="heading">Posts liked</p>
                                <p class="title">0</p>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
