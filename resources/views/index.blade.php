<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <meta name="description" content="{{ config('app.description') }}">
  <meta name="keywords" content="{{ config('app.keywords') }}">
  <meta name="format-detection" content="telephone=no,email=no,address=no">

  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ config('app.name') }}">
  <meta property="og:description" content="{{ config('app.description') }}">
  <meta property="og:url" content="{{ config('app.url') }}">
  <meta property="og:image" content="{{ asset('img/ogp.png') }}">
  <meta name="twitter:card" content="summary_large_image">

  <link rel="canonical" href="{{ config('app.url') }}">

  <title>{{ config('app.name') }}</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app"></div>
  <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
