<div class="top has-text-centered">
    <h2 class="is-size-3 m-b-md">
        Tags
        <span class="tag is-medium">
            {{ $tags->count() }}
        </span>
    </h2>
</div>
@if($tags->count())
    <div class="field is-grouped is-grouped-multiline">
        @foreach($tags as $tag)
            @include('campaigns.tags._show', compact('campaign', 'tag'))
        @endforeach
    </div>
@else
    <div class="notification">
        There are no tags at the moment. Add one below!
    </div>
@endif