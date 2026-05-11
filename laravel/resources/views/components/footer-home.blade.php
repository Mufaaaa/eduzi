<footer class="bg-[#F0FAF2] text-gray-800 border-t border-gray-200">

  <!-- Kotak utama -->
  <div class="max-w-7xl mx-auto px-10 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">

    <!-- Kolom 1: Logo dan Deskripsi -->
    <div class="flex flex-col items-start space-y-3">
      <div class="flex items-center">
        <img 
          src="{{ asset('images/Logo.png') }}" 
          alt="Logo Eduzi"
          class="w-16 h-16 object-contain mr-2"
        >
      </div>

      <p class="text-sm leading-relaxed text-gray-700 pr-6">
        Platform edukasi gizi digital untuk membantu orang tua memahami gizi
        seimbang dan mencegah stunting pada anak sejak dini.
      </p>
    </div>

    <!-- Kolom 2: Navigasi -->
    <div class="space-y-3">
      <h3 class="font-bold text-lg mb-2">Navigasi</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="/home" class="hover:text-[#49a35a] transition">Beranda</a></li>
        <li><a href="/artikel-video" class="hover:text-[#49a35a] transition">Artikel</a></li>
        <li><a href="/kalkulator" class="hover:text-[#49a35a] transition">Kalkulator Gizi</a></li>
        <li><a href="/komunitas" class="hover:text-[#49a35a] transition">Komunitas</a></li>
      </ul>
    </div>

    <!-- Kolom 3: Hubungi Kami -->
    <div class="space-y-3">
      <h3 class="font-bold text-lg mb-2">Hubungi Kami</h3>
      <ul class="space-y-3 text-sm">
        <li class="flex items-center space-x-3">
          <i class="fas fa-phone text-[#49a35a]"></i>
          <span>+62 81234567</span>
        </li>

        <li class="flex items-center space-x-3">
          <i class="fas fa-map-marker-alt text-[#49a35a]"></i>
          <span>Politeknik Negeri Batam</span>
        </li>

        <li class="flex items-center space-x-3">
          <i class="fas fa-envelope text-[#49a35a]"></i>
          <span>eduzi@gmail.com</span>
        </li>
      </ul>
    </div>

    <!-- Kolom 4: Ikuti Kami -->
    <div class="space-y-3">
      <h3 class="font-bold text-lg mb-2">Ikuti Kami</h3>

      <ul class="space-y-3 text-sm">
        <li class="flex items-center space-x-3">
          <i class="fab fa-twitter text-[#49a35a]"></i>
          <span><a href="#">Twitter</a></span>
        </li>

        <li class="flex items-center space-x-3">
          <i class="fab fa-instagram text-[#49a35a]"></i>
          <span><a href="#">Instagram</a></span>
        </li>

        <li class="flex items-center space-x-3">
          <i class="fab fa-youtube text-[#49a35a]"></i>
          <span><a href="#">Youtube</a></span>
        </li>
      </ul>
    </div>

  </div>

  <!-- Copyright -->
  <div class="bg-[#49a35a] text-white text-center text-sm py-3">
    ©2026 Eduzi, All Rights Reserved
  </div>

</footer>