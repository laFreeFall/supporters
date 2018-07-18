@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-4">
                    <h1 class="title has-text-centered">Editing pledge</h1>

                    @include('campaigns.pledges._form', [
                        'action' => route('campaigns.pledges.update', ['campaign' => $campaign, 'pledge' => $pledge]),
                        'method' => 'patch',
                        'button' => 'Update Pledge',
                        'pledge' => $pledge
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
