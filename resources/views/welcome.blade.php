<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Warungin - Landing Page</title>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-100">
<!-- Navbar -->
<nav class="bg-white shadow fixed w-full z-50" id="navbar">
  <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
    <div>
      <a href="/">
        <img src="{{ asset('assets/images/warungin.png') }}" alt="Warungin Logo" class="h-10">
      </a>
    </div>
    <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
      <li><a href="#home" class="nav-link hover:text-[#FF8626] transition duration-300">Beranda</a></li>
      <li><a href="#about" class="nav-link hover:text-[#FF8626] transition duration-300">Tentang</a></li>
      <li><a href="#testimoni" class="nav-link hover:text-[#FF8626] transition duration-300">Testimoni</a></li>
      <li><a href="#paket" class="nav-link hover:text-[#FF8626] transition duration-300">Harga</a></li>
      <li><a href="#features" class="nav-link hover:text-[#FF8626] transition duration-300">Fitur</a></li>
    </ul>

    <div class="flex items-center space-x-4">
      @auth
      <a href="/admin" class="flex items-center space-x-2 bg-[#FF8626] text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">
        <!-- Icon Dashboard -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 14v-6h4v6m5-10h.01M21 21H3" />
        </svg>
        <span>{{ Auth::user()->name }}</span>
      </a>

      @else
        <a href="/admin/login" class="px-4 py-2 rounded-full text-[#FF8626] font-medium hover:bg-orange-100 transition">Masuk</a>
        <a href="/admin/register" class="px-4 py-2 rounded-full bg-white text-[#FF8626] font-semibold border border-[#FF8626] hover:bg-orange-50 transition">Daftar</a>
      @endauth
    </div>
  </div>
</nav>



<!-- Scroll Spy Script -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll("section[id]");
  const navLinks = document.querySelectorAll(".nav-link");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const id = entry.target.getAttribute("id");

        navLinks.forEach((link) => {
          // Reset semua nav link ke default
          link.classList.remove(
            "text-[#FF8626]",
            "font-semibold",
            "border-b-2",
            "border-[#FF8626]"
          );
          link.classList.add("text-gray-700");
        });

        // Tambahkan style pada nav link yang aktif
        const activeLink = document.querySelector(`.nav-link[href="#${id}"]`);
        if (activeLink) {
          activeLink.classList.remove("text-gray-700");
          activeLink.classList.add(
            "text-[#FF8626]",
            "font-semibold",
            "border-b-2",
            "border-[#FF8626]"
          );
        }
      }
    });
  }, {
    root: null,
    rootMargin: "0px 0px -70% 0px",  // tweak ini supaya efek aktif lebih pas
    threshold: 0.3,
  });

  sections.forEach((section) => observer.observe(section));
});

</script>
<!-- Hero Section -->
<section class="relative min-h-screen text-white overflow-hidden flex items-center"
         style="background: radial-gradient(circle at top left, #ffb347, #ff8626, #ff5e3a);"
         id="home">

  <!-- Background Bubbles (5 besar, transparansi berbeda) -->
  <svg class="absolute inset-0 w-full h-full z-0 pointer-events-none" xmlns="http://www.w3.org/2000/svg">
    <!-- Bubble 1 - jelas -->
    <circle cx="15%" cy="25%" r="200" fill="white" opacity="0.08" />
    <!-- Bubble 2 - samar -->
    <circle cx="65%" cy="30%" r="250" fill="white" opacity="0.04" />
    <!-- Bubble 3 - jelas -->
    <circle cx="40%" cy="70%" r="180" fill="white" opacity="0.07" />
    <!-- Bubble 4 - sangat samar -->
    <circle cx="80%" cy="80%" r="220" fill="white" opacity="0.03" />
    <!-- Bubble 5 - sedang -->
    <circle cx="30%" cy="90%" r="150" fill="white" opacity="0.05" />
  </svg>

  <!-- Konten Utama -->
  <div class="relative z-10 w-full max-w-4xl mx-auto text-center px-6 py-24 md:py-32">
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight mb-4">
      Buat UMKM Store Kamu Sendiri <br class="hidden sm:block" /> Jadi Mudah dan Cepat.
    </h1>
    <p class="text-base sm:text-lg mb-6">
      Tingkatkan penjualan, analisa performa, dan lainnya dengan mudah.
    </p>

    <!-- Input URL + Tombol -->
    <div class="flex flex-col sm:flex-row justify-center items-center gap-3">
      <div class="flex rounded-lg overflow-hidden bg-white text-gray-700">
        <span class="px-4 py-2 bg-gray-100 font-medium whitespace-nowrap">warungin.id/</span>
        <input
          type="text"
          placeholder="tokokamu"
          class="px-4 py-2 w-48 sm:w-64 outline-none"
        >
      </div>
      <a href="/admin/register" class="px-6 py-2 rounded-lg bg-white text-[#FF8626] font-semibold hover:bg-gray-100 transition">
        Buat Gratis
      </a>
    </div>

    <p class="mt-6 font-medium">
      Tunggu apa lagi, buat toko profesionalmu!
    </p>
  </div>

  <!-- Lengkungan Bawah -->
  <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
    <svg
      class="relative block w-full h-[60px] sm:h-[80px] md:h-[100px] lg:h-[120px]"
      viewBox="0 0 1440 100"
      xmlns="http://www.w3.org/2000/svg"
      preserveAspectRatio="none"
    >
      <path fill="#ffffff" d="M0,32 C360,100 1080,0 1440,64 L1440,100 L0,100 Z" />
    </svg>
  </div>
</section>











<!-- About Warungin Section -->
<section class="relative bg-white py-24 overflow-hidden" id="about">
  <!-- Background Bubbles -->
  <div class="absolute inset-0 -z-10">
    <!-- Bubble dekoratif -->
  </div>

  <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
    <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-gray-800" data-aos="fade-up">
      Apa itu <span class="text-[#FF8626]">Warungin?</span>
    </h2>
    <p class="text-gray-600 text-lg mb-12 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
      Warungin adalah platform digital yang dirancang untuk membantu pelaku UMKM dan pedagang lokal dalam memasarkan produk mereka secara online.
      Dengan Warungin, pengguna dapat membuat etalase toko, mengelola stok barang, menerima pesanan, serta melakukan pembayaran secara digital,
      sehingga mempermudah proses jual beli dan memperluas jangkauan pasar UMKM.    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Card UMKM -->
      <div 
        class="bg-white border border-orange-200 rounded-2xl p-6 text-left shadow-lg transform transition duration-500 hover:-translate-y-2 hover:shadow-2xl"
        data-aos="fade-up" data-aos-delay="200">
        <h3 class="text-xl font-semibold text-[#FF8626] mb-2">Buat UMKM Online Store</h3>
        <p class="text-gray-700 mb-4">Daftarkan Toko kamu ke Warungin...</p>
        <a href="#" class="inline-block px-5 py-2.5 bg-[#FF8626] text-white rounded-lg shadow hover:bg-[#e76e13] transition-all duration-300">Buka Sekarang</a>
      </div>

      <!-- Card Pelanggan -->
      <div 
        class="bg-white border border-orange-100 rounded-2xl p-6 text-left shadow-lg transform transition duration-500 hover:-translate-y-2 hover:shadow-2xl"
        data-aos="fade-up" data-aos-delay="300">
        <h3 class="text-xl font-semibold text-[#FF8626] mb-2">Kunjungi Situs UMKM</h3>
        <p class="text-gray-700 mb-4">Cari UMKM favoritmu...</p>
        <a href="#" class="inline-block px-5 py-2.5 bg-[#FF8626] text-white rounded-lg shadow hover:bg-[#e76e13] transition-all duration-300">Cari UMKM</a>
      </div>
    </div>
  </div>
</section>



<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,    
    once: false,       
    mirror: true       
  });
</script>





<!-- Testimoni Section -->
<section class="relative py-24 bg-white" id="testimoni">
  <!-- Background Bubbles -->
  <div class="absolute inset-0 -z-10">
    <div class="absolute w-80 h-80 bg-[#FFF6ED] rounded-full opacity-50 blur-3xl top-0 left-1/3"></div>
    <div class="absolute w-96 h-96 bg-[#FFEFDE] rounded-full opacity-40 blur-3xl bottom-0 right-1/4"></div>
  </div>

  <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
    <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-gray-800" data-aos="fade-up">
      Apa <span class="text-[#FF8626]">Kata Mereka?</span>
    </h2>
    
    <p class="text-gray-600 text-lg max-w-xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="100">
      Testimoni dari para pengguna kami yang telah merasakan manfaat Warungin dalam memperkuat dan mengembangkan usaha mereka.
    </p>

    <!-- Statistik -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6 mb-16" data-aos="fade-up" data-aos-delay="200">
      <div><h3 class="text-3xl font-bold text-[#FF8626]">15K+</h3><p class="text-gray-600 text-sm">Pengguna UMKM</p></div>
      <div><h3 class="text-3xl font-bold text-[#FF8626]">75%</h3><p class="text-gray-600 text-sm">Tingkat Keberhasilan</p></div>
      <div><h3 class="text-3xl font-bold text-[#FF8626]">35</h3><p class="text-gray-600 text-sm">Topik Permasalahan</p></div>
      <div><h3 class="text-3xl font-bold text-[#FF8626]">26</h3><p class="text-gray-600 text-sm">Ahli Terkemuka</p></div>
      <div><h3 class="text-3xl font-bold text-[#FF8626]">16</h3><p class="text-gray-600 text-sm">Tahun Pengalaman</p></div>
      <div><h3 class="text-3xl font-bold text-[#FF8626]">All-In-One</h3><p class="text-gray-600 text-sm">Solusi Digital</p></div>
    </div>

    <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center" data-aos="fade-up" data-aos-delay="300">
      Kenapa Mereka Memilih Warungin?
    </h3>

    <!-- Scrollable Cards -->
    <div class="overflow-x-auto scroll-smooth px-4" data-aos="fade-up" data-aos-delay="400">
      <div class="flex space-x-6 pb-4">

        <!-- Card 1 -->
        <div class="flex-shrink-0 w-80 bg-white rounded-2xl border border-orange-100 p-6 shadow-lg hover:shadow-xl transition flex flex-col justify-between h-[280px]" data-aos="fade-up" data-aos-delay="500">
          <div>
            <div class="flex items-center space-x-3 mb-4">
              <div class="text-2xl bg-[#FFEFDE] w-12 h-12 rounded-full flex items-center justify-center">👩</div>
              <div>
                <h4 class="font-semibold text-[#FF8626] text-lg">Bu Rina</h4>
                <p class="text-sm text-gray-500">Pemilik Toko Sembako</p>
              </div>
            </div>
            <p class="text-gray-600 leading-relaxed">"Semenjak pakai Warungin, saya bisa kelola stok dan transaksi pelanggan secara efisien!"</p>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="flex-shrink-0 w-80 bg-white rounded-2xl border border-orange-100 p-6 shadow-lg hover:shadow-xl transition flex flex-col justify-between h-[280px]" data-aos="fade-up" data-aos-delay="600">
          <div>
            <div class="flex items-center space-x-3 mb-4">
              <div class="text-2xl bg-[#FFEFDE] w-12 h-12 rounded-full flex items-center justify-center">👨</div>
              <div>
                <h4 class="font-semibold text-[#FF8626] text-lg">Pak Aris</h4>
                <p class="text-sm text-gray-500">Pemilik Warung Kopi</p>
              </div>
            </div>
            <p class="text-gray-600 leading-relaxed">"Fitur AI-nya membantu saya melihat grafik penjualan tiap minggu. Jadi tahu kapan harus stok ulang."</p>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="flex-shrink-0 w-80 bg-white rounded-2xl border border-orange-100 p-6 shadow-lg hover:shadow-xl transition flex flex-col justify-between h-[280px]" data-aos="fade-up" data-aos-delay="700">
          <div>
            <div class="flex items-center space-x-3 mb-4">
              <div class="text-2xl bg-[#FFEFDE] w-12 h-12 rounded-full flex items-center justify-center">👩</div>
              <div>
                <h4 class="font-semibold text-[#FF8626] text-lg">Mbak Lita</h4>
                <p class="text-sm text-gray-500">UMKM Aksesoris</p>
              </div>
            </div>
            <p class="text-gray-600 leading-relaxed">"Dulu saya bingung mau jualan online. Sekarang Warungin bantu saya punya toko sendiri di web!"</p>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="flex-shrink-0 w-80 bg-white rounded-2xl border border-orange-100 p-6 shadow-lg hover:shadow-xl transition flex flex-col justify-between h-[280px]" data-aos="fade-up" data-aos-delay="800">
          <div>
            <div class="flex items-center space-x-3 mb-4">
              <div class="text-2xl bg-[#FFEFDE] w-12 h-12 rounded-full flex items-center justify-center">👨</div>
              <div>
                <h4 class="font-semibold text-[#FF8626] text-lg">Mas Dika</h4>
                <p class="text-sm text-gray-500">Penjual Sayur Online</p>
              </div>
            </div>
            <p class="text-gray-600 leading-relaxed">"Saya terbantu banget dengan fitur pembukuan otomatis, bisa tahu omset harian dengan cepat."</p>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="flex-shrink-0 w-80 bg-white rounded-2xl border border-orange-100 p-6 shadow-lg hover:shadow-xl transition flex flex-col justify-between h-[280px]" data-aos="fade-up" data-aos-delay="900">
          <div>
            <div class="flex items-center space-x-3 mb-4">
              <div class="text-2xl bg-[#FFEFDE] w-12 h-12 rounded-full flex items-center justify-center">👩</div>
              <div>
                <h4 class="font-semibold text-[#FF8626] text-lg">Bu Sari</h4>
                <p class="text-sm text-gray-500">Pemilik Kue Rumahan</p>
              </div>
            </div>
            <p class="text-gray-600 leading-relaxed">"Dengan Warungin, pesanan kue saya jadi lebih rapi. Pelanggan pun makin banyak!"</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>






<!-- Pricing Section -->
<section class="py-20 bg-white" id="paket">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-gray-800" data-aos="fade-up">
        Paket <span class="text-[#FF8626]">Siap Pakai</span>
      </h2>
      <p class="text-gray-600 text-lg max-w-xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="100">
        Ayo rasakan paket dengan keunggulan Warungin!
      </p>
    </div>

    <!-- Toggle Bulanan / Tahunan -->
    <div class="flex justify-center items-center gap-2 mb-12" data-aos="fade-up" data-aos-delay="200">
      <button class="bg-[#FF8626] text-white px-6 py-2 rounded-full text-sm font-medium transition">Bulanan</button>
      <button class="bg-gray-100 text-gray-700 px-6 py-2 rounded-full text-sm font-medium hover:bg-gray-200 transition">Tahunan</button>
    </div>

    <!-- Paket Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
      <!-- Starter -->
      <div class="border border-gray-200 rounded-xl p-8 hover:shadow-lg transition-all flex flex-col h-full" data-aos="fade-up" data-aos-delay="300">
        <div class="mb-6">
          <h3 class="text-xl font-bold text-yellow-600 mb-2">Starter</h3>
          <p class="text-gray-500 mb-6">Untuk toko UMKM yang baru memulai</p>
          
          <div class="bg-yellow-50 p-4 rounded-lg mb-6">
            <p class="text-sm text-gray-700 mb-1">💸 Biaya Setup</p>
            <p class="text-xl font-bold text-gray-800">
              <span class="line-through text-gray-500 mr-2">Rp5.000.000</span>
              <span class="text-green-600">Gratis</span>
            </p>
          </div>
          
          <ul class="space-y-3 mb-8">
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Manajemen Produk (maks 5 produk)</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Marketplace Satu Toko</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Dashboard Admin Toko</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Laporan Keuangan Dasar</span>
            </li>
          </ul>
        </div>
        <button class="mt-auto w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-3 rounded-lg transition">
          Pilih Paket
        </button>
      </div>

      <!-- Ultimate (Highlighted) -->
      <div class="border-2 border-[#FF8626] rounded-xl p-8 shadow-lg hover:shadow-xl transition-all relative bg-orange-50 flex flex-col h-full transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="400">
        <div class="absolute top-0 right-0 bg-[#FF8626] text-white text-xs px-4 py-1.5 rounded-bl-xl rounded-tr-xl font-bold">POPULER</div>
        <div class="mb-6">
          <h3 class="text-xl font-bold text-[#FF8626] mb-2">Ultimate</h3>
          <p class="text-gray-500 mb-6">Solusi lengkap untuk toko UMKM profesional</p>
          
          <div class="bg-orange-100 p-4 rounded-lg mb-6">
            <p class="text-sm text-gray-700 mb-1">💸 Biaya Setup</p>
            <p class="text-xl font-bold text-gray-800">Rp10.000.000</p>
            <p class="text-sm text-gray-700 mt-2 mb-1">📅 Langganan Bulanan</p>
            <p class="text-lg font-semibold text-[#FF8626]">Rp500.000/bulan</p>
          </div>
          
          <ul class="space-y-3 mb-8">
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Semua fitur Growth</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Unlimited User & Produk</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Manajemen Supplier Lengkap</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Laporan Stok & Transaksi Lengkap</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Analisis Penjualan & Prediksi Stok</span>
            </li>
          </ul>
        </div>
        <button class="mt-auto w-full bg-[#FF8626] hover:bg-orange-600 text-white font-medium py-3 rounded-lg transition">
          Pilih Paket
        </button>
      </div>

      <!-- Growth -->
      <div class="border border-gray-200 rounded-xl p-8 hover:shadow-lg transition-all flex flex-col h-full" data-aos="fade-up" data-aos-delay="500">
        <div class="mb-6">
          <h3 class="text-xl font-bold text-orange-600 mb-2">Growth</h3>
          <p class="text-gray-500 mb-6">Untuk toko UMKM yang sedang berkembang</p>
          
          <div class="bg-orange-50 p-4 rounded-lg mb-6">
            <p class="text-sm text-gray-700 mb-1">💸 Biaya Setup</p>
            <p class="text-xl font-bold text-gray-800">Rp7.500.000</p>
            <p class="text-sm text-gray-700 mt-2 mb-1">📅 Langganan Bulanan</p>
            <p class="text-lg font-semibold text-[#FF8626]">Rp350.000/bulan</p>
          </div>
          
          <ul class="space-y-3 mb-8">
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Semua fitur Starter</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Multi Akun Kas</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Manajemen Hutang & Piutang</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Laporan Keuangan Lengkap</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Integrasi Pembayaran Digital</span>
            </li>
          </ul>
        </div>
        <button class="mt-auto w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 rounded-lg transition">
          Pilih Paket
        </button>
      </div>
    </div>

    <!-- Catatan Tambahan -->
    <div class="mt-12 text-center text-sm text-gray-500" data-aos="fade-up" data-aos-delay="600">
      <p>* Harga belum termasuk PPN 11%</p>
      <p class="mt-2">** Paket tahunan mendapatkan diskon 15% dari total harga</p>
    </div>
  </div>
</section>







<!-- Section: Our Features -->
<section class="bg-gray-50 py-20" id="features">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-gray-800" data-aos="fade-up">
        Fitur <span class="text-[#FF8626]">Unggulan</span>
      </h2>
      <p class="text-gray-600 text-lg max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
        Warungin menyediakan solusi lengkap untuk UMKM agar memiliki lapak online profesional dengan mudah dan cepat.
      </p>
    </div>

    <!-- Feature 1 -->
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center mb-20" data-aos="fade-up">
      <div class="order-2 md:order-1">
        <div class="bg-gradient-to-br from-orange-50 to-white p-1 rounded-2xl shadow-lg">
          <img 
            src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?auto=format&fit=crop&w=800&q=80" 
            alt="Online store interface" 
            class="rounded-xl w-full h-auto object-cover"
            loading="lazy"
          >
        </div>
      </div>
      <div class="order-1 md:order-2">
        <div class="bg-white p-8 rounded-xl shadow-sm border border-orange-100">
          <h3 class="text-2xl font-bold text-gray-800 mb-4">
            <span class="text-[#FF8626]">Toko Online</span> Profesional
          </h3>
          <p class="text-gray-600 mb-6">Buat toko online dengan branding sendiri dalam hitungan menit tanpa perlu coding.</p>
          <ul class="space-y-3">
            <li class="flex items-start">
              <svg class="w-6 h-6 text-[#FF8626] mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Domain khusus dengan nama bisnis Anda</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 text-[#FF8626] mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Tema modern yang responsif di semua perangkat</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 text-[#FF8626] mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Integrasi pembayaran digital lengkap</span>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Feature 2 -->
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center mb-20" data-aos="fade-up">
      <div class="order-1">
        <div class="bg-white p-8 rounded-xl shadow-sm border border-orange-100">
          <h3 class="text-2xl font-bold text-gray-800 mb-4">
            <span class="text-[#FF8626]">Manajemen</span> Produk & Stok
          </h3>
          <p class="text-gray-600 mb-6">Kelola ribuan produk dengan mudah dan pantau stok secara real-time.</p>
          <ul class="space-y-3">
            <li class="flex items-start">
              <svg class="w-6 h-6 text-[#FF8626] mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Katalog produk dengan foto dan deskripsi lengkap</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 text-[#FF8626] mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Notifikasi stok hampir habis</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 text-[#FF8626] mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Manajemen varian produk (warna, ukuran, dll)</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="order-2">
        <div class="bg-gradient-to-br from-orange-50 to-white p-1 rounded-2xl shadow-lg">
          <img 
            src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?auto=format&fit=crop&w=800&q=80" 
            alt="Product management dashboard" 
            class="rounded-xl w-full h-auto object-cover"
            loading="lazy"
          >
        </div>
      </div>
    </div>

    <!-- Feature 3 -->
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center" data-aos="fade-up">
      <div class="order-2 md:order-1">
        <div class="bg-gradient-to-br from-orange-50 to-white p-1 rounded-2xl shadow-lg">
          <img 
            src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80" 
            alt="Sales analytics dashboard" 
            class="rounded-xl w-full h-auto object-cover"
            loading="lazy"
          >
        </div>
      </div>
      <div class="order-1 md:order-2">
        <div class="bg-white p-8 rounded-xl shadow-sm border border-orange-100">
          <h3 class="text-2xl font-bold text-gray-800 mb-4">
            <span class="text-[#FF8626]">Analitik</span> & Laporan
          </h3>
          <p class="text-gray-600 mb-6">Pantau perkembangan bisnis dengan data penjualan yang akurat dan mudah dipahami.</p>
          <ul class="space-y-3">
            <li class="flex items-start">
              <svg class="w-6 h-6 text-[#FF8626] mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Dashboard penjualan real-time</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 text-[#FF8626] mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Laporan harian/mingguan/bulanan</span>
            </li>
            <li class="flex items-start">
              <svg class="w-6 h-6 text-[#FF8626] mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-600">Analisis produk terlaris & pelanggan setia</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>



</body>







<footer class="bg-gray-100 border-t border-gray-200 pt-10">
  <div class="max-w-7xl mx-auto px-6 md:px-10 grid grid-cols-1 md:grid-cols-4 gap-8">
    <!-- Logo & Apps -->
    <div>
      <h2 class="text-xl font-bold text-[#FF8626]">Warungin</h2>
      <div class="flex gap-3 mt-4">
        <a href="#">
          <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="Download on the App Store" class="h-10">

        </a>
        <a href="#">
          <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play" class="h-10">
        </a>
      </div>
      <p class="text-sm text-gray-500 mt-3">Company # 12345678, Registered with Kementerian Perdagangan RI</p>
    </div>

    <!-- Newsletter -->
    <div>
      <h3 class="text-md font-semibold text-[#FF8626] mb-2">Dapatkan Info & Promo Terbaru</h3>
      <form class="flex flex-col sm:flex-row items-center gap-2">
        <input type="email" placeholder="emailanda@gmail.com" class="w-full px-3 py-2 rounded-md border text-sm focus:ring-2 focus:ring-[#FF8626]">
        <button type="submit" class="bg-[#FF8626] hover:bg-orange-700 text-white text-sm px-4 py-2 rounded-md">Langganan</button>
      </form>
      <p class="text-xs text-gray-400 mt-1">Kami tidak akan mengirim spam. Lihat <a href="#" class="underline">kebijakan email</a></p>
    </div>

    <!-- Legal -->
    <div>
      <h3 class="text-md font-semibold text-[#FF8626] mb-2">Legal</h3>
      <ul class="space-y-1 text-sm text-gray-600">
        <li><a href="#">Syarat & Ketentuan</a></li>
        <li><a href="#">Kebijakan Privasi</a></li>
        <li><a href="#">Kebijakan Cookie</a></li>
        <li><a href="#">Transparansi Usaha</a></li>
      </ul>
    </div>

    <!-- Tautan Penting -->
    <div>
      <h3 class="text-md font-semibold text-[#FF8626] mb-2">Tautan Penting</h3>
      <ul class="space-y-1 text-sm text-gray-600">
        <li><a href="#">Pusat Bantuan</a></li>
        <li><a href="#">Gabung Jadi Mitra</a></li>
        <li><a href="#">Daftar Warung</a></li>
        <li><a href="#">Buat Akun Bisnis</a></li>
      </ul>
    </div>
  </div>

<!-- Footer Bottom -->
<div class="w-full bg-[#FF8626] mt-10 py-4">
  <div class="max-w-7xl mx-auto px-6 md:px-10 flex flex-col md:flex-row items-center justify-between text-white text-sm">
    <p>© Warungin 2025. Semua Hak Dilindungi.</p>
    <div class="flex gap-4 mt-2 md:mt-0">
      <a href="#" class="hover:underline">Kebijakan Privasi</a>
      <a href="#" class="hover:underline">Syarat</a>
      <a href="#" class="hover:underline">Harga</a>
      <a href="#" class="hover:underline">Jangan bagikan dataku</a>
    </div>
  </div>
</div>





</html>
