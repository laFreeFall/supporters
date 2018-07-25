@component('profiles.activities.activity')
    @slot('title')
        <strong>{{ '@' . $profile->username }}</strong>&nbsp;
        liked&nbsp;&nbsp;
        <a href="{{ route('campaigns.posts.show', ['campaign' => $record->subject->post->campaign, 'post' => $record->subject->post]) . '#comments' }}">
            comment
        </a>
        &nbsp;to the post&nbsp;
        "<a href="{{ route('campaigns.posts.show', ['campaign' => $record->subject->post->campaign, 'post' => $record->subject->post]) }}">
            {{ $record->subject->post->title }}
        </a>"
        {{ ' @' . $record->created_at->format('H:i') }}
    @endslot

    @slot('content')
        {{ $record->subject->body }}
    @endslot
@endcomponent