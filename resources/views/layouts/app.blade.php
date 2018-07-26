<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Supporters') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('scripts')

</head>
<body>
    <div id="app">
        <nav class="navbar is-light" role="navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://bulma.io">
                    <span class="icon">
                        <i class="fas fa-hands-helping"></i>
                    </span>
                    <span class="is-size-5">
                        Supporters
                    </span>
                </a>
                <div class="navbar-burger burger" data-target="navbarBurger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div id="navbarBurger" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="{{ route('campaigns.index') }}">
                        Campaigns
                    </a>
                    <a class="navbar-item" href="{{ route('campaigns.create') }}">
                        Run a Campaign
                    </a>
                </div>
                <div class="navbar-end">
                    @auth
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">
                                {{ auth()->user()->profile ? auth()->user()->profile->username : 'You haven\'t sign up a profile yet' }}
                            </a>
                            @if(auth()->user()->profile)
                                <div class="navbar-dropdown is-right">
                                    <a href="{{ route('profiles.show', ['profile' => auth()->user()->profile]) }}" class="navbar-item">
                                        Profile
                                    </a>
                                    <a href="{{ route('profiles.edit', ['profile' => auth()->user()->profile]) }}" class="navbar-item">
                                        Settings
                                    </a>
                                    <a class="navbar-item">
                                        Other stuff
                                    </a>
                                    <hr class="navbar-divider">
                                    <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endauth
                    @guest
                        <a class="navbar-item" href="{{ route('login') }}">
                            Login
                        </a>

                        <a class="navbar-item" href="{{ route('register') }}">
                            Register
                        </a>
                    @endguest
                </div>
            </div>
        </nav>
        @yield('content')
        <flash-notification
            body="{{ session('flash_body') }}"
            type="{{ session('flash_type') }}"
            title="{{ session('flash_title') }}"
        ></flash-notification>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
