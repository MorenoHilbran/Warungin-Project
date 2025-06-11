@extends('layouts.app')

@section('content')
{{-- Background Atas --}}
<div id="Background" class="absolute top-0 w-full h-[170px] rounded-b-[45px] bg-[linear-gradient(90deg,#FF923C_0%,#FF801A_100%)]"></div>

<div class="relative z-10 pt-20 pb-10 px-4 md:px-6 max-w-5xl mx-auto text-gray-800 font-sans">

    {{-- Informasi Dasar --}}
    <section class="bg-white shadow-md rounded-xl p-6 mb-6">
        <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="w-28 h-28 rounded-full overflow-hidden border border-gray-300 shadow-sm">
                @if($store->logo)
                    <img src="{{ asset('storage/' . $store->logo) }}" alt="Logo Toko" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-sm text-gray-500">No Logo</div>
                @endif
            </div>
            <div class="text-center md:text-left">
                <h1 class="text-2xl md:text-3xl font-bold text-[#FF801A]">{{ $store->name }}</h1>
                <p class="text-sm mt-2 text-gray-600">
                    {{ $store->address ?? 'Alamat belum tersedia' }}
                </p>
            </div>
        </div>
    </section>

    {{-- Tentang Toko --}}
    <section class="bg-white shadow-md rounded-xl p-6 mb-6">
        <h2 class="text-xl font-semibold text-[#FF801A] mb-2">Tentang Toko</h2>
        <p class="text-sm text-gray-700 leading-relaxed">
            {{ $store->about ?? 'Deskripsi toko belum tersedia.' }}
        </p>
    </section>

    {{-- Informasi Tambahan --}}
    <section class="bg-white shadow-md rounded-xl p-6 mb-6">
        <h2 class="text-xl font-semibold text-[#FF801A] mb-2">Informasi Tambahan</h2>
        <p class="text-sm text-gray-700">
            <strong>Jam Operasional:</strong> {{ $store->operating_hours ?? 'Belum ditentukan' }}
        </p>
    </section>

    {{-- Media Sosial --}}
    <section class="bg-white shadow-md rounded-xl p-6">
        <h2 class="text-xl font-semibold text-[#FF801A] mb-4">Media Sosial</h2>

        @php
            $sosmed = $store->social_media ?? [];
        @endphp

        @if(!empty($sosmed))
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            @if(!empty($sosmed['instagram']))
                <div class="flex items-center gap-3">
                    <img src="https://img.icons8.com/ios-filled/28/FF801A/instagram-new.png" alt="Instagram">
                    <div>
                        <span class="font-medium">Instagram:</span>
                        <a href="https://instagram.com/{{ ltrim($sosmed['instagram'], '@') }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ '@' . ltrim($sosmed['instagram'], '@') }}
                        </a>
                    </div>
                </div>
            @endif

            @if(!empty($sosmed['shopee']))
                <div class="flex items-center gap-3">
                    <img src="https://img.icons8.com/ios-filled/28/FF801A/shopee.png" alt="Shopee">
                    <div>
                        <span class="font-medium">Shopee:</span>
                        <a href="{{ $sosmed['shopee'] }}" target="_blank" class="text-orange-500 hover:underline">Kunjungi Toko</a>
                    </div>
                </div>
            @endif

            @if(!empty($sosmed['whatsapp']))
                <div class="flex items-center gap-3">
                    <img src="https://img.icons8.com/ios-filled/28/25D366/whatsapp.png" alt="WhatsApp">
                    <div>
                        <span class="font-medium">WhatsApp:</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $sosmed['whatsapp']) }}" target="_blank" class="text-green-600 hover:underline">
                            {{ $sosmed['whatsapp'] }}
                        </a>
                    </div>
                </div>
            @endif

            @if(!empty($sosmed['facebook']))
                <div class="flex items-center gap-3">
                    <img src="https://img.icons8.com/ios-filled/28/1877F2/facebook-new.png" alt="Facebook">
                    <div>
                        <span class="font-medium">Facebook:</span>
                        <a href="{{ $sosmed['facebook'] }}" target="_blank" class="text-blue-700 hover:underline">
                            {{ $sosmed['facebook'] }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
        @else
            <p class="text-sm text-gray-500">Belum ada media sosial yang ditambahkan.</p>
        @endif
    </section>

</div>

@include('includes.navigation')
@endsection
