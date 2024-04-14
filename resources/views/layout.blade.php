<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>@yield('title') {{ config('app.name') }}</title>

        <meta name="description" content="Simutransの派生版、OTRP(One way Two lanes Road Project)の更新情報をまとめたサイトです。">
        <meta name="keywords" content="Simutrans, OTRP, One way Two lanes Road Project, 更新情報">
        <meta name="author" content="128Na">

        <meta property="og:title" content="{{ config('app.name') }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:image" content="{{ url('/icon.png') }}">
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:description" content="Simutransの派生版、OTRP(One way Two lanes Road Project)の更新情報をまとめたサイトです。">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="twitter:card" content="summary">

        <link rel="canonical" href="{{ url('/') }}">
        <link rel="shortcut icon" href="{{ url('/favicon.ico') }}" type="image/vnd.microsoft.ico" />

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="dark:bg-gray-900 ">
        @include('header')
        @yield('content')
    </body>
</html>
