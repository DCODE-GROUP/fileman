@extends('fileman::layouts.base')

@section('content')
    <div>
        @include('fileman::components.path-display', ['folder' => $parent])
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
@endsection