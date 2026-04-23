@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-2xl border border-slate-200 bg-white/95 px-4 py-3 text-slate-800 shadow-sm transition duration-150 placeholder:text-slate-400 focus:border-red-300 focus:ring-red-200']) }}>
