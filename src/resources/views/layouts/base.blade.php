<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('vendor/fileman/css/fileman.css') }}"/>
</head>
<body>
    @yield('content')
</body>
    <script src="{{ asset('vendor/fileman/js/fileman.js') }}"></script>
</html>