@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Running new campaign</h1>

                    @include('campaigns._form', [
                        'action' => route('campaigns.store'),
                        'method' => 'post',
                        'button' => 'Preview Campaign',
                        'campaign' => $campaign,
                        'categories' => $categories,
                        'colors' => $colors
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
