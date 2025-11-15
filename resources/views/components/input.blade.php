<div class="mb-4">
    @if($label)
        <label for="{{ $id }}" class="block mb-1 font-medium">{{ $label }}</label>
    @endif

    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        placeholder="{{ $placeholder }}" 
        data-label="{{ $label }}" 
        class="{{ $class }} {{ $mandatory ? 'mandatory' : '' }} border rounded w-full p-2"
        value="{{ old($name) }}"
        {{ $mandatory ? 'required' : '' }}
        {{ $attributes }}
    />

    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
