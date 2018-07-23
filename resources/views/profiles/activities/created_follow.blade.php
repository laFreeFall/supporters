@component('profiles.activities.activity')
    @slot('title')
        <strong>{{ '@'.$profile->username }}</strong>&nbsp;
        has followed new campaign&nbsp;
        @if(! $record->subject->campaign->active)
            <strong>"{{ $record->subject->campaign->title }}"</strong>&nbsp;
        @else
            <strong>
                "<a href="{{ route('campaigns.show', ['campaign' => $record->subject->campaign]) }}">
                    {{ $record->subject->campaign->title }}
                </a>"
            </strong>
            &nbsp;
        @endif
        {{ '@' . $record->created_at->format('H:i') }}
    @endslot

    @slot('content')
        @if($record->subject->trashed())
            <div class="notification">Campaign has been closed and is not available more...</div>
        @else
            @include('campaigns._preview', ['campaign' => $record->subject->campaign, 'full' => false])
        @endif
    @endslot
@endcomponent