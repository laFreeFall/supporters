<form method="POST" action="{{ $action }}">
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
                    <input class="input {{ $errors->has('title') ? ' is-danger' : '' }}" value="{{ old('title', $pledge->title ?? null) }}" name="title" id="title" type="text" placeholder="Pledge title" required autofocus>
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
            <label class="label" for="privileges">Privileges</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <textarea class="textarea {{ $errors->has('privileges') ? ' is-danger' : '' }}" name="privileges" id="privileges" placeholder="A bit about what you will your supporters get">{{ old('privileges', $pledge->privileges ?? null) }}</textarea>
                </div>
                @if ($errors->has('privileges'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('privileges') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label" for="amount">Amount</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control {{ $errors->has('amount') ? ' has-icons-right' : '' }}">
                    <input class="input {{ $errors->has('amount') ? ' is-danger' : '' }}" value="{{ old('title', $pledge->amount ?? null) }}" name="amount" id="amount" type="number" step="1" min="0" placeholder="Pledge amount">
                    @if ($errors->has('amount'))
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @endif
                </div>
                @if ($errors->has('amount'))
                    <p class="help is-danger has-text-weight-bold">{{ $errors->first('amount') }}</p>
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