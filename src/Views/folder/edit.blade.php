<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div>
        @include('file-man::_components.path-display', ['folder' => $parent])
        <form action="{{ $action }}"
              method="post"
              enctype="multipart/form-data">
            @if (strtolower($method) !== 'post')
                @method($method)
            @endif
            @csrf
            <input type="hidden" name="parent_id" value="{{ $parent->id }} ">
            <input type="text" name="name" placeholder="Enter Folder Name" value="{{ old('name') ?? $folder->name ?? '' }}">
            <input type="submit">
        </form>
    </div>
</body>
</html>
