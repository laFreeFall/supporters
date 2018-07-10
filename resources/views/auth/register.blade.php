@extends('layouts.app')

@section('content')
<div class="columns is-centered">
    <div class="column is-4">
        <h1 class="title has-text-centered">Creating a Profile</h1>

        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="name">Login</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control has-icons-left {{ $errors->has('name') ? ' has-icons-right' : '' }}">
                            <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" value="{{ old('name') }}" name="name" id="name" type="text" placeholder="Enter login" required autofocus>
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
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

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="email">Email</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control has-icons-left {{ $errors->has('email') ? ' has-icons-right' : '' }}">
                            <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}" value="{{ old('email') }}" name="email" id="email" type="email" placeholder="Enter email" required>
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
                    <label class="label" for="password">Password confirmation</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input" name="password_confirmation" id="password_confirmation" type="password" placeholder="Enter your password again" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label"></div>
                <div class="field-body">
                    <div class="control">
                        <button type="submit" class="button is-link">Register</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
