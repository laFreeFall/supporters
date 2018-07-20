<form method="POST" action="{{ $action }}">

    {{ csrf_field() }}

    @if($method !== 'post')
        {!! method_field($method) !!}
    @endif

    <div class="field is-horizontal">
        <div class="field-body">
            <div class="field">
                <div class="control {{ $errors->has('name') ? ' has-icons-right' : '' }}">
                    <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" value="{{ old('name', $tag->name ?? null) }}" name="name" id="name" type="text" placeholder="Tag name" required autofocus>
                    @if ($errors->has('name'))
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @endif
                </div>
                @if ($errors->has('name'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('name') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="field is-horizontal is-grouped">
        <div class="field-body">
            <button type="submit" class="button {{ $campaign->colors->color_class }} is-fullwidth">
                {{ $button }}
            </button>
        </div>
    </div>

</form>