<div class="card m-b-lg">
    <div class="card-header">
        <a href="{{ route('campaigns.posts.show', ['campagn' => $campaign, 'post' => $post]) }}" class="card-header-title is-centered">
            {{ $post->title }}
        </a>
    </div>
    <div class="card-content">
        <div class="content">
            @can('view', $post)
                <p>{{ $post->body}}</p>
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
                <div class="message is-warning">YOU ARE NOT ALLOWED TO READ THIS POST</div>
            @endcan
        </div>
    </div>
    <div class="card-footer">
        <div class="card-footer-item">
            <span class="icon" title="Post was published on">
                <i class="fas fa-calendar-alt"></i>
            </span>
            <span>
                {{ $post->created_at->format('d M Y H:i') }}
            </span>
        </div>
        <div class="card-footer-item">
            <span class="icon" title="Post is available for">
                <i class="fas fa-globe"></i>
            </span>
            <span>
                {{ $post->privacy->title }}
            </span>
        </div>
        <div class="card-footer-item">
            <a href="{{ route('campaigns.posts.show', ['campaign' => $campaign, 'post' => $post]) . '#comments' }}">
                <span class="icon" title="Comments amount">
                    <i class="fas fa-comments"></i>
                </span>
                    <span>
                    Comments: <strong>{{ $post->comments_count ?? $post->comments->count() }}</strong>
                </span>
            </a>
        </div>
        <div class="card-footer-item">
            <like-post-button :like="{{ json_encode($post->isLiked()) }}" :amount="{{ json_encode($post->likes->count()) }}" :request-url="{{ json_encode(route('posts.likes.store', ['post' => $post]))  }}"></like-post-button>
        </div>
    </div>
    <div class="card-footer">
        @can('update', $campaign)
            <a href="{{ route('campaigns.posts.edit', ['campaign' => $campaign, 'post' => $post]) }}" class="card-footer-item">
                <span class="icon">
                    <i class="fas fa-edit"></i>
                </span>
                Edit
            </a>
            <a href="{{ route('campaigns.posts.destroy', ['campaign' => $campaign, 'post' => $post]) }}" onclick="event.preventDefault(); document.getElementById('destroy-post-{{ $post->id }}-form').submit();" class="card-footer-item">
                <span class="icon">
                    <i class="fas fa-trash"></i>
                </span>
                Delete
            </a>
            <form id="destroy-post-{{ $post->id }}-form" action="{{ route('campaigns.posts.destroy', ['campaign' => $campaign, 'post' => $post]) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
            </form>
        @endcan
    </div>
</div>
