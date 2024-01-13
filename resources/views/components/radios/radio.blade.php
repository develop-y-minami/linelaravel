{{--ラジオボタン--}}
<div>{{ $itemName }}</div>
<div class="inputContainer">
    @foreach ($radioItems as $item)
        <div class="radioBox">
            <input type="radio" id="{{ $id }}{{ $name }}{{ $item->value }}" name="{{ $id }}{{ $name }}" value="{{ $item->value }}" {{ $item->value == $checkedValue ? 'checked' : '' }}>
            <label for="{{ $id }}{{ $name }}{{ $item->value }}">{{ $item->name }}</label>
        </div>
    @endforeach
</div>