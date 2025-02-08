@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-transparent text-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>