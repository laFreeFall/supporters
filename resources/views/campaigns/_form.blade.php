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
                    <input class="input {{ $errors->has('title') ? ' is-danger' : '' }}" value="{{ old('title', $campaign->title ?? null) }}" name="title" id="title" type="text" placeholder="Campaign title, e.g. Microsoft" required autofocus>
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
            <label class="label" for="slug">Slug</label>
        </div>
        <div class="field-body">
            <div class="field has-addons flex-wrap">
                <p class="control">
                    <a class="button is-static">
                        supporters.loc/
                    </a>
                </p>
                <div class="control is-expanded {{ $errors->has('slug') ? ' has-icons-right' : '' }}">
                    <input class="input {{ $errors->has('slug') ? ' is-danger' : '' }}" value="{{ old('slug', $campaign->slug ?? null) }}" name="slug" id="slug" type="text" placeholder="Campaign slug" required>
                    @if ($errors->has('slug'))
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @endif
                </div>
                <p class="help w-100">
                    This is how URL to your campaign will looks like
                </p>
                @if ($errors->has('slug'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('slug') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="category_id">Category</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <div class="select is-fullwidth {{ $errors->has('category_id') ? ' is-danger' : '' }}">
                        <select name="category_id" id="category_id" required>
                            <option value="" selected disabled>Choose Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id === old('category_id', $campaign->category_id ?? null) ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if ($errors->has('category_id'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('category_id') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="activity">Activity</label>
        </div>
        <div class="field-body">
            <div class="field has-addons">
                <p class="control">
                    <a class="button is-static">
                        Your campaign is...
                    </a>
                </p>
                <div class="control is-expanded {{ $errors->has('activity') ? ' has-icons-right' : '' }}">
                    <input class="input {{ $errors->has('activity') ? ' is-danger' : '' }}" value="{{ old('activity', $campaign->activity ?? null) }}" name="activity" id="activity" type="text" placeholder="What your campaign is creating" required>
                    @if ($errors->has('activity'))
                        <span class="icon is-small is-right">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                    @endif
                </div>
                @if ($errors->has('activity'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('activity') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="description">Campaign description</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <textarea class="textarea {{ $errors->has('description') ? ' is-danger' : '' }}" name="description" id="description" type="text" placeholder="A bit about your campaign (not required)">{{ old('description', $campaign->description ?? null) }}</textarea>
                </div>
                @if ($errors->has('description'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('description') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="holder">Who are you</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <label class="radio">
                        <input type="radio" name="holder" value="opc" {{ $campaign->holder ? 'checked' : '' }} required>
                        Single person (OPC)
                    </label>
                    <label class="radio">
                        <input type="radio" name="holder" value="company" {{ !$campaign->holder ? 'checked' : '' }}>
                        Public Company
                    </label>
                </div>
                @if ($errors->has('holder'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('holder') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="color_id">Background color</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <div class="select is-fullwidth {{ $errors->has('color_id') ? ' is-danger' : '' }}">
                        <select name="color_id" id="color_id">
                            <option value="" selected disabled>Pick a color</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}" class="{{ $color->background_class }} {{ $color->text_class }} select-campaign-color" {{ $color->id === old('color_id', $campaign->colors->color_id ?? null) ? 'selected' : '' }}>
                                    {{ $color->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <profile-form-avatar avatar="{{ $campaign->avatar ? $campaign->avatar_path : '' }}" errors="{{ $errors->has('avatar') ? $errors->first('avatar') : '' }}"></profile-form-avatar>

    <div class="field is-horizontal is-grouped">
        <div class="field-label"></div>
        <div class="field-body">
            <button type="submit" class="button is-link">
                {{ $button }}
            </button>
        </div>
    </div>

</form>