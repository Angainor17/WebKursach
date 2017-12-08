@for ($i = 0; $i < 100; $i++)
    @if($selection != '-1' && $i == $selection)
        <option selected="selected" value="{{ $i }}">{{ $i }}</option>:
    @else
        <option value="{{ $i }}">{{ $i }}</option>:
    @endif
@endfor