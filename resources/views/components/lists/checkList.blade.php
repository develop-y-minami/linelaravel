{{--チェックリスト--}}
<ul id="{{ $id }}" class="checkList {{ $class }}">
    @foreach ($checkListItems as $item)
        <li>
            <input type="checkbox" id="{{ $id }}-{{ $item->value }}" value="{{ $item->value }}" {{ $item->checked ? 'checked' : '' }}>
            <label for="{{ $id }}-{{ $item->value }}">{{ $item->name }}</label>
        </li>
    @endforeach
</ul>