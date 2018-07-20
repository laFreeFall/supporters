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

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="body">Body</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <textarea class="textarea {{ $errors->has('body') ? ' is-danger' : '' }}" name="body" id="body" placeholder="Content of your post">{{ old('body', $post->body ?? null) }}</textarea>
                </div>
                @if ($errors->has('body'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('body') }}</p>
                @endif
            </div>
        </div>
    </div>

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

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="privacy_id">Post Privacy</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control has-icons-left">
                    <div class="select is-fullwidth {{ $errors->has('privacy_id') ? ' is-danger' : '' }}">
                        <select name="privacy_id" id="privacy_id" required>
                            <option value="" selected disabled>Choose Post Privacy Level</option>
                            @foreach($privacies as $privacy)
                                <option value="{{ $privacy->id }}" {{ $privacy->id === old('privacy_id', $post->privacy_id ?? null) ? 'selected' : '' }}>
                                    {{ $privacy->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="icon is-small is-left">
                        <i class="fas fa-globe"></i>
                    </div>
                </div>
                @if ($errors->has('privacy_id'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('privacy_id') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="field is-horizontal is-grouped">
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