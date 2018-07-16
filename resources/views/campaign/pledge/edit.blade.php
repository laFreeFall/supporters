@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Editing pledge</h1>

                    @component('campaign.pledge._form', compact('pledge'))
                        @slot('form')
                            <form method="POST" action="{{ route('campaign.pledge.update', ['campaign' => $campaign, 'pledge' => $pledge]) }}">
                            {!! method_field('patch') !!}
                        @endslot
                        @slot('submit')
                            <div class="control">
                                <button type="submit" class="button is-link">Update Pledge</button>
                            </div>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </section>
@endsection
