@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Editing campaign</h1>
                    @component('campaigns._form', compact('campaign', 'categories', 'colors'))
                        @slot('form')
                            <form method="POST" action="{{ route('campaigns.update', $campaign) }}" enctype="multipart/form-data">
                                {!! method_field('patch') !!}
                                @endslot
                                @slot('submit')
                                    <div class="control">
                                        <button type="submit" class="button is-link">Save changes</button>
                                    </div>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </section>
@endsection
