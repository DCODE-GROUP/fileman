@extends('fileman::layouts.page')

@section('main')
    <form action="{{ $action }}"
          method="post"
          enctype="multipart/form-data">
        @if (strtolower($method) !== 'post')
            @method($method)
        @endif
        @csrf
        <input type="hidden" name="folder_id" value="{{ $parent->id }}">
        <input type="file" name="file">
        <input type="submit">
    </form>
@endsection