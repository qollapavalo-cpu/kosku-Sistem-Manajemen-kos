<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-2xl border border-transparent bg-gradient-to-r from-red-700 via-red-600 to-red-500 px-5 py-3 text-xs font-bold uppercase tracking-[0.18em] text-white shadow-[0_18px_35px_-18px_rgba(127,29,29,0.8)] transition duration-150 ease-in-out hover:-translate-y-0.5 hover:from-red-800 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
