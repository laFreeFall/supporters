<section class="hero is-clipped {{ $campaign->colors->color_class }} is-bold">
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
                        <a href="{{ route('campaigns.show', $campaign) }}" class="no-underline">{{ $campaign->title }}</a> <span class="has-text-weight-normal">is {{ $campaign->activity }}</span>
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