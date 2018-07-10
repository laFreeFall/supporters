@extends('layouts.app')

@section('content')
<div class="columns is-centered">
    <div class="column is-4">
        <h1 class="title has-text-centered">Password resetting</h1>

        <form method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="email">Email</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control has-icons-left {{ $errors->has('email') ? ' has-icons-right' : '' }}">
                            <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}" value="{{ old('email') }}" name="email" id="email" type="email" placeholder="Enter email" required autofocus>
                            <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                            @if ($errors->has('email'))
                                <span class="icon is-small is-right">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @endif
                        </div>
                        @if ($errors->has('email'))
                            <p class="help is-danger has-text-weight-bold">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="password">Password</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control has-icons-left {{ $errors->has('password') ? ' has-icons-right' : '' }}">
                            <input class="input {{ $errors->has('password') ? ' is-danger' : '' }}" name="password" id="password" type="password" placeholder="Enter password" required>
                            <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                            @if ($errors->has('password'))
                                <span class="icon is-small is-right">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @endif
                        </div>
                        @if ($errors->has('password'))
                            <p class="help is-danger has-text-weight-bold">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="password">Password Confirmation</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control has-icons-left {{ $errors->has('password_confirmation') ? ' has-icons-right' : '' }}">
                            <input class="input {{ $errors->has('password_confirmation') ? ' is-danger' : '' }}" name="password" id="password" type="password" placeholder="Enter password confirmation" required>
                            <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                            @if ($errors->has('password_confirmation'))
                                <span class="icon is-small is-right">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @endif
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <p class="help is-danger has-text-weight-bold">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="field is-horizontal is-grouped">
                <div class="field-label"></div>
                <div class="field-body">
                    <div class="control">
                        <button type="submit" class="button is-primary">Reset Password</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
