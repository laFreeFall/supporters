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
        <a
            href="{{ route('campaigns.pledges.index', ['campaign' => $campaign]) }}"
            class="card-footer-item button {{ $colors->color_class }}"
            {{ $currentSupport ? $currentSupport->amount >= $pledge->amount ? 'disabled' : '' : '' }}
        >
            Support for ${{ $pledge->amount }}
        </a>
    </div>
</div>
