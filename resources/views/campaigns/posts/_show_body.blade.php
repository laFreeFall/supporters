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
    <div class="message is-warning">You are not allowed to read this post. Support author to unlock it!</div>
@endcan