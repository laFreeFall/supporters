<article class="media m-t-lg">
    <figure class="media-left">
        <p class="image is-64x64">
            <img src="{{ $comment->author ? $comment->author->profile->avatar_path : auth()->user()->profile->avatar_path }}" alt="{{ $comment->author ? $comment->author->profile->username : auth()->user()->profile->username }}" class="is-rounded">
        </p>
    </figure>
    <div class="media-content">
        <form action="{{ $action }}" method="POST">

            {{ csrf_field() }}

            @if($method !== 'post')
                {!! method_field($method) !!}
            @endif

            <div class="field">
                <div class="control">
                    <textarea class="textarea {{ $errors->has('body') ? ' is-danger' : '' }}" name="body" placeholder="Post your comment...">{{ old('body', $comment->body ?? null) }}</textarea>
                </div>

                @if ($errors->has('body'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('body') }}</p>
                @endif
            </div>

            <div class="field ">
                <div class="control">
                    <button class="button is-link" type="submit">
                        {{ $button }}
                    </button>
                </div>
            </div>

        </form>
    </div>
</article>