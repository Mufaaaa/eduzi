<!-- Navbar -->
@php
    $user = Auth::user();
    $avatar = $user->avatar ?? null;
    $isGoogleAvatar = $avatar ? filter_var($avatar, FILTER_VALIDATE_URL) : false;
    $avatarSrc = $avatar
        ? ($isGoogleAvatar ? $avatar : asset('storage/' . $avatar))
        : null;
@endphp

<nav class="fixed top-0 left-0 w-full bg-white shadow-md px-6 py-4 flex justify-between items-center z-50 border-b border-gray-200">
    
    <!-- Logo -->
    <a href="/home" class="flex items-center space-x-3">
        <img 
            src="{{ asset('images/Logo.png') }}" 
            alt="Logo Eduzi"
            class="w-20 h-20 object-contain"
        >
    </a>

    <!-- Menu Desktop -->
    <ul class="hidden md:flex space-x-8 text-gray-900 font-medium">
        <li><a href="/home" class="hover:text-[#49a35a] transition-colors">Beranda</a></li>
        <li><a href="/artikel-video" class="hover:text-[#49a35a] transition-colors">Artikel</a></li>
        <li><a href="/komunitas" class="hover:text-[#49a35a] transition-colors">Komunitas</a></li>
        <li><a href="/kalkulator" class="hover:text-[#49a35a] transition-colors">Kalkulator Gizi</a></li>
    </ul>

    <!-- Profile Desktop -->
    <div class="hidden md:flex items-center relative">
        <div class="relative">
            <button id="profile-btn" type="button"
                class="w-12 h-12 rounded-full overflow-hidden border-2 border-black shadow-[-3px_3px_0px_rgba(0,0,0,1)] hover:opacity-90 transition">
                
                @if($avatarSrc)
                    <img 
                        src="{{ $avatarSrc }}" 
                        alt="Avatar {{ $user->name }}"
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full bg-[#49a35a] text-white font-bold flex items-center justify-center">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </button>

            <!-- Dropdown Profile -->
            <div id="profile-dropdown"
                class="hidden absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden z-50">
                
                <div class="px-4 py-4 border-b border-gray-100">
                    <p class="font-bold text-[#16352d]">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500 break-all">{{ $user->email }}</p>
                </div>

                <div class="py-2">
                    <a href="/profile"
                       class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#49a35a] transition">
                        Profile Saya
                    </a>

                    <a href="/ganti-password"
                       class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#49a35a] transition">
                        Ganti Kata Sandi
                    </a>   

                     <a href="/riwayat"
                       class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#49a35a] transition">
                        Riwayat
                    </a>  
    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-3 text-red-500 hover:bg-red-50 transition">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Hamburger Mobile -->
    <button id="mobile-menu-btn" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        
        <svg id="hamburger-icon" class="w-6 h-6" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
        </svg>

        <svg id="close-icon" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</nav>

<!-- Mobile Menu -->
<div id="menu-mobile"
     class="hidden fixed top-24 left-0 w-full bg-white shadow-md md:hidden transform scale-95 opacity-0 transition-all duration-300 ease-out z-40 border-t border-gray-200">

    <ul class="flex flex-col items-center gap-4 py-6 text-gray-700 font-medium">
        <li><a href="/home" class="hover:text-[#49a35a] transition-colors">Beranda</a></li>
        <li><a href="/artikel-video" class="hover:text-[#49a35a] transition-colors">Artikel</a></li>
        <li><a href="/komunitas" class="hover:text-[#49a35a] transition-colors">Komunitas</a></li>
        <li><a href="/kalkulator" class="hover:text-[#49a35a] transition-colors">Kalkulator Gizi</a></li>

        <!-- Profile Mobile -->
        <div class="w-full px-4 pt-4 border-t border-gray-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full overflow-hidden border border-gray-300">
                    @if($avatarSrc)
                        <img 
                            src="{{ $avatarSrc }}" 
                            alt="Avatar {{ $user->name }}"
                            class="w-full h-full object-cover"
                        >
                    @else
                        <div class="w-full h-full bg-[#49a35a] text-white font-bold flex items-center justify-center">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div>
                    <p class="font-semibold text-[#16352d]">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500 break-all">{{ $user->email }}</p>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <a href="/profile"
                   class="w-full py-3 text-center text-gray-900 border border-gray-300 rounded-full hover:bg-gray-100 transition font-semibold">
                    Profile Saya
                </a>

                <a href="/ganti-password"
                   class="w-full py-3 text-center text-gray-900 border border-gray-300 rounded-full hover:bg-gray-100 transition font-semibold">
                    Ganti Kata Sandi
                </a> 

                <a href="/riwayat"
                    class="w-full py-3 text-center text-gray-900 border border-gray-300 rounded-full hover:bg-gray-100 transition font-semibold">
                    Riwayat
                </a>   

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full py-3 text-white bg-red-500 rounded-full hover:bg-red-600 transition font-semibold">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </ul>
</div>

<!-- Spacer -->
<div class="pt-24"></div>

<script>
const menuBtn = document.getElementById("mobile-menu-btn");
const menuMobile = document.getElementById("menu-mobile");
const openIcon = document.getElementById("hamburger-icon");
const closeIcon = document.getElementById("close-icon");

if (menuBtn && menuMobile && openIcon && closeIcon) {
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
}

const profileBtn = document.getElementById("profile-btn");
const profileDropdown = document.getElementById("profile-dropdown");

if (profileBtn && profileDropdown) {
    profileBtn.addEventListener("click", function(e) {
        e.stopPropagation();
        profileDropdown.classList.toggle("hidden");
    });

    document.addEventListener("click", function(e) {
        if (!profileDropdown.contains(e.target) && !profileBtn.contains(e.target)) {
            profileDropdown.classList.add("hidden");
        }
    });
}
</script>