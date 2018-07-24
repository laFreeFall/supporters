@extends('layouts.app')

@section('content')
    <div class="container is-fluid is-marginless">
        <div class="columns is-multiline">
            <div class="column is-12">
                @include('campaigns._hero', ['campaign' => $campaign])
            </div>
            <div class="column is-12">
                @include('campaigns._tabs', ['active' => 'community'])
            </div>
        </div>
        <div class="columns is-centered">
            <div class="column is-6">
                <div class="top has-text-centered">
                    <h2 class="is-size-3 m-b-md">
                        Community messages
                        <span class="tag is-medium">
                            {{ $messages->total() }}
                        </span>
                    </h2>
                    {{--@can('update', $campaign)--}}
                        {{--<a href="{{ route('campaigns.messages.create', ['campaign' => $campaign]) }}" class="button {{ $campaign->colors->color_class }} m-b-lg">--}}
                            {{--Post new message--}}
                        {{--</a>--}}
                    {{--@endcan--}}
                </div>
                @foreach($messages as $message)
                    @include('campaigns.messages._show', ['campaign' => $campaign, 'message' => $message])

                @endforeach
                <div class="m-t-md">
                    {{ $messages->links() }}
                </div>
                @auth
                    @include('campaigns.messages._form', [
                        'action' => route('campaigns.messages.store', compact('campaign')),
                        'method' => 'post',
                        'button' => 'Add message',
                        'message' => $emptyMessage,
                    ])
                @endauth
            </div>
        </div>
    </div>
@endsection
