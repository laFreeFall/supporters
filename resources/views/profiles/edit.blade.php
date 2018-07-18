@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Editing your profile data</h1>

                    @include('profiles._form', [
                        'action' => route('profiles.update', ['profile' => auth()->user()->profile]),
                        'method' => 'patch',
                        'button' => 'Update profile',
                        'profile' => auth()->user()->profile
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
