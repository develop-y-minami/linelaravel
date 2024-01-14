{{--チェックグリッド--}}
<div id="{{ $id }}" class="checkGrid {{ $class }}">
    @foreach ($checkItems as $item)
        <div class="checkBox">
            <input type="checkbox" id="{{ $id }}{{ $item->value }}" {{ \ViewFacade::checked($item->checked) }}>
            <label for="{{ $id }}{{ $item->value }}">{{ $item->name }}</label>
        </div>
    @endforeach
</div>