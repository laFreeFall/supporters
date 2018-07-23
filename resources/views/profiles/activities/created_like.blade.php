@if(class_basename($record->subject->likeable) === 'Post')
    @include('profiles.activities.created_post_like', compact('record', 'profile'))
@elseif(class_basename($record->subject->likeable) === 'Comment')
    @include('profiles.activities.created_comment_like', compact('record', 'profile'))
@endif