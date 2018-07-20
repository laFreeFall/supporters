@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-6">
                    <h1 class="title has-text-centered">Editing campaign</h1>

                    @include('campaigns._form', [
                        'action' => route('campaigns.update', $campaign),
                        'method' => 'patch',
                        'button' => 'Save changes',
                        'campaign' => $campaign,
                        'categories' => $categories,
                        'colors' => $colors
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
