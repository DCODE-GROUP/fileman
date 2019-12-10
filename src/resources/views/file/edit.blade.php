@extends('fileman::layouts.page')

@section('main')
    <form action="{{ $action }}"
          method="post"
          enctype="multipart/form-data">
        @if (strtolower($method) !== 'post')
            @method($method)
        @endif
        @csrf
        <input type="text" name="name" value="{{ old('name') ?? $file->name ?? null }}" placeholder="{{ $method === 'post' ? 'Optional' : null }}">
        @if ($method === 'post')
            <input type="file" name="file">
        @endif
        <input type="submit">
    </form>
@endsection