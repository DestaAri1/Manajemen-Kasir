<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-[60px] font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Pembayaran') }}
        </h2>
    </x-slot>
    <div class="py-2">
        @include('components.succes-error-notification')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    //
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
