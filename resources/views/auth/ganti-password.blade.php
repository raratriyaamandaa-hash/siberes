<x-guest-layout>
    <h2 class="text-xl font-semibold">Buat password baru</h2>
    <p class="text-sm text-gray-500 mb-4">
        Password Anda baru direset oleh pengelola. Buat password baru yang hanya Anda yang tahu, lalu lanjutkan.
    </p>

    <form method="POST" action="{{ route('password.wajib.simpan') }}">
        @csrf

        <div>
            <x-input-label for="password" value="Password baru" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autofocus autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Ulangi password baru" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <button class="mt-6 w-full py-2.5 rounded-lg bg-[#176B36] text-white font-semibold hover:opacity-90 transition">Simpan password baru</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-3 text-center">
        @csrf
        <button class="text-sm text-gray-500 hover:text-[#176B36]">Keluar</button>
    </form>
</x-guest-layout>