@extends('layouts.app')

@section('content')
    <div class="container is-fluid is-marginless">
        <div class="columns">
            <div class="column is-12">
                @include('campaign._hero', ['campaign' => $campaign])
            </div>
        </div>
        <div class="columns is-centered">
            <div class="column is-8">
                <div class="top has-text-centered">
                    <h2 class="is-size-3 m-b-md">
                        Campaign pledges
                        <span class="tag is-medium">
                        {{ $campaign->pledges->count() }}
                    </span>
                    </h2>
                    <a href="{{ route('campaign.pledge.create', ['campaign' => $campaign]) }}" class="button is-info m-b-lg">
                        Create new pledge
                    </a>
                </div>
                <div class="columns is-centered is-multiline is-variable is-7">
                    @foreach($campaign->pledges as $pledge)
                        <div class="column is-4">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-header-title is-centered">
                                        {{ $pledge->title }}
                                    </p>
                                </div>
                                <div class="card-content">
                                    <div class="content">
                                        <p>${{ $pledge->amount }} <span>per month</span></p>
                                        <p>{{ $pledge->description }}</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('campaign.pledge.edit', ['campaign' => $campaign, 'pledge' => $pledge]) }}" class="card-footer-item">
                                        <span class="icon">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        Edit
                                    </a>
                                    <a href="{{ route('campaign.pledge.delete', ['campaign' => $campaign, 'pledge' => $pledge]) }}" onclick="event.preventDefault(); document.getElementById('delete-pledge-{{ $pledge->id }}-form').submit();" class="card-footer-item">
                                        <span class="icon">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        Delete
                                    </a>
                                    <form id="delete-pledge-{{ $pledge->id }}-form" action="{{ route('campaign.pledge.delete', ['campaign' => $campaign, 'pledge' => $pledge]) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        {!! method_field('delete') !!}
                                    </form>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
