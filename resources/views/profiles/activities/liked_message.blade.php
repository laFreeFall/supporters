@component('profiles.activities.activity')
    @slot('title')
        <strong>{{ '@' . $profile->username }}</strong>&nbsp;
        liked&nbsp;&nbsp;
        <a href="{{ route('campaigns.messages.index', ['campaign' => $record->subject->campaign])}}">
            message
        </a>
        &nbsp;to the campaign&nbsp;
        "<a href="{{ route('campaigns.show', ['campaign' => $record->subject->campaign]) }}">
            {{ $record->subject->campaign->title }}
        </a>"
        {{ ' @' . $record->created_at->format('H:i') }}
    @endslot

    @slot('content')
        {{ $record->subject->body }}
    @endslot
@endcomponent