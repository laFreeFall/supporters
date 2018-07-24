<article class="media m-t-lg">
    <figure class="media-left">
        <p class="image is-64x64">
            <img src="{{ $message->author ? $message->author->profile->avatar_path : auth()->user()->profile->avatar_path }}" alt="{{ $message->author ? $message->author->profile->username : auth()->user()->profile->username }}" class="is-rounded">
        </p>
    </figure>
    <div class="media-content">
        <form action="{{ $action }}" method="POST">

            {{ csrf_field() }}

            @if($method !== 'post')
                {!! method_field($method) !!}
            @endif

            <repliable-textarea
                content="{{ old('body', $message->body ?? '') }}"
                validation-error="{{ $errors->has('body') ? $errors->first('body') : '' }}"
            ></repliable-textarea>

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