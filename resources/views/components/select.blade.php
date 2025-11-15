<div class="mb-4">
    @if($label)
        <label for="{{ $id }}" class="block mb-1 font-medium">{{ $label }}</label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $id }}"
        data-label="{{ $label }}"
        @if($dataKey) data-key="{{ $dataKey }}" @endif
        class="{{ $class }} {{ $mandatory ? 'mandatory' : '' }} border rounded w-full p-2"
        {{ $mandatory ? 'required' : '' }}
        {{ $attributes }}
    >
        <option value="">Select {{ $label }}</option>
        @foreach($options as $value => $text)
            <option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
