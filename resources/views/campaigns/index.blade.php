@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid is-marginless">
            <h1 class="title has-text-centered">Currently {{ $campaigns->count() }} campaigns are running...</h1>
            <div class="has-text-centered">
                {{--<h2 class="subtitle">Filter by</h2>--}}
                <form>
                    <div class="select">
                        <select name="category">
                            <option value="all">All categories</option>
                            @foreach($categories as $category)
                                <option value="{{ strtolower($category->title) }}" {{ request('category') === strtolower($category->title) ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="select">
                        <select name="holder">
                            <option value="all">All companies</option>
                            <option value="company" {{ request('holder') === 'company' ? 'selected' : '' }}>Public Companies</option>
                            <option value="single" {{ request('holder') === 'single' ? 'selected' : '' }}>One Man Companies</option>
                        </select>
                    </div>
                    <button type="submit" class="button is-info">Filter</button>
                </form>
            </div>
            <div class="columns is-multiline is-centered">
                @foreach($campaigns as $campaign)
                    <div class="column is-4">
                        @include('campaigns._preview', ['campaign' => $campaign, 'full' => false])
                    </div>
                @endforeach
                <div class="m-t-md">
                    {{ $campaigns->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection
