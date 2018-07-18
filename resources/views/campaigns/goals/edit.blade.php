@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Editing goal</h1>

                    @include('campaigns.goals._form', [
                        'action' => route('campaigns.goals.update', ['campaign' => $campaign, 'goal' => $goal]),
                        'method' => 'patch',
                        'button' => 'Update Goal',
                        'goal' => $goal
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
