@extends('fileman::layouts.page')

@section('main')
    <div class="actions">
        <a class="button" href="{{ route('fileman.file.edit', [$parent, $file]) }}">
            <i class="fas fa-folder-plus"></i>
            <span>Rename</span>
        </a>
        <form action="{{ route('fileman.file.destroy', [$parent, $file]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="button danger">
                <i class="far fa-trash-alt"></i>
                <span>Delete</span>
            </button>
        </form>
    </div>
    <div class="file-show">
        @if ($file->hasPreview())
            <div class="image" style="background-image: url({{ $file->getPreview() }})"></div>
        @endif
        <table>
            <tr>
                <th>Url</th>
                <td>{{ $file->getUrl() }}</td>
            </tr>
            <tr>
                <th>Filename</th>
                <td>{{ $file->name }}</td>
            </tr>
            <tr>
                <th>File Type</th>
                <td>{{ $file->type }}</td>
            </tr>
            <tr>
                <th>File Size</th>
                <td>{{ $file->size }}</td>
            </tr>
        </table>
    </div>
@endsection