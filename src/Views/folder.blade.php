<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div>
        @include('_components.path-display', ['folder' => $folder])<br>
        @include('_components.folders-display', ['folder' => $folder])
        @include('_components.files-display', ['folder' => $folder])

        <br><a href="{{ route('admin.folder.create', ['parent' => $folder]) }}">+Add Folder</a><br>
        <a href="{{ route('admin.file.create', ['parent' => $folder]) }}">+Upload File</a>
    </div>
</body>
</html>
