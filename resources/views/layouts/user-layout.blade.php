<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    

    <title>{{ config('app.name', 'BookHub') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"></head>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    
    .navbar .navbar-brand {
        font-family: 'Poppins', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        color: #023969;
        }
    lottie-player{
    
    }
        
    </style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <div class="flex items-end">
                <a class="navbar-brand flex-1" href="{{ url('/') }}">
                    {{ config('app.name', 'BookHub') }}                    
                </a>                
                <lottie-player class="flex-1" src="https://assets4.lottiefiles.com/packages/lf20_n2yhd0lo.json"  background="transparent"  speed="1"  style="width: 100px; height: 80px;"  loop  autoplay></lottie-player>
            </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto lg:space-x-2 text-center">
                        <!-- Authentication Links -->

                            @if (Route::has('login'))
                                    @auth
                                    <li class="nav-item">
                                        <a href="{{ url('/home') }}" class="nav-link">Home</a>
                                    </li>
                                    @else
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                                    </li>
                                        @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                                        </li>
                                        @endif
                                    @endauth
                            @endif
                    </ul>

                </div>
            </div>
        </nav>

        <main class="py-4">
            {{-- Checking validation errors and if any, display them as flash messages --}}
            {{-- @if($errors->any())
                @foreach($errors->all() as $error)
                    {{ session()->put(['type'=>'danger', 'message'=>$error]) }} 
                    <div class="mx-auto max-w-sm lg:max-w-4xl">
                        <x-flash-message />
                    </div>
                @endforeach
            @endif --}}

            @yield('user-content')
        </main>

    </div>
</body>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
</html>
