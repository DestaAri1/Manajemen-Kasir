<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-[60px] font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl flex mx-auto sm:px-6 lg:px-8">
            <div id="my-scrollable-div" class="bg-white overflow-y-auto overflow-x-hidden shadow-sm sm:rounded-lg w-full md:w-[74.5%] max-h-[75vh]">
                <div class="p-6 text-gray-900">
                    @include('home.partials.promo-slider')
                    @include('home.partials.product_list')
                </div>
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg ml-2 w-[24.5%] max-h-[75vh] hidden md:block">
                <div class="p-6 text-gray-900">
                    @include('home.partials.cart-list')
                </div>
            </div>
        </div>
    </div>

    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            const scrollableDiv = document.getElementById('my-scrollable-div');
            const savedPosition = sessionStorage.getItem('scrollPosition');

            if (savedPosition) {
                scrollableDiv.scrollTop = savedPosition;
            }

            scrollableDiv.addEventListener('scroll', () => {
                sessionStorage.setItem('scrollPosition', scrollableDiv.scrollTop);
            });
        });
    </script>
</x-app-layout>
