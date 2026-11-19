<x-auth-split peran="nasabah" gambar="kegiatan-3.jpg">
    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-[#E5F5E9] text-[#176B36]">Nasabah baru</span>
    <h2 class="mt-3 text-2xl font-bold">Daftar sebagai nasabah</h2>
    <p class="text-sm text-gray-500 mb-5">Setelah mendaftar, akun Anda diverifikasi admin sebelum bisa dipakai.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nama lengkap" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email (untuk login)" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="alamat" value="Alamat (untuk penjemputan)" />
            <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" required />
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="telepon" value="Nomor telepon" />
            <x-text-input id="telepon" class="block mt-1 w-full" type="text" name="telepon" :value="old('telepon')" required />
            <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Ulangi password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button class="mt-6 w-full py-2.5 rounded-lg bg-[#176B36] text-white font-semibold hover:opacity-90 transition">Daftar</button>
    </form>

    <p class="mt-5 text-sm text-center text-gray-600">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-[#176B36] font-semibold">Masuk</a>
    </p>
</x-auth-split>