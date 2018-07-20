<div class="control">
    <div class="tags has-addons">
        <a href="{{ route('campaigns.posts.index', ['campaign' => $campaign, 'tag' => $tag->name]) }}" class="tag {{ $campaign->colors->color_class }}">
            <strong>{{ $tag->name }}</strong>
            @if($tag->posts_count)
                : {{ $tag->posts_count }}
            @endif
        </a>
        <a href="{{ route('campaigns.tags.destroy', ['campaign' => $campaign, 'tag' => $tag]) }}" class="tag is-delete" onclick="event.preventDefault(); document.getElementById('destroy-tag-{{ $tag->id }}-form').submit();"></a>
    </div>
    <form id="destroy-tag-{{ $tag->id }}-form" action="{{ route('campaigns.tags.destroy', ['campaign' => $campaign, 'tag' => $tag]) }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        {!! method_field('delete') !!}
    </form>
</div>