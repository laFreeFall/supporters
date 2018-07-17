{{ $form }}
    {{ csrf_field() }}
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
            {{ $submit }}
        </div>
    </div>
</form>