<html lang="en">

    <head>
        <!-- basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- mobile metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <!-- site metas -->
        <title>HomeCare</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- style css -->
        <link rel="stylesheet" href="css/style.css">
        <!-- Responsive-->
        <link rel="stylesheet" href="css/responsive.css">
        <!-- fevicon -->
        <link rel="icon" href="images/fevicon.png" type="image/gif" />
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
        <!-- Tweaks for older IEs-->
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <!-- owl stylesheets -->
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    </head>

    <body>
        {{ $slot }}
    </body>
</html>


{{-- <!doctype html> --}}
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
{{-- <head> --}}
{{--     <meta charset="utf-8"> --}}
{{--     <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
{{----}}
{{--     <!-- CSRF Token --> --}}
{{--     <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
{{----}}
{{--     <title>{{ config('app.name', 'Laravel') }}</title> --}}
{{----}}
{{--     <!-- Fonts --> --}}
{{--     <link rel="dns-prefetch" href="//fonts.bunny.net"> --}}
{{--     <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
{{----}}
{{--     <!-- Scripts --> --}}
{{--     @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
{{-- </head> --}}
{{-- <body> --}}
{{--     <div id="app"> --}}
{{--         <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> --}}
{{--             <div class="container"> --}}
{{--                 <a class="navbar-brand" href="{{ url('/') }}"> --}}
{{--                     {{ config('app.name', 'Laravel') }} --}}
{{--                 </a> --}}
{{--                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"> --}}
{{--                     <span class="navbar-toggler-icon"></span> --}}
{{--                 </button> --}}
{{----}}
{{--                 <div class="collapse navbar-collapse" id="navbarSupportedContent"> --}}
{{--                     <!-- Left Side Of Navbar --> --}}
{{--                     <ul class="navbar-nav me-auto"> --}}
{{----}}
{{--                     </ul> --}}
{{----}}
{{--                     <!-- Right Side Of Navbar --> --}}
{{--                     <ul class="navbar-nav ms-auto"> --}}
{{--                         <!-- Authentication Links --> --}}
{{--                         @guest --}}
{{--                             @if (Route::has('login')) --}}
{{--                                 <li class="nav-item"> --}}
{{--                                     <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> --}}
{{--                                 </li> --}}
{{--                             @endif --}}
{{----}}
{{--                             @if (Route::has('register')) --}}
{{--                                 <li class="nav-item"> --}}
{{--                                     <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
{{--                                 </li> --}}
{{--                             @endif --}}
{{--                         @else --}}
{{--                             <li class="nav-item dropdown"> --}}
{{--                                 <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> --}}
{{--                                     {{ Auth::user()->name }} --}}
{{--                                 </a> --}}
{{----}}
{{--                                 <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
{{--                                     <a class="dropdown-item" href="{{ route('logout') }}" --}}
{{--                                        onclick="event.preventDefault(); --}}
{{--                                                      document.getElementById('logout-form').submit();"> --}}
{{--                                         {{ __('Logout') }} --}}
{{--                                     </a> --}}
{{----}}
{{--                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> --}}
{{--                                         @csrf --}}
{{--                                     </form> --}}
{{--                                 </div> --}}
{{--                             </li> --}}
{{--                         @endguest --}}
{{--                     </ul> --}}
{{--                 </div> --}}
{{--             </div> --}}
{{--         </nav> --}}
{{----}}
{{--         <main class="py-4"> --}}
{{--             @yield('content') --}}
{{--         </main> --}}
{{--     </div> --}}
{{-- </body> --}}
{{-- </html> --}}
