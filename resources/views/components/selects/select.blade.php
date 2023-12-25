<div class="selectBox {{ $classBox }}">
    <select id="{{ $id }}" class="{{ $class }}" name="{{ $name }}">
        @if ($visibleBlankItem)
            <option value="{{ $blankItemValue }}">{{ $blankItemName }}</option>
        @endif
        @foreach ($selectItems as $selectItem)
            <option value="{{ $selectItem->value }}" {{ $selectItem->value == $selectedValue ? 'selected' : '' }}>{{ $selectItem->name }}</option>
        @endforeach
    </select>
</div>