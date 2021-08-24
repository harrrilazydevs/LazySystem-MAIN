<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$page_settings['page_title']}}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,700&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/css/all.css') }}" rel="stylesheet">

</head>
<body>
    

    <div class="load-screen">

        <img src="{{asset('/img/index/lazydevs_logo.png')}}" alt="" class="m-auto" >

        <div></div>
        
        <label class="font-weight-bold text-center" style="font-family: 'Roboto Condensed', sans-serif;">Lazy Devs PH</label>

    </div>

    <div class="page-screen d-none">

        <!-- Overlay, must be placed direct after the opening body tag. -->
        <div class="bs-canvas-overlay bs-canvas-anim bg-dark position-fixed w-100 h-100"></div>
        
        <!-- Non-pushable content. -->
        
        @include('inc.navs.dashboard')
        
        <!-- Pushable content along with off-canvas opener. -->
        <main class="py-2">

            @yield('content')
           
        </main>
        
        <!-- Off-canvas sidebar markup, left/right or both. -->
        <div id="bs-canvas-left" class="bs-canvas bs-canvas-anim bs-canvas-left position-fixed bg-light h-100" style="background: #061325ce !important;">

            @include('inc.sidebars.dashboard')

        </div>
        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/jquery-3.4.1.min.js')}}" ></script>
    <script src="{{asset('js/function.js')}}" ></script>
    <script src="{{asset('js/aes.js')}}" ></script>
    <script src="{{asset('LD/func/LazyDevz.js')}}" ></script>
    <script src="{{asset('LD/func/universal.js')}}" ></script>

    @include('inc.modals.content')

    {{-- FUNCTIONAL SCRIPTS --}}
    @include('inc.js.dashboard.functions.profile')
    @include('inc.js.dashboard.functions.mdm')




    {{-- @yield('script') --}}

</body>
</html>
