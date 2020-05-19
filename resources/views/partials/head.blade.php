<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ URL::to('/') }}" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">

    <!-- SEO -->
    <meta name="description" content="A registry for merchants that accept Bitcoin. ">
    <meta name="keywords" content="Registry, List, Bitcoin, Merchants, Crypto Store">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ URL::to('/') }}">

    <title>{{ config('app.name', 'SekaiBit') }}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>