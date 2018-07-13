@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <div class="columns is-centered">
                <div class="column is-6">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Your campaign URL</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                                    <input type="text" class="input is-rounded" readonly value="{{ route('campaign.show', ['campaign' => $campaign]) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('campaign._preview', ['campaign' => $campaign, 'full' => true])
                    <a href="{{ route('campaign.edit', $campaign) }}" class="button is-warning">Back to editing!</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('restore-form').submit();" class="button is-primary">OK, run a campaign!</a>
                    <form id="restore-form" action="{{ route('campaign.restore', $campaign) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
