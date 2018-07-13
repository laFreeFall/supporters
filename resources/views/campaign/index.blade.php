@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <h1 class="title has-text-centered">Currently {{ $campaigns->count() }} campaigns are running...</h1>
            <div class="has-text-centered">
                {{--<h2 class="subtitle">Filter by</h2>--}}
                <div class="select">
                    <select>
                        <option>All categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="select">
                    <select>
                        <option>All companies</option>
                        <option>Public Companies</option>
                        <option>One Man Companies</option>
                    </select>
                </div>

            </div>
            <div class="columns is-multiline is-centered">
                @foreach($campaigns as $campaign)
                    <div class="column is-4">
                        @include('campaign._preview', ['campaign' => $campaign, 'full' => false])
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
