<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div>
        @include('laravel-file-man::_components.path-display', ['folder' => $folder])
        <form action="{{ $action }}"
              method="post"
              enctype="multipart/form-data">
            @if (strtolower($method) !== 'post')
                @method($method)
            @endif
            @csrf
            <input type="hidden" name="folder_id" value="{{ $folder->id }}">
            <input type="text" name="name" placeholder="Enter File Name" value="{{ old('name') ?? $file->name ?? '' }}">
            <input type="file" name="file">
            <input type="submit">
        </form>
    </div>
</body>
</html>
