@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Adding new goal</h1>

                    @include('campaigns.goals._form', [
                        'action' => route('campaigns.goals.store', ['campaign' => $campaign]),
                        'method' => 'post',
                        'button' => 'Create Goal',
                        'goal' => $goal
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
