<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#176B36] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0f4f26] focus:bg-[#0f4f26] active:bg-[#0f4f26] focus:outline-none focus:ring-2 focus:ring-[#176B36] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
