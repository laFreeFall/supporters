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
                                    <img src="{{ $profile->avatar_path }}" alt="{{ $profile->fullName }}" class="is-rounded">
                                </figure>
                                <span class="is-size-2">
                            {{ $profile->fullName }}
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
                                <p class="heading">
                                    {{ str_plural('Campaign', $profile->user->campaignsCount) }} run
                                </p>
                                <p class="title">
                                    {{ $profile->user->campaignsCount }}
                                </p>
                            </div>
                        </div>
                        <div class="level-item is-narrow has-text-centered">
                            <div>
                                <p class="heading">
                                    {{ str_plural('Campaign', $profile->user->followsCount) }} followed
                                </p>
                                <p class="title">
                                    {{ $profile->user->followsCount }}
                                </p>
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
                                <p class="heading">
                                    {{ str_plural('Post', $profile->user->postsCount) }} created
                                </p>
                                <p class="title">
                                    {{ $profile->user->postsCount }}
                                </p>
                            </div>
                        </div>
                        <div class="level-item is-narrow has-text-centered">
                            <div>
                                <p class="heading">
                                    {{ str_plural('Comment', $profile->user->commentsCount) }} wrote
                                </p>
                                <p class="title">
                                    {{ $profile->user->commentsCount }}
                                </p>
                            </div>
                        </div>
                        <div class="level-item is-narrow has-text-centered">
                            <div>
                                <p class="heading">
                                    {{ str_plural('Record', $profile->user->likesCount) }} liked
                                </p>
                                <p class="title">
                                    {{ $profile->user->likesCount }}
                                </p>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
