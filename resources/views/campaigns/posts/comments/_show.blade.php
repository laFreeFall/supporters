<article class="media">
    <figure class="media-left">
        <p class="image is-64x64">
            <img src="{{ $comment->author->profile->avatar_path }}" alt="{{ $comment->author->profile->username }}" class="is-rounded">
        </p>
    </figure>
    <div class="media-content">
        <div class="content">
            <p>
                <strong>{{ $comment->author->profile->full_name }}</strong> <small>{{ '@' . $comment->author->profile->username }}</small> <small>{{ $comment->created_at->diffForHumans() }}</small>
                <br>
                {{ $comment->body }}
            </p>
        </div>
        <nav class="level is-mobile">
            <div class="level-left">
                <like-comment-button :like="{{ json_encode($comment->isLiked()) }}" :amount="{{ json_encode($comment->likes->count()) }}" :request-url="{{ json_encode(route('comments.likes.store', ['comment' => $comment]))  }}"></like-comment-button>
                <a class="level-item">
                    <span class="icon is-small"><i class="fas fa-reply"></i></span>
                    &nbsp;Reply
                </a>
            </div>
        </nav>
    </div>
    <div class="media-right">
        <div class="buttons has-addons">
            <a href="{{ route('campaigns.posts.comments.edit', ['campaign' => $campaign, 'post' => $post, 'comment' => $comment]) }}" class="button is-small" title="Edit comment">
                <span class="icon is-small">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                {{--<span>--}}
                    {{--Edit--}}
                {{--</span>--}}
            </a>
            <a href="{{ route('campaigns.posts.comments.destroy', ['campaign' => $campaign, 'post' => $post, 'comment' => $comment]) }}" class="button is-small" title="Delete comment" onclick="event.preventDefault(); document.getElementById('destroy-comment-{{ $comment->id }}-form').submit();">
                <span class="icon is-small">
                    <i class="fas fa-trash"></i>
                </span>
                {{--<span>--}}
                    {{--Delete--}}
                {{--</span>--}}
            </a>
        </div>
    </div>
    <form id="destroy-comment-{{ $comment->id }}-form" action="{{ route('campaigns.posts.comments.destroy', ['campaign' => $campaign, 'post' => $post, 'comment' => $comment]) }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        {!! method_field('delete') !!}
    </form>
</article>