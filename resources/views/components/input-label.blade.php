@props(['value'])

<label {{ $attributes->merge(['class' => 'label-text text-gray-600 font-medium text-sm']) }}>
    {{ $value ?? $slot }}
</label>
