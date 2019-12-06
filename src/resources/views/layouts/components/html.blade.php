<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/fileman/css/fileman.css') }}"/>
</head>
<body>
    {{ $body }}
</body>
    <script src="{{ asset('vendor/fileman/js/vendor.js') }}"></script>
    <script src="{{ asset('vendor/fileman/js/fileman.js') }}"></script>
</html>