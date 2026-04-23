<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-700 shadow-sm transition duration-150 ease-in-out hover:border-red-200 hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-200 focus:ring-offset-2 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
