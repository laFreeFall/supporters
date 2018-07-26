@component('profiles.activities.activity')
    @slot('title')
        <strong>{{ '@'.$profile->username }}</strong>&nbsp;
        has followed campaign&nbsp;
        @if(! $record->subject->active)
            <strong>"{{ $record->subject->title }}"</strong>&nbsp;
        @else
            <strong>
                "<a href="{{ route('campaigns.show', ['campaign' => $record->subject]) }}">
                    {{ $record->subject->title }}
                </a>"
            </strong>
            &nbsp;
        @endif
        {{ '@' . $record->created_at->format('H:i') }}
    @endslot

    @slot('content')
        @if(! $record->subject->active)
            <div class="notification">Campaign has been closed and is not available more...</div>
        @else
            @include('campaigns._preview', ['campaign' => $record->subject, 'full' => false])
        @endif
    @endslot
@endcomponent