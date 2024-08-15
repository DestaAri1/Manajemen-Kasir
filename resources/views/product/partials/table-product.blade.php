<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-collapse">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                No.
            </th>
            <th scope="col" class="px-6 py-3">
                Nama Produk
            </th>
            <th scope="col" class="px-6 py-3">
                Stok
            </th>
            <th scope="col" class="px-6 py-3">
                Harga
            </th>
            <th scope="col" class="px-6 py-3">
                Aksi
            </th>
        </tr>
    </thead>
    <tbody >
        @foreach ($produk as $p)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-3">
                {{ $loop->iteration + ($produk->currentPage() - 1) * $produk->perPage() }}
            </th>
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $p->products }}
            </th>
            <td class="px-6 py-3">
                {{ $p->stock }}
            </td>
            <td class="px-6 py-3">
                Rp. {{ formatRupiah($p->price) }}
            </td>
            <td class="px-6 py-3">
                <div class="flex">
                    <a href="{{ route('product.edit', Crypt::encryptString($p->id)) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </a>
                    @include('product.partials.modal-delete-product')
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
