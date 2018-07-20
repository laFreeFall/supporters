<a href="{{ route('campaigns.posts.index', ['campaign' => $campaign, 'month' => $record['month'], 'year' => $record['year']]) }}" class="tags has-addons">
        <span class="tag {{ $campaign->colors->color_class }} is-medium">
            {{ $record['month'] . ' ' .  $record['year'] }}
        </span>
    <span class="tag is-light is-medium">{{ $record['amount'] }} {{ str_plural('post', $record['amount']) }}</span>
</a>