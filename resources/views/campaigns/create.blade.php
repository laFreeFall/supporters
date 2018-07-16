@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Running new campaign</h1>

                    @component('campaigns._form', compact('campaign', 'categories', 'colors'))
                        @slot('form')
                            <form method="POST" action="{{ route('campaigns.store') }}" enctype="multipart/form-data">
                                @endslot
                                @slot('submit')
                                    <div class="control">
                                        <button type="submit" class="button is-link">Preview Campaign</button>
                                    </div>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </section>
@endsection
