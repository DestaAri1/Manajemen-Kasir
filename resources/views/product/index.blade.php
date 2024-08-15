<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-[60px] font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Produk') }}
        </h2>
    </x-slot>
    <div class="py-2">
        @include('components.validation-error-notifications')
        @include('components.succes-error-notification')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-2">
                        <div>
                            @include('product.partials.modal-product')
                        </div>
                        <div>Search</div>
                    </div>
                        @if ($produk->count() == 0)
                            <p class="text-center">Tidak ada data</p>
                        @else
                        <div class="overflow-auto h-[100%] relative shadow-md sm:rounded-lg">
                            @include('product.partials.table-product')
                        @endif

                    </div>
                    {{ $produk->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
