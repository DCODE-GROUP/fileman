<div>
    @foreach($path as $pathLine)
        <span>
            <a href="{{ $pathLine['url'] }}">{{ $pathLine['name'] }}</a>
        </span>
        <span>/</span>
    @endforeach
</div>
