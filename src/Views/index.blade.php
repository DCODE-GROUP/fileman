<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div>
        @include('file-man::_components.path-display', ['folder' => $folder])<br>
        @include('file-man::_components.folders-display', ['folder' => $folder])
        @include('file-man::_components.files-display', ['folder' => $folder])
        <a href="{{ route('file-man.folder.create', ['folder' => $folder]) }}">+Add Folder</a><br>
        <a href="{{ route('file-man.file.create', ['folder' => $folder]) }}">+Upload File</a>
    </div>
</body>
</html>
