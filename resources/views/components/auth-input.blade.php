@props([
    'name',
    'id' => null,
    'type' => 'text',
    'label' => null,
    'value' => null,
    'required' => false,
    'autofocus' => false,
    'autocomplete' => null,
    'placeholder' => null,
    'hint' => null,
])

@php
    $id = $id ?? $name;
    $computedValue = old($name, $value ?? '');
    $hasError = $errors->has($name);
@endphp

<div class="space-y-1.5">
    @if ($label)
        <label for="{{ $id }}" class="block text-xs font-semibold uppercase tracking-wider text-emerald-300/80 font-mono">
            {{ $label }}
            @if ($required)
                <span class="text-rose-400" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ $computedValue }}"
            @if ($required) required @endif
            @if ($autofocus) autofocus @endif
            @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            @if ($hasError) aria-invalid="true" aria-describedby="{{ $id }}-error" @elseif ($hint) aria-describedby="{{ $id }}-hint" @endif
            {{ $attributes->merge([
                'class' => 'block w-full rounded-xl bg-[#070b0e] px-3.5 py-2.5 text-sm text-emerald-300 font-mono placeholder-slate-600 focus:outline-none transition-colors '.
                ($hasError
                    ? 'border border-rose-500/80 focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20'
                    : 'border border-slate-700/80 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20')
            ]) }}
        >
    </div>

    @if ($hint && ! $hasError)
        <p id="{{ $id }}-hint" class="text-[11px] text-emerald-400/60 font-mono text-xs leading-tight">{{ $hint }}</p>
    @endif

    @error($name)
        <p id="{{ $id }}-error" class="text-xs text-rose-400 font-medium leading-tight" role="alert">{{ $message }}</p>
    @enderror
</div>
