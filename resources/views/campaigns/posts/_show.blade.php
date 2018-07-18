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
            @else
                <p>YOU ARE NOT ALLOWED TO READ THIS POST</p>
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
            <span class="icon" title="Comments amount">
                <i class="fas fa-comments"></i>
            </span>
            <span>
                Comments: <strong>{{ $post->comments_count ?? $post->comments->count() }}</strong>
            </span>
        </div>
        <div class="card-footer-item">
            <span class="icon" title="Likes amount">
                <i class="fas fa-heart"></i>
            </span>
            <span>
                Likes: <strong>0</strong>
            </span>
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
