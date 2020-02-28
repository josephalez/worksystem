<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Worksystem</title>
      <link rel="shortcut icon" href="{{ asset('Frontend/favicon.icon') }}">
      <link media="all" rel="stylesheet" href="{{ asset('Frontend/bootstrapMd/css/bootstrap.min.css') }}">
      <link media="all" rel="stylesheet" href="{{ asset('Frontend/bootstrapMd/css/mdb.min.css') }}">
      <link media="all" rel="stylesheet" href="{{ asset('Frontend/css/main.css') }}">
      <link media="all" rel="stylesheet" href="{{ asset('Frontend/icons/css/all.min.css') }}">
      <link media="all" rel="stylesheet" href="{{ asset('Frontend/css/main.css') }}">
    </head>
    <body>
      <div id="app">
        @yield('content')
      </div>
      <script src="{{asset('js/app.js')}}"></script>
      <script src="{{asset('Frontend/bootstrap/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('Frontend/bootstrapmd/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('Frontend/bootstrapmd/js/mdb.min.js')}}"></script>
    </body>
</html>
