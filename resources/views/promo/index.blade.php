<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-[60px] font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Promo') }}
        </h2>
    </x-slot>
    <div class="py-2">
        @include('components.succes-error-notification')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-2">
                        <div>
                            <a href="{{ route('promo.create') }}" class="h-10 px-3 py-2 font-bold text-white bg-blue-500 rounded md:block hover:bg-blue-800">Tambah Promo</a>
                        </div>
                        <div>Search</div>
                    </div>
                    <div>
                        @if ($promo->count() == 0)
                            <p class="text-center">Tidak ada data</p>
                        @else
                            <div class="overflow-auto h-[100%] relative shadow-md sm:rounded-lg">
                            @include('promo.partials.table-promo')
                        @endif
                    </div>
                    {{ $promo->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
