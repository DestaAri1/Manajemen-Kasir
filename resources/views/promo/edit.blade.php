<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-[60px] font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Edit Promo') }}
        </h2>
    </x-slot>
    <div class="py-2">
        @include('components.succes-error-notification')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                @include('promo.partials.edit-form-promo')
            </div>
        </div>
    </div>
</x-app-layout>
