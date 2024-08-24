<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-[60px] font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="py-2">
        @include('components.validation-error-notifications')
        @include('components.succes-error-notification')
        <div class="max-w-7xl flex mx-auto sm:px-6 lg:px-8">
            <!-- Scrollable div -->
            <div id="my-scrollable-div" class="bg-white md:overflow-y-auto md:overflow-x-hidden shadow-sm sm:rounded-lg w-full lg:w-[74.5%] lg:max-h-[75vh] opacity-0">
                <div class="p-6 text-gray-900">
                    @include('home.partials.promo-slider')
                    @include('home.partials.product_list')
                </div>
            </div>
            <!-- Sidebar -->
            <div class="bg-white shadow-sm sm:rounded-lg ml-2 w-[24.5%] max-h-[75vh] hidden lg:block">
                <div class="p-6 text-gray-900">
                    @include('home.partials.cart-list')
                </div>
            </div>
        </div>
    </div>

    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            const scrollableDiv = document.getElementById('my-scrollable-div');

            // Atur opacity ke 0 agar elemen tidak terlihat
            scrollableDiv.style.opacity = '0';

            const savedPosition = sessionStorage.getItem('scrollPosition');

            // Tunggu sebentar hingga elemen selesai dimuat
            setTimeout(() => {
                // Jika ada posisi scroll yang tersimpan, terapkan
                if (savedPosition) {
                    scrollableDiv.scrollTop = parseInt(savedPosition, 10);
                }

                // Setelah posisi scroll diterapkan, kembalikan opacity ke 1
                scrollableDiv.style.opacity = '1';
            }, 0); // Set to 0ms to apply immediately after DOM is ready

            // Simpan posisi scroll saat pengguna menggulir
            scrollableDiv.addEventListener('scroll', () => {
                sessionStorage.setItem('scrollPosition', scrollableDiv.scrollTop);
            });
        });
    </script>
</x-app-layout>
