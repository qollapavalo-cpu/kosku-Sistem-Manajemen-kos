@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-full border border-red-200 bg-red-600 px-4 py-2 text-sm font-semibold leading-5 text-white shadow-[0_14px_30px_-18px_rgba(127,29,29,0.7)] transition duration-150 ease-in-out'
            : 'inline-flex items-center rounded-full border border-transparent px-4 py-2 text-sm font-semibold leading-5 text-slate-600 transition duration-150 ease-in-out hover:border-red-100 hover:bg-red-50 hover:text-red-700 focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
