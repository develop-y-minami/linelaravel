{{--担当者セレクトボックス--}}
<div class="selectBox {{ $classBox }}">
    <select id="{{ $id }}" class="{{ $class }}" name="{{ $name }}">
        @if ($visibleBlankItem)
            <option value="{{ $blankItemValue }}" data-serviceproviderid="0">{{ $blankItemName }}</option>
        @endif
        @foreach ($selectItems as $item)
            <option value="{{ $item->value }}" data-serviceproviderid="{{ $item->serviceProviderId }}" {{ $item->value == $selectedValue ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
</div>