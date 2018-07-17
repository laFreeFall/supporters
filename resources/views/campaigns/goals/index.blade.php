@extends('layouts.app')

@section('content')
    <div class="container is-fluid is-marginless">
        <div class="columns">
            <div class="column is-12">
                @include('campaigns._hero', ['campaign' => $campaign])
            </div>
        </div>
        <div class="columns is-centered">
            <div class="column is-8">
                <div class="top has-text-centered">
                    <h2 class="is-size-3 m-b-md">
                        Campaign goals
                        <span class="tag is-medium">
                            {{ $campaign->goals->count() }}
                        </span>
                    </h2>
                    @can('update', $campaign)
                        <a href="{{ route('campaigns.goals.create', ['campaign' => $campaign]) }}" class="button is-info m-b-lg">
                            Create new goal
                        </a>
                    @endcan
                </div>
                <div class="columns is-centered is-multiline is-variable is-7">
                    @foreach($campaign->goals as $goal)
                        <div class="column is-4">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-header-title is-centered">
                                        {{ $goal->title }}
                                    </p>
                                </div>
                                <div class="card-content">
                                    <div class="content">
                                        <p>{{ $goal->amount }} <span>per month</span></p>
                                        <progress class="progress {{ $campaign->colors->color_class }}" value="{{ $goal->progress }}" max="100">{{ $goal->progress }}%</progress>
                                        <p>{{ $goal->description }}</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    @can('update', $campaign)
                                        <a href="{{ route('campaigns.goals.edit', ['campaign' => $campaign, 'goal' => $goal]) }}" class="card-footer-item">
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                            Edit
                                        </a>
                                    @endcan
                                    @can('update', $campaign)
                                        <a href="{{ route('campaigns.goals.destroy', ['campaign' => $campaign, 'goal' => $goal]) }}" onclick="event.preventDefault(); document.getElementById('destroy-goal-{{ $goal->id }}-form').submit();" class="card-footer-item">
                                            <span class="icon">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            Delete
                                        </a>
                                        <form id="destroy-goal-{{ $goal->id }}-form" action="{{ route('campaigns.goals.destroy', ['campaign' => $campaign, 'goal' => $goal]) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            {!! method_field('delete') !!}
                                        </form>
                                    @endcan
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
