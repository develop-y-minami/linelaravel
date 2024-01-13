<div class="selectBox {{ $classBox }}">
    <select id="{{ $id }}" class="{{ $class }}" name="{{ $name }}">
        @if ($visibleBlankItem)
            <option value="{{ $blankItemValue }}">{{ $blankItemName }}</option>
        @endif
        @foreach ($selectItems as $item)
            <option value="{{ $item->value }}" {{ $item->value == $selectedValue ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
</div>