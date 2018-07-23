@component('profiles.activities.activity')
    @slot('title')
        <strong>{{ '@' . $profile->username }}</strong>&nbsp;
        has liked post&nbsp;
        @if($record->subject->trashed())
            <strong>"{{ $record->subject->title }}"</strong>
        @else
            <strong>
                "<a href="{{ route('campaigns.posts.show', ['campaign' => $record->subject->campaign, 'post' => $record->subject]) }}">
                    {{ $record->subject->title }}
                </a>"
            </strong>
            &nbsp;
        @endif
        {{ ' @' . $record->created_at->format('H:i') }}
    @endslot

    @slot('content')
        @if($record->subject->trashed())
            <div class="notification">Post has been archived and is not available more...</div>
        @else
            @include('campaigns.posts._show_body', ['post' => $record->subject])
        @endif
    @endslot
@endcomponent