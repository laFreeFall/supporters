<form method="POST" action="{{ $action }}" enctype="multipart/form-data">

    {{ csrf_field() }}

    @if($method !== 'post')
        {!! method_field($method) !!}
    @endif

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="title">Title</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control {{ $errors->has('title') ? ' has-icons-right' : '' }}">
                    <input class="input {{ $errors->has('title') ? ' is-danger' : '' }}" value="{{ old('title', $post->title ?? null) }}" name="title" id="title" type="text" placeholder="Post title" required autofocus>
                    @if ($errors->has('title'))
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @endif
                </div>
                @if ($errors->has('title'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('title') }}</p>
                @endif
            </div>
        </div>
    </div>


    <markdown-textarea
        label="Body"
        name="body"
        placeholder="Write thoughts you want to share with your audience here..."
        content="{{ old('body', $post->body ?? '') }}"
        validation-error="{{ $errors->has('body') ? $errors->first('body') : '' }}"
    >
    </markdown-textarea>

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label for="tags" class="label">Tags</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <div class="select is-multiple is-fullwidth">
                        <select name="tags[]" id="tags" multiple size="5">
                            <option value="" selected disabled>Pick up some tags</option>
                            @foreach($tags as $tag)
{{--                                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $post->$tags ?? [])) ? 'selected' : '' }}>--}}
                                <option value="{{ $tag->id }}" {{ old('tags', $post->tags ?? collect([]))->contains('id', $tag->id) ? 'selected' : '' }}>
                                    [{{ $tag->id }}] {{ $tag->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <p class="help">To select multiple tags pick them with Ctrl button</p>
                @if($post->tags)
                    <p class="help">
                        @foreach($post->tags as $tag)
                            <span class="tag is-light">[{{ $tag->id }}] {{ $tag->name }}</span>
                        @endforeach
                    </p>
                @endif
            </div>
        </div>
    </div>

    <post-privacy-select
        :initial-privacies="{{ json_encode($privacies) }}"
        :initial-privacy="{{ json_encode(intval(old('privacy_id', $post->privacy_id ?? 0))) }}"
        :privacy-error="{{ json_encode($errors->has('privacy_id') ? $errors->first('privacy_id') : '') }}"

        :initial-pledges="{{ json_encode($pledges) }}"
        :initial-pledge="{{ json_encode(intval(old('pledge_id', $post->pledge_id ?? 0))) }}"
        :pledge-error="{{ json_encode($errors->has('pledge_id') ? $errors->first('pledge_id') : '') }}"
    ></post-privacy-select>

    <div class="field is-horizontal is-grouped m-t-md">
        <div class="field-label"></div>
        <div class="field-body">
            <div class="control">
                <button type="submit" class="button is-link">
                    {{ $button }}
                </button>
            </div>
        </div>
    </div>

</form>