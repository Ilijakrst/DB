@props([
    'name',
    'id' => null,
    'label',
    'checked' => false,
    'description' => null,
])

@php
    $id = $id ?? $name;
@endphp

<div class="flex items-start gap-3">
    <div class="flex items-center h-5">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $id }}"
            value="1"
            {{ $checked ? 'checked' : '' }}
            {{ $attributes->merge(['class' => 'w-4 h-4 rounded border-slate-700 bg-[#070b0e] text-emerald-500 focus:ring-emerald-500/30 focus:ring-offset-0 cursor-pointer']) }}
        >
    </div>
    <div class="text-xs select-none">
        <label for="{{ $id }}" class="font-medium text-emerald-300/80 font-mono cursor-pointer hover:text-white transition-colors">
            {{ $label }}
        </label>
        @if ($description)
            <p class="text-slate-500 mt-0.5">{{ $description }}</p>
        @endif
    </div>
</div>
