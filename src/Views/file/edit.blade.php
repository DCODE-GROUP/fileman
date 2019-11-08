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
            <h1>Edit File</h1>
            {!! Form::model($record, [
                'route' => ['admin.file.update', $record->id],
                'method' => 'PUT',
                'files' => true,
            ]) !!}
        @else
            <h1>Create File</h1>
            {!! Form::open([
                'route' => 'admin.file.store',
                'method' => 'POST',
                'files' => true,
            ]) !!}
        @endif

        <input type="hidden" name="folder_id" value="{{$parent->id}}">
        <fieldset>
            <input type="text" name="name" placeholder="Enter File Name" value="{{$record->name ?? ''}}">
        </fieldset>
        <fieldset>
            <input type="file" name="file">
        </fieldset>
        <input type="submit">

        {!! Form::close() !!}
    </div>
</body>
</html>
