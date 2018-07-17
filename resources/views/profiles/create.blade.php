@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Setting up your profile data</h1>
                    @component('profiles._form', ['profile' => $blankProfile])
                        @slot('form')
                            <form method="POST" action="{{ route('profiles.store') }}" enctype="multipart/form-data">
                        @endslot
                        @slot('submit')
                            <div class="control">
                                <button type="submit" class="button is-link">Save profile</button>
                            </div>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </section>
@endsection