@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Adding new pledge</h1>

                    @component('campaigns.pledges._form', compact('pledge'))
                        @slot('form')
                            <form method="POST" action="{{ route('campaigns.pledges.store', ['campaign' => $campaign]) }}">
                        @endslot
                        @slot('submit')
                            <div class="control">
                                <button type="submit" class="button is-link">Create Pledge</button>
                            </div>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </section>
@endsection
