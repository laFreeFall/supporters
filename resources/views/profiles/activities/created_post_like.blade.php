@component('profiles.activities.activity')
    @slot('title')
        <strong>{{ '@' . $profile->username }}</strong>&nbsp;
        has created new post&nbsp;
        @if($record->subject->likeable->trashed())
            <strong>"{{ $record->subject->likeable->title }}"</strong>
        @else
            <strong>
                "<a href="{{ route('campaigns.posts.show', ['campaign' => $record->subject->campaign, 'post' => $record->subject->likeable]) }}">
                    {{ $record->subject->likeable->title }}
                </a>"
            </strong>
            &nbsp;
        @endif
        {{ '@' . $record->created_at->format('H:i') }}
    @endslot

    @slot('content')
        @if($record->subject->likeable->trashed())
            <div class="notification">Post has been archived and is not available more...</div>
        @else
            @include('campaigns.posts._show_body', ['post' => $record->subject->likeable])
        @endif
    @endslot
@endcomponent