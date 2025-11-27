<section
    class="relative w-full min-h-[95vh] flex items-center justify-center 
    bg-[#2F2419] text-white overflow-hidden">

    <!-- BACKGROUND IMAGE -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1500&q=80"
            class="w-full h-full object-cover opacity-60">
    </div>

    <!-- GRADIENT DARKEN -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#1E140C]/80 via-[#2F2419]/70 to-[#1A120A]/85"></div>

    <!-- CONTENT -->
    <div
        class="relative z-10 w-full max-w-[1650px] mx-auto px-10 md:px-24 py-24
        flex flex-col md:flex-row items-center justify-between gap-24">

        <!-- LEFT TEXT -->
        <div class="flex-1">

            <h1 class="text-4xl md:text-6xl font-extrabold leading-[1.2] mb-6 tracking-tight">
                Timeless Furniture
            </h1>


            <p class="text-[#EADCCD] text-lg md:text-xl max-w-xl mb-10 leading-relaxed">
                Crafted with precision and designed to elevate any room—our premium furniture
                brings warmth, character, and modern elegance into your home.
            </p>

            <div class="flex gap-6">
                <a href="{{ route('katalog.index') }}"
                    class="bg-white text-[#2F2419] px-12 py-4 rounded-full font-semibold
                          shadow-xl shadow-black/40 hover:bg-[#EADCCD] active:scale-95 transition-all">
                    Shop Now
                </a>

                <a href="#about"
                    class="border-2 border-white px-12 py-4 rounded-full font-semibold
                          hover:bg-white hover:text-[#2F2419] active:scale-95 transition-all">
                    Explore
                </a>
            </div>
        </div>

        <!-- RIGHT SHOWCASE IMAGE -->
        <div class="flex-1 flex justify-center">

            <div
                class="relative w-[520px] h-[360px] md:w-[600px] md:h-[400px] 
                rounded-3xl overflow-hidden shadow-2xl shadow-black/40">

                <img src="https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=1200&q=80"
                    class="w-full h-full object-cover">

                <!-- Frame overlay -->
                <div class="absolute inset-0 bg-black/10"></div>
            </div>

        </div>
    </div>
</section>
