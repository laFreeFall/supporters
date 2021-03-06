<article class="message {{ $campaign->colors->color_class }}">
    @if($full)
        <div class="message-header">
            <p class="is-size-5 has-text-centered">Campaign front page preview</p>
        </div>
    @endif
    <div class="message-body">
        <section class="hero is-clipped {{ $campaign->colors->color_class }} is-bold">
            <div class="hero-body {{ $full ? '' : 'p-t-lg p-b-md' }}">
                <div class="container">
                    <div class="columns is-vcentered">
                        <div class="col">
                            <figure class="image is-64x64">
                                <img src="{{ $campaign->avatar_path }}" alt="{{ $campaign->title }}" class="is-rounded">
                            </figure>
                        </div>
                        <div class="col m-l-sm">
                            <h1 class="title {{ !$full ? 'is-size-4' : '' }}">
                                <a href="{{ route('campaigns.show', $campaign) }}" class="no-underline">{{ $campaign->title }}</a> <span class="has-text-weight-normal">is {{ $campaign->activity }}</span>
                            </h1>
                        </div>
                    </div>
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
                    <h2 class="subtitle">
                        <span>
                            <span class="icon">
                                <i class="fas fa-user-friends"></i>
                            </span>
                            {{ $campaign->followers_count }} {{ str_plural('follower', $campaign->followers_count) }}
                        </span>

                        <span class="m-l-lg">
                            <span class="icon">
                                <i class="fas fa-user-friends"></i>
                            </span>
                            0
                            supporters
                        </span>

                        <span class="m-l-lg">
                            <span class="icon">
                                <i class="fas fa-clipboard"></i>
                            </span>
                            {{ $campaign->posts_count }} {{ str_plural('post', $campaign->posts_count) }}
                        </span>
                    </h2>
                </div>
            </div>
        </section>
        @if($full)
            <article class="message m-t-md">
                <div class="message-body">
                    {{ $campaign->description }}
                </div>
            </article>
        @endif
    </div>
</article>