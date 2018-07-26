@can('view', $post)
    {!! Markdown::convertToHtml($post->body) !!}
    <hr>
    @if($post->tags->count())
        <strong>Tags</strong>:
        @foreach($post->tags as $tag)
            <span class="tag is-light">
                {{ $tag->name }}
            </span>
        @endforeach
    @endif
@else
    <div class="notification">
        You are not allowed to read this post.
        <br>
        @if($post->pledge)
            <a href="{{ route('campaigns.pledges.index', ['campaign' => $post->campaign]) }}" class="is-link">Support author</a> for ${{ $post->pledge->amount }}+ (<span class="is-italic">{{ $post->pledge->title }}</span> pledge) to unlock it!
        @else
            <a href="{{ route('campaigns.pledges.index', ['campaign' => $post->campaign]) }}" class="is-link">Follow the campaign</a> to unlock it!
        @endif
    </div>
@endcan