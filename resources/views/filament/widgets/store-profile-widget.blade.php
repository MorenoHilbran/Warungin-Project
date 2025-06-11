<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center gap-x-6">
            {{-- Kolom Logo --}}
            <div class="flex-shrink-0">
                @if ($user->logo)
                    <img class="h-20 w-20 rounded-full object-cover ring-2 ring-gray-200 dark:ring-gray-700" 
                         src="{{ asset('storage/' . $user->logo) }}" 
                         alt="Logo {{ $user->name }}">
                @else
                    {{-- Ikon pengganti jika tidak ada logo --}}
                    <img class="h-20 w-20 rounded-full object-cover ring-2 ring-gray-200 dark:ring-gray-700" 
                         src="{{ asset('assets/images/store.png') }}" 
                         alt="Logo Toko">
                @endif
            </div>

            {{-- Kolom Informasi Toko (dibuat agar memenuhi sisa ruang) --}}
            <div class="flex-grow">
                <h2 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $user->name }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Alamat Toko:
                    <a href="{{ url('/' . $user->username) }}" 
                       target="_blank" 
                       class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                        warungin/{{ $user->username }}
                    </a>
                </p>
            </div>

            {{-- Kolom Tombol Aksi --}}
            <div class="flex-shrink-0">
                <a href="{{ url('/' . $user->username) }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="fi-btn inline-flex items-center justify-center gap-2 rounded-lg border text-sm font-semibold shadow-sm outline-none transition duration-75 focus:ring-2 disabled:pointer-events-none disabled:opacity-70 fi-btn-color-primary bg-primary-600 text-white hover:bg-primary-500 dark:bg-primary-500 dark:hover:bg-primary-400 focus:ring-primary-500/50 dark:focus:ring-primary-400/50 fi-size-md px-3 py-2">
                    <img src="{{ asset('assets/images/visit.svg') }}" class="h-5 w-5" alt="Business Icon">
                    <span>Kunjungi Toko</span>
                </a>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>