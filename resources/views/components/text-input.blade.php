@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#176B36] focus:ring-[#176B36] rounded-md shadow-sm']) }}>
