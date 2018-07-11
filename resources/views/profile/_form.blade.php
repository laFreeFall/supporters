{{ $form }}
    {{ csrf_field() }}
    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="first_name">First Name</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control {{ $errors->has('first_name') ? ' has-icons-right' : '' }}">
                    <input class="input {{ $errors->has('first_name') ? ' is-danger' : '' }}" value="{{ old('first_name', $profile->first_name ?? null) }}" name="first_name" id="first_name" type="text" placeholder="Your first name" required autofocus>
                    @if ($errors->has('first_name'))
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @endif
                </div>
                @if ($errors->has('first_name'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('first_name') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="last_name">Last Name</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control {{ $errors->has('last_name') ? ' has-icons-right' : '' }}">
                    <input class="input {{ $errors->has('last_name') ? ' is-danger' : '' }}" value="{{ old('last_name', $profile->last_name ?? null) }}" name="last_name" id="last_name" type="text" placeholder="Your last name" required>
                    @if ($errors->has('last_name'))
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @endif
                </div>
                @if ($errors->has('last_name'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('last_name') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="bio">Your Bio</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <textarea class="textarea {{ $errors->has('bio') ? ' is-danger' : '' }}" name="bio" id="bio" type="text" placeholder="A bit about yourself (not required)">{{ old('bio', $profile->bio ?? null) }}</textarea>
                </div>
                @if ($errors->has('bio'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('bio') }}</p>
                @endif
            </div>
        </div>
    </div>

    <pre>{{ $profile->avatar_path }}</pre>
<hr>
    <pre>{{ $errors->has('avatar') ? json_decode($errors->first('avatar')) : null }}</pre>

    <profile-form-avatar avatar="{{ json_decode($profile->avatar_path) }}" errors="{{ $errors->has('avatar') ? json_decode($errors->first('avatar')) : null }}"></profile-form-avatar>
{{--    <profile-form-avatar :avatar="{{ json_decode($profile->avatar_path) }}" :errors="{{ $errors->has('avatar') ? json_decode($errors->first('avatar')) : null }}"></profile-form-avatar>--}}

    <div class="field is-horizontal is-grouped">
        <div class="field-label"></div>
        <div class="field-body">
            {{ $submit }}
        </div>
    </div>
</form>