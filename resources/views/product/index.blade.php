<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-[60px] font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Produk') }}
        </h2>
    </x-slot>
    <div class="py-2">
        @if (count($errors) > 0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-2">
                        <div>
                            @include('product.partials.modal-product')
                        </div>
                        <div>Search</div>
                    </div>
                    <div class="overflow-auto h-[100%] relative shadow-md sm:rounded-lg">
                        @include('product.partials.table-product')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
