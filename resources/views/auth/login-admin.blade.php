<x-auth-split peran="admin" gambar="kegiatan-1.jpg">
    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-[#10351d] text-white">Admin / Pengelola</span>
    <h2 class="mt-3 text-2xl font-bold">Masuk sebagai admin</h2>
    <p class="text-sm text-gray-500 mb-5">Halaman ini khusus pengelola bank sampah.</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="peran" value="admin">

        <div>
            <x-input-label for="email" value="Email admin" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label class="flex items-center mt-4 text-sm text-gray-600">
            <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#176B36] focus:ring-[#176B36]">
            <span class="ms-2">Ingat saya</span>
        </label>

        <button class="mt-6 w-full py-2.5 rounded-lg bg-[#10351d] text-white font-semibold hover:opacity-90 transition">Masuk ke panel admin</button>
    </form>

    <p class="mt-6 pt-4 border-t border-gray-100 text-sm text-center text-gray-500">
        Anda nasabah?
        <a href="{{ route('login') }}" class="text-[#176B36] font-semibold">Masuk di sini</a>
    </p>
</x-auth-split>