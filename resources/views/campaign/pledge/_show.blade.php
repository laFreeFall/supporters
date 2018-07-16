<div class="card m-b-md">
    <div class="card-header">
        <p class="card-header-title is-centered">
            {{ $pledge->title }}
        </p>
    </div>
    <div class="card-content">
        <div class="content">
            {{ $pledge->privileges }}
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('campaign.pledge.index', ['campaign' => $campaign]) }}" class="card-footer-item {{ $colors->background_class }} {{ $colors->text_class }}">Support for ${{ $pledge->amount }}</a>
    </div>
</div>
