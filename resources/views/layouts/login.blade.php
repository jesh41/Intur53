<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">

    <style>body {
            background-color: #efefef;
            margin-top: 100px
        }
    </style>

</head>
<body>
<header id="app">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <a href="{{ route('login') }}">
                <img class="img-responsive center-block" style="width: 25%; height: 25%"
                     src="{{asset('images/Logo.png') }}" alt="">
            </a>
        </div>
    </div>

</header>
<main>
    @yield('content')
</main>

<footer>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h5 class="text-center">Powered by Monografía &copy 2017, All rights reserved.</h5>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>