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
                    <form action="{{ route('pembayaran.store', Auth::id()) }}" method="POST">
                        @csrf
                        @include('pembayaran.partial.form-pembayaran')
                        @include('pembayaran.partial.pilih-metode-pembayaran')
                        <button type="submit" class="w-full mt-2 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
