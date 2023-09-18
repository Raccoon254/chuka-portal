<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn ring ring-inset btn-outline']) }}>
    {{ $slot }}
</button>
