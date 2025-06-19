<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- левое меню --}}
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('userPost.index') }}">{{ __('messages.main') }}</a>
                    </li>
                </ul>

                {{-- правое меню --}}
                <ul class="navbar-nav ms-auto">
                    <li><a class="nav-link" href="{{ route('lang.switch', 'en') }}">EN</a></li>
                    <li><a class="nav-link" href="{{ route('lang.switch', 'ru') }}">RU</a></li>

                    @auth
                        <li class="nav-item"><span class="nav-link">{{ __('messages.hello') }} {{ auth()->user()->user_name }}</span></li>
                        <li><a class="nav-link" href="{{ route('userPost.create') }}">{{ __('messages.create_button') }}</a></li>
                        <li class="nav-item">
                            <form action="{{ route('user.logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">{{ __('messages.logout') }}</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.register') }}">{{ __('messages.register') }}</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')   {{-- контент страниц --}}
    </div>
</body>
</html>