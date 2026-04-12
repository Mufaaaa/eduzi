<div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
    <div class="flex items-start gap-4">
        <!-- Avatar -->
        <div class="flex-shrink-0">
            <img src="{{ $avatar ?? 'https://ui-avatars.com/api/?name=User' }}" 
                 alt="{{ $name }}" 
                 class="w-10 h-10 rounded-full object-cover bg-gray-200">
        </div>
        
        <div class="flex-1">
            <!-- Header Post -->
            <div class="flex items-center gap-2 mb-2">
                <h4 class="font-bold text-gray-800 text-sm">{{ $name }}</h4>
                <span class="text-xs text-gray-400">{{ $time }}</span>
            </div>
            
            <!-- Isi Konten -->
            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                {{ $slot }}
            </p>
            
            <!-- Footer Post (Interaction) -->
            <div class="flex items-center gap-4 text-gray-400">
                <button class="flex items-center gap-1.5 hover:text-red-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span class="text-xs">{{ $likes }}</span>
                </button>
                <button class="flex items-center gap-1.5 hover:text-emerald-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span class="text-xs">{{ $comments }}</span>
                </button>
            </div>
        </div>
    </div>
</div>