<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            {{-- Ikon Peringatan --}}
            <div class="flex-shrink-0">
                <div class="rounded-full bg-warning-500/10 p-2">
                    <svg class="h-6 w-6 text-warning-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.008v.008H12v-.008Z" />
                    </svg>
                </div>
            </div>

            {{-- Teks Notifikasi --}}
            <div class="flex-grow">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Langganan Anda Tidak Aktif
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    Untuk dapat terus menggunakan semua fitur dan agar toko Anda tetap terlihat di marketplace, silakan aktifkan langganan Anda.
                </p>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex-shrink-0">
                {{-- PENTING: Ganti URL ini ke halaman langganan Anda --}}
                <a href="{{ url(config('filament.path') . '/admin/subscriptions') }}"
                   class="fi-btn inline-flex items-center justify-center gap-1 rounded-lg border text-sm font-semibold shadow-sm outline-none transition duration-75 focus:ring-2 disabled:pointer-events-none disabled:opacity-70 fi-btn-color-primary bg-primary-600 text-white hover:bg-primary-500 dark:bg-primary-500 dark:hover:bg-primary-400 focus:ring-primary-500/50 dark:focus:ring-primary-400/50 fi-size-md px-3 py-2">
                    Langganan Sekarang
                </a>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
