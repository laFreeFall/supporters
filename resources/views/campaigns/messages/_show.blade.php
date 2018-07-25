<article class="media" id="comment-{{ $message->id }}">
    <figure class="media-left">
        <p class="image is-64x64">
            <img src="{{ $message->author->profile->avatar_path }}" alt="{{ $message->author->profile->username }}" class="is-rounded">
        </p>
    </figure>
    <div class="media-content">
        <div class="content">
            <p>
                <strong>{{ $message->author->profile->full_name }}</strong>
                <small>{{ '@' . $message->author->profile->username }}</small>
                @if($message->repliable_id)
                    <small>replied to {{ '@' . $message->parent->author->profile->username }} ({{ '#' . $message->repliable_id }})</small>
                @endif
                <small>{{ $message->created_at->diffForHumans() }}</small>
                <br>
                {{ $message->body }}
            </p>
        </div>
        <nav class="level is-mobile">
            <div class="level-left">
                <like-comment-button
                    :like="{{ json_encode($message->isLiked()) }}"
                    :amount="{{ json_encode($message->likes->count()) }}"
                    :request-url="{{ json_encode(route('messages.likes.store', compact('message')))  }}"
                >
                </like-comment-button>
                <a class="level-item reply-to-button" onclick="replyTo('{{ $message->author->profile->username }}', {{ $message->id }})">
                    <span class="icon is-small"><i class="fas fa-reply"></i></span>
                    &nbsp;Reply
                </a>
            </div>
        </nav>
        @if(isset($message->childs))
            @foreach($message->childs as $child)
                @include('campaigns.messages._show', ['campaign' => $campaign, 'message' => $child])
            @endforeach
        @endif
    </div>
    @can('update', $message)
        <div class="media-right">
            <div class="buttons has-addons">
                <a href="{{ route('campaigns.messages.edit', compact('campaign', 'message')) }}" class="button is-small" title="Edit message">
                    <span class="icon is-small">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                </a>
                <a href="{{ route('campaigns.messages.destroy', compact('campaign', 'message')) }}" class="button is-small" title="Delete message" onclick="event.preventDefault(); document.getElementById('destroy-message-{{ $message->id }}-form').submit();">
                    <span class="icon is-small">
                        <i class="fas fa-trash"></i>
                    </span>
                </a>
            </div>
            <form id="destroy-message-{{ $message->id }}-form" action="{{ route('campaigns.messages.destroy', compact('campaign', 'message')) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
            </form>
        </div>
    @endcan
</article>