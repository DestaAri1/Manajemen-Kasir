<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-[60px] font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Tambah Promo') }}
        </h2>
    </x-slot>
    <div class="py-2">
        @include('components.succes-error-notification')
        @include('components.validation-error-notifications')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('promo.partials.form-promo')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
