<div
        id="featureModal"
        class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4"
    >
        <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 relative">
            <button
                type="button"
                onclick="closeModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-3xl leading-none"
            >
                &times;
            </button>

            <div class="w-14 h-14 rounded-2xl bg-[#49a35a] text-white flex items-center justify-center text-2xl mb-5">
                <i class="fas fa-seedling"></i>
            </div>

            <h3 id="modalTitle" class="text-3xl font-bold text-[#1f3b2f] mb-4"></h3>
            <p id="modalContent" class="text-[#708277] leading-relaxed text-base"></p>

            <div class="mt-8">
                <button
                    type="button"
                    onclick="closeModal()"
                    class="bg-[#49a35a] hover:bg-[#3f8e4e] text-white px-5 py-3 rounded-xl font-semibold transition"
                >
                    Tutup
                </button>
            </div>
        </div>
</div>