@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Adding new goal</h1>

                    @component('campaign.goal._form', compact('goal'))
                        @slot('form')
                            <form method="POST" action="{{ route('campaign.goal.store', ['campaign' => $campaign]) }}">
                        @endslot
                        @slot('submit')
                            <div class="control">
                                <button type="submit" class="button is-link">Create Goal</button>
                            </div>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </section>
@endsection
