<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full bg-white shadow-md px-6 py-4 flex justify-between items-center z-50 border-b border-gray-200">
    
    <!-- Logo -->
    <a href="#" class="flex items-center space-x-3">
        <img 
            src="{{ asset('images/Logo.png') }}" 
            alt="Logo Eduzi"
            class="w-20 h-20 object-contain"
        >
    </a>

    <!-- Menu Desktop -->
    <ul class="hidden md:flex space-x-8 text-gray-900 font-medium">
        <li><a href="/" class="hover:text-[#49a35a] transition-colors">Beranda</a></li>
        <li><a href="/artikel" class="hover:text-[#49a35a] transition-colors">Artikel</a></li>
        <li><a href="/komunitas" class="hover:text-[#49a35a] transition-colors">Komunitas</a></li>
        <li><a href="/kalkulator" class="hover:text-[#49a35a] transition-colors">Kalkulator Gizi</a></li>
    </ul>

    <!-- Tombol kanan desktop -->
    <div class="hidden md:flex items-center gap-3">
        <a href="/daftar"
           class="py-2 px-6 text-gray-900 font-semibold border border-black rounded-xl 
                  shadow-[-4px_4px_0px_rgba(0,0,0,1)] 
                  hover:translate-x-[-2px] hover:translate-y-[2px] 
                  hover:shadow-[-2px_2px_0px_rgba(0,0,0,1)] 
                  hover:bg-gray-100 transition duration-200 ease-in-out">
            Daftar
        </a>

        <a href="/masuk"
           class="py-2 px-6 text-white font-semibold bg-[#49a35a] border border-black rounded-xl 
                  shadow-[-4px_4px_0px_rgba(0,0,0,1)] 
                  hover:translate-x-[-2px] hover:translate-y-[2px] 
                  hover:shadow-[-2px_2px_0px_rgba(0,0,0,1)] 
                  hover:bg-[#3f8d50] transition duration-200 ease-in-out">
            Masuk
        </a>
    </div>

    <!-- Tombol Hamburger Mobile -->
    <button id="mobile-menu-btn" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open main menu</span>

        <svg id="hamburger-icon" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15" />
        </svg>

        <svg id="close-icon" class="w-6 h-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</nav>

<!-- Menu Mobile -->
<div id="menu-mobile"
     class="hidden fixed top-[100px] left-0 w-full bg-white shadow-md md:hidden 
            transform scale-95 opacity-0 transition-all duration-300 ease-out 
            z-40 border-t border-gray-200">

    <ul class="flex flex-col items-center gap-4 py-6 text-gray-700 font-medium">
        <li><a href="/" class="hover:text-[#49a35a] transition-colors">Beranda</a></li>
        <li><a href="/artikel" class="hover:text-[#49a35a] transition-colors">Artikel</a></li>
        <li><a href="/komunitas" class="hover:text-[#49a35a] transition-colors">Komunitas</a></li>
        <li><a href="/kalkulator" class="hover:text-[#49a35a] transition-colors">Kalkulator Gizi</a></li>

        <div class="w-full px-4 flex flex-col gap-3 pt-2">
            <a href="#"
               class="w-full py-3 text-gray-900 border border-black rounded-full 
                      hover:bg-gray-100 transition text-center font-semibold">
                Daftar
            </a>

            <a href="#"
               class="w-full py-3 text-white bg-[#49a35a] rounded-full 
                      hover:bg-[#3f8d50] transition text-center font-semibold">
                Masuk
            </a>
        </div>
    </ul>
</div>

<!-- Spacer supaya konten tidak ketutup navbar -->
<div class="pt-24"></div>

<script>
    const menuBtn = document.getElementById("mobile-menu-btn");
    const menuMobile = document.getElementById("menu-mobile");
    const openIcon = document.getElementById("hamburger-icon");
    const closeIcon = document.getElementById("close-icon");

    menuBtn.addEventListener("click", () => {
        const isHidden = menuMobile.classList.contains("hidden");

        if (isHidden) {
            menuMobile.classList.remove("hidden");
            openIcon.classList.add("hidden");
            closeIcon.classList.remove("hidden");

            setTimeout(() => {
                menuMobile.classList.remove("scale-95", "opacity-0");
            }, 10);
        } else {
            menuMobile.classList.add("scale-95", "opacity-0");
            openIcon.classList.remove("hidden");
            closeIcon.classList.add("hidden");

            setTimeout(() => {
                menuMobile.classList.add("hidden");
            }, 300);
        }
    });
</script>