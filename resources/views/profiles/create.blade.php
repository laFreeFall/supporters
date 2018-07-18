@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Setting up your profile data</h1>

                    @include('profiles._form', [
                        'action' => route('profiles.store'),
                        'method' => 'post',
                        'button' => 'Save profile',
                        'profile' => $blankProfile
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
