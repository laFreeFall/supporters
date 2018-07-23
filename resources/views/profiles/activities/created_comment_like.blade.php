@component('profiles.activities.activity')
    @slot('title')
        <strong>{{ '@' . $profile->username }}</strong>&nbsp;
        has liked&nbsp;&nbsp;
        <a href="{{ route('campaigns.posts.show', ['campaign' => $record->subject->likeable->post->campaign, 'post' => $record->subject->likeable->post]) . '#comments' }}">
            comment
        </a>
        &nbsp;to the post&nbsp;
        "<a href="{{ route('campaigns.posts.show', ['campaign' => $record->subject->likeable->post->campaign, 'post' => $record->subject->likeable->post]) }}">
            {{ $record->subject->likeable->post->title }}
        </a>"
        {{ ' @' . $record->created_at->format('H:i') }}
    @endslot

    @slot('content')
        {{ $record->subject->likeable->body }}
    @endslot
@endcomponent