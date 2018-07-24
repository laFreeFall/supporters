@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Editing message</h1>

                    @include('campaigns.messages._form', [
                        'action' => route('campaigns.messages.update', compact('campaign', 'message')),
                        'method' => 'patch',
                        'button' => 'Save changes',
                        'message' => $message,
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
