<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div>
        @include('_components.path-display', ['folder' => $parent])
    </div>
    <div>
        @if (isset($record))
            <h1>Edit Folder</h1>
            {!! Form::model($record, ['route' => ['admin.folder.update', $record->id], 'method' => 'PUT']) !!}
        @else
            <h1>Create Folder</h1>
            {!! Form::open(['route' => 'admin.folder.store', 'method' => 'POST']) !!}
        @endif

        <input type="hidden" name="parent_id" value="{{$parent->id}}">
        <input type="text" name="name" placeholder="Enter Folder Name" value="{{$record->name ?? ''}}">
        <input type="submit">

        {!! Form::close() !!}
    </div>
</body>
</html>
