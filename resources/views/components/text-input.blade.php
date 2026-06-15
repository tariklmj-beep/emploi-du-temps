@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/5 border-white/10 text-white focus:border-blue-400 focus:ring-blue-400/20 rounded-xl shadow-sm backdrop-blur-sm']) }}>
