@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-start text-base font-semibold text-red-700 transition duration-150 ease-in-out'
            : 'block w-full rounded-2xl border border-transparent px-4 py-3 text-start text-base font-medium text-slate-600 transition duration-150 ease-in-out hover:border-red-100 hover:bg-red-50 hover:text-red-700 focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
