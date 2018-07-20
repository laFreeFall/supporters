<div class="top has-text-centered">
    <h2 class="is-size-3 m-b-md">
        Archives
    </h2>
</div>
@forelse($archives as $record)
    @include('campaigns.archives._show', compact('campaign', 'record'))
@empty
    <div class="notification">
        There are no archives at the moment.
    </div>
@endforelse