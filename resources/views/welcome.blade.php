<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Warungin - Landing Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-100">

 <!-- Navbar -->
<nav class="bg-white shadow fixed w-full z-50" id="navbar">
  <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
    <div class="text-2xl font-bold text-[#FF8626]">
      Warungin
    </div>
    <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
      <li><a href="#home" class="nav-link hover:text-[#FF8626] transition duration-300">Beranda</a></li>
      <li><a href="#about" class="nav-link hover:text-[#FF8626] transition duration-300">Tentang</a></li>
      <li><a href="#testimoni" class="nav-link hover:text-[#FF8626] transition duration-300">Testimoni</a></li>
      <li><a href="#paket" class="nav-link hover:text-[#FF8626] transition duration-300">Harga</a></li>
      <li><a href="#features" class="nav-link hover:text-[#FF8626] transition duration-300">Fitur</a></li>
    </ul>
    <div class="flex space-x-3">
      <a href="/admin/login" class="px-4 py-2 rounded-full text-[#FF8626] font-medium hover:bg-orange-100 transition">Masuk</a>
      <a href="/admin/register" class="px-4 py-2 rounded-full bg-white text-[#FF8626] font-semibold border border-[#FF8626] hover:bg-orange-50 transition">Daftar</a>
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
<section class="relative min-h-screen bg-[#FF8626] text-white overflow-hidden flex items-center" id="home">
  <!-- Background Pattern SVG garis diagonal -->
  <svg class="absolute inset-0 w-full h-full z-0 opacity-20 pointer-events-none" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <pattern id="diagonalLines" patternUnits="userSpaceOnUse" width="20" height="20" patternTransform="rotate(45)">
        <line x1="0" y="0" x2="0" y2="20" stroke="white" stroke-width="1" />
      </pattern>
    </defs>
    <rect width="100%" height="100%" fill="url(#diagonalLines)" />
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








<!-- About Warungin -->
<section class="bg-white py-16" id="about">
  <div class="max-w-5xl mx-auto px-6 text-center">
    <h2 class="text-2xl font-bold mb-2">What is <span class="text-[#FF8626]">Warungin?</span></h2>
    <p class="text-gray-600 mb-10">
      Warungin adalah platform digital yang dirancang untuk membantu pelaku UMKM dan pedagang lokal dalam memasarkan produk mereka secara online.
      Dengan Warungin, pengguna dapat membuat etalase toko, mengelola stok barang, menerima pesanan, serta melakukan pembayaran secara digital,
      sehingga mempermudah proses jual beli dan memperluas jangkauan pasar UMKM.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Card UMKM -->
      <div class="bg-[#FFEFDE] rounded-xl p-6 text-left shadow-md hover:shadow-xl transition">
        <h3 class="text-xl font-semibold mb-2">Buat UMKM Online Store</h3>
        <p class="text-gray-700 mb-4">Daftarkan Toko kamu ke Warungin untuk membuat online store</p>
        <a href="#" class="inline-block px-4 py-2 bg-[#FF8626] text-white rounded hover:bg-[#e76e13] transition">Buka Sekarang</a>
      </div>
      <!-- Card Pelanggan -->
      <div class="bg-[#FFF6ED] rounded-xl p-6 text-left shadow-md hover:shadow-xl transition">
        <h3 class="text-xl font-semibold mb-2">Kunjungi Situs UMKM</h3>
        <p class="text-gray-700 mb-4">Cari UMKM favoritmu di Platform Warungin dan beli produknya!</p>
        <a href="#" class="inline-block px-4 py-2 bg-[#FF8626] text-white rounded hover:bg-[#e76e13] transition">Cari UMKM</a>
      </div>
    </div>
  </div>
</section>








<!-- Testimoni Section -->
<section class="text-center py-20 bg-white" id="testimoni">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Apa Kata Mereka?</h2>
    <p class="text-gray-600 max-w-xl mx-auto mb-12">
      Testimoni dari para pengguna kami yang telah merasakan manfaat Warungin dalam memperkuat dan mengembangkan usaha mereka.
    </p>

    <!-- Testimoni Statistik -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6 mb-16">
      <div>
        <h3 class="text-2xl font-bold text-[#FF8626]">15K+</h3>
        <p class="text-gray-600 text-sm">Pengguna UMKM</p>
      </div>
      <div>
        <h3 class="text-2xl font-bold text-[#FF8626]">75%</h3>
        <p class="text-gray-600 text-sm">Tingkat Keberhasilan</p>
      </div>
      <div>
        <h3 class="text-2xl font-bold text-[#FF8626]">35</h3>
        <p class="text-gray-600 text-sm">Topik Permasalahan</p>
      </div>
      <div>
        <h3 class="text-2xl font-bold text-[#FF8626]">26</h3>
        <p class="text-gray-600 text-sm">Ahli Terkemuka</p>
      </div>
      <div>
        <h3 class="text-2xl font-bold text-[#FF8626]">16</h3>
        <p class="text-gray-600 text-sm">Tahun Pengalaman</p>
      </div>
      <div>
        <h3 class="text-2xl font-bold text-[#FF8626]">All-In-One</h3>
        <p class="text-gray-600 text-sm">Solusi Digital</p>
      </div>
    </div>

    <!-- Fitur Utama sebagai Alasan Kepercayaan -->
    <h3 class="text-xl font-semibold text-gray-800 mb-8">Kenapa Mereka Memilih Warungin?</h3>
    <div class="grid gap-6 md:grid-cols-3">
      <!-- Card 1 -->
      <div class="bg-white rounded-xl shadow-lg p-6 text-left hover:shadow-xl transition">
        <div class="bg-[#FFEFDE] w-12 h-12 rounded-full flex items-center justify-center mb-4 text-2xl">📦</div>
        <h4 class="font-semibold text-lg mb-2 text-[#FF8626]">Transaksi Mudah & Customer UMKM</h4>
        <p class="text-sm text-gray-600">
          “Semenjak pakai Warungin, saya bisa kelola stok dan transaksi pelanggan secara efisien!” –<br><span class="italic">Bu Rina, Pemilik Toko Sembako</span>
        </p>
      </div>
      <!-- Card 2 -->
      <div class="bg-white rounded-xl shadow-lg p-6 text-left hover:shadow-xl transition">
        <div class="bg-[#FFEFDE] w-12 h-12 rounded-full flex items-center justify-center mb-4 text-2xl">📊</div>
        <h4 class="font-semibold text-lg mb-2 text-[#FF8626]">Analisis Performa Bisnis AI</h4>
        <p class="text-sm text-gray-600">
          “Fitur AI-nya membantu saya melihat grafik penjualan tiap minggu. Jadi tahu kapan harus stok ulang.” –<br><span class="italic">Pak Aris, Pemilik Warung Kopi</span>
        </p>
      </div>
      <!-- Card 3 -->
      <div class="bg-white rounded-xl shadow-lg p-6 text-left hover:shadow-xl transition">
        <div class="bg-[#FFEFDE] w-12 h-12 rounded-full flex items-center justify-center mb-4 text-2xl">🛒</div>
        <h4 class="font-semibold text-lg mb-2 text-[#FF8626]">Marketplace Generator</h4>
        <p class="text-sm text-gray-600">
          “Dulu saya bingung mau jualan online. Sekarang Warungin bantu saya punya toko sendiri di web!” –<br><span class="italic">Mbak Lita, UMKM Aksesoris</span>
        </p>
      </div>
    </div>
  </div>
</section>







<!-- Pricing Section -->
<section class="py-20 bg-white text-center" id="paket">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4" >Paket Siap Pakai</h2>
    <p class="text-gray-600 max-w-xl mx-auto mb-12">
      Solusi lengkap dengan harga hemat untuk kebutuhan toko UMKM anda
    </p>

    <!-- Toggle Bulanan / Tahunan -->
    <div class="flex justify-center items-center gap-2 mb-8">
      <button class="bg-[#FF8626] text-white px-4 py-2 rounded-full text-sm font-medium">Bulan</button>
      <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium">Tahun</button>
    </div>

    <!-- Paket Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Starter -->
      <div class="border rounded-xl p-6 shadow hover:shadow-lg transition flex flex-col justify-between h-full">
        <div>
          <h3 class="text-lg font-semibold text-yellow-600 mb-2">Starter</h3>
          <p class="text-sm text-gray-500 mb-4">Untuk toko UMKM yang baru memulai</p>
          <!-- Setup Fee Promo -->
          <div class="mb-4">
            <p class="text-sm text-gray-700">💸 Setup Fee</p>
            <p class="text-xl font-bold text-gray-800">
              <span class="line-through text-black-500 mr-2">Rp5.000.000</span>
              <span class="text-green-600 font-semibold">Rp0 (Gratis)</span>
            </p>
          </div>
          <ul class="text-left text-sm text-gray-600 space-y-2 mb-6">
            <li>✅ Manajemen Produk (maksimal 5 produk)</li>
            <li>✅ Manajemen Kategori Produk</li>
            <li>✅ Marketplace Satu Toko</li>
            <li>✅ Dashboard Admin Toko</li>
            <li>✅ Laporan Keuangan</li>
            <li>✅ Tidak Perlu Hosting</li>
          </ul>
        </div>
        <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-5 py-2 rounded-full mt-auto">Pilih Paket</button>
      </div>

      <!-- Ultimate -->
      <div class="border-2 border-[#FF8626] rounded-xl p-6 shadow-lg hover:shadow-xl transition relative bg-orange-50 flex flex-col justify-between h-full">
        <div>
          <div class="absolute top-0 right-0 bg-[#FF8626] text-white text-xs px-3 py-1 rounded-bl-xl font-semibold">Paling Populer</div>
          <h3 class="text-lg font-semibold text-[#FF8626] mb-2">Ultimate</h3>
          <p class="text-sm text-gray-500 mb-4">Solusi lengkap untuk toko UMKM profesional</p>
          <div class="mb-4">
            <p class="text-sm text-gray-700">💸 Setup Fee</p>
            <p class="text-xl font-bold text-gray-800">Rp10.000.000</p>
          </div>
          <div class="mb-6">
            <p class="text-sm text-gray-700">📅 Langganan</p>
            <p class="text-lg font-semibold text-[#FF8626]">Rp500.000 /bulan</p>
          </div>
          <ul class="text-left text-sm text-gray-600 space-y-2 mb-6">
            <li>✅ Semua fitur dari paket Growth</li>
            <li>✅ Unlimited User</li>
            <li>✅ Pencatatan Jenis Bahan</li>
            <li>✅ Pencatatan Pembelian dari Supplier</li>
            <li>✅ Pencatatan Penjualan Kembali ke Supplier</li>
            <li>✅ Pencatatan Penjualan ke Pelanggan</li>
            <li>✅ Pencatatan Pengembalian ke Pelanggan</li>
            <li>✅ Pencatatan Penjualan Kembali dari Pelanggan</li>
            <li>✅ Laporan Stok per Item</li>
            <li>✅ Laporan Stok Berdasarkan Kategori Produk</li>
            <li>✅ Laporan Stok Berdasarkan Kadar</li>
            <li>✅ Laporan Ringkasan Transaksi per Kategori</li>
          </ul>
        </div>
        <button class="bg-[#FF8626] hover:bg-orange-600 text-white font-medium px-5 py-2 rounded-full mt-auto">Pilih Paket</button>
      </div>

      <!-- Growth -->
      <div class="border rounded-xl p-6 shadow hover:shadow-lg transition flex flex-col justify-between h-full">
        <div>
          <h3 class="text-lg font-semibold text-orange-600 mb-2">Growth</h3>
          <p class="text-sm text-gray-500 mb-4">Untuk toko UMKM yang sedang berkembang</p>
          <div class="mb-4">
            <p class="text-sm text-gray-700">💸 Setup Fee</p>
            <p class="text-xl font-bold text-gray-800">Rp7.500.000</p>
          </div>
          <div class="mb-6">
            <p class="text-sm text-gray-700">📅 Langganan</p>
            <p class="text-lg font-semibold text-[#FF8626]">Rp350.000 /bulan</p>
          </div>
          <ul class="text-left text-sm text-gray-600 space-y-2 mb-6">
            <li>✅ Semua fitur dari paket Starter</li>
            <li>✅ Pencatatan Multi Akun Kas</li>
            <li>✅ Penyesuaian dan Transfer Saldo Kas</li>
            <li>✅ Pembayaran ke Supplier via Akun Kas Tertentu</li>
            <li>✅ Multi Pembayaran ke Supplier</li>
            <li>✅ Pencatatan Hutang & Piutang dengan Supplier</li>
            <li>✅ Pembayaran Pelanggan via Akun Kas Tertentu</li>
            <li>✅ Pencatatan Piutang & Retur dari Pelanggan</li>
            <li>✅ Laporan Saldo & Arus Kas per Akun</li>
            <li>✅ Ringkasan Transaksi Kas dan Hutang-Piutang</li>
          </ul>
        </div>
        <button class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-5 py-2 rounded-full mt-auto">Pilih Paket</button>
      </div>
    </div>
  </div>
</section>









<!-- Section: Our Features -->
<section class="bg-gray-50 py-16 text-center" id="features">
  <h2 class="text-2xl font-bold mb-2">Our <span class="text-[#FF8626]">Features?</span></h2>
  <p class="text-gray-600 mb-12 max-w-xl mx-auto">
    Warungin menyediakan solusi lengkap untuk UMKM agar memiliki lapak online profesional dengan mudah dan cepat.
  </p>

  <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center px-6">
    <div>
      <img 
        src="https://images.unsplash.com/photo-1556740749-887f6717d7e4?auto=format&fit=crop&w=800&q=80" 
        alt="UMKM owner using laptop" 
        class="rounded-xl shadow"
      >
    </div>
    <div class="text-left">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">
        Halaman <span class="text-[#FF8626]">toko online</span> khusus untuk UMKM
      </h3>
      <ul class="list-disc pl-6 text-gray-600 space-y-2">
        <li>UMKM dapat membuat dan mengelola toko online dengan nama unik dan mudah diingat.</li>
        <li>Tampilan profesional yang menarik dan mudah digunakan oleh pelanggan.</li>
        <li>Integrasi fitur analisa performa penjualan dan pengelolaan produk secara real-time.</li>
      </ul>
    </div>
  </div>
</section>

<!-- Section: Tools For Teachers And Learners -->
<section class="bg-white py-16">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
    <div>
      <h3 class="text-xl font-semibold text-gray-800 mb-4">
        <span class="text-[#FF8626]">Alat</span> Lengkap untuk Kelola Toko UMKM
      </h3>
      <p class="text-gray-600 mb-4">
        Warungin menyediakan berbagai alat yang membantu UMKM mengatur katalog produk, promosi, hingga analisis penjualan dalam satu platform terpadu.
      </p>
    </div>
    <div>
      <img 
        src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" 
        alt="UMKM managing online shop dashboard" 
        class="rounded-xl shadow-lg"
      >
    </div>
  </div>
</section>

<section class="bg-gray-50 py-16 text-center">
  <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center px-6">
    <div>
      <img 
        src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=800&q=80" 
        alt="UMKM owner analyzing sales data" 
        class="rounded-xl shadow"
      >
    </div>
    <div class="text-left">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">
        Dashboard <span class="text-[#FF8626]">analitik</span> dan laporan penjualan
      </h3>
      <ul class="list-disc pl-6 text-gray-600 space-y-2">
        <li>Memantau performa toko dan produk secara mudah melalui laporan lengkap.</li>
        <li>Data penjualan dan pelanggan dapat diakses secara real-time untuk pengambilan keputusan cepat.</li>
        <li>Fitur promosi yang membantu meningkatkan penjualan dan menjangkau lebih banyak pelanggan.</li>
      </ul>
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
