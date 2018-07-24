<div class="tabs is-medium is-centered">
    <ul>
        <li class="{{ $active === 'bio' ? 'is-active' : '' }}">
            <a href="{{ route('campaigns.show', compact('campaign')) }}">
                <span class="icon is-small"><i class="fas fa-address-book" aria-hidden="true"></i></span>
                <span>Bio</span>
            </a>
        </li>
        <li class="{{ $active === 'feed' ? 'is-active' : '' }}">
            <a href="{{ route('campaigns.posts.index', compact('campaign')) }}">
                <span class="icon is-small"><i class="fas fa-comments" aria-hidden="true"></i></span>
                <span>Feed</span>
            </a>
        </li>
        <li class="{{ $active === 'community' ? 'is-active' : '' }}">
            <a href="{{ route('campaigns.messages.index', compact('campaign')) }}">
                <span class="icon is-small"><i class="fas fa-users" aria-hidden="true"></i></span>
                <span>Community</span>
            </a>
        </li>
    </ul>
</div>