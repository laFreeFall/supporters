@extends('layouts.app')

@section('content')
<div class="columns is-centered">
    <div class="column is-3">
        <h1 class="title has-text-centered">Password resetting</h1>

        @if (session('status'))
            <article class="message is-success">
                <div class="message-header">
                    <p>Status</p>
                </div>
                <div class="message-body">
                    {{ session('status') }}
                </div>
            </article>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

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

            <div class="field is-horizontal is-grouped">
                <div class="field-label"></div>
                <div class="field-body">
                    <div class="control">
                        <button type="submit" class="button is-link">Send Password Reset Link</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
