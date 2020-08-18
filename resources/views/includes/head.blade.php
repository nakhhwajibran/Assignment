<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Payment Processing</title>

    <!-- Scripts -->


    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type='text/css'>
    <link href="{{ asset('css/dataTable.min.css') }}" rel="stylesheet" type='text/css'>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type='text/css'>
    <link href="{{ asset('css/header.css') }}" rel="stylesheet" type='text/css'>


    @stack('styles')
</head>