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
                Nama Promo
            </th>
            <th scope="col" class="px-6 py-3">
                Tipe
            </th>
            <th scope="col" class="px-6 py-3">
                Harga
            </th>
            <th scope="col" class="px-6 py-3">
                Tanggal/Waktu
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($history as $p)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-3">
                {{ $loop->iteration + ($history->currentPage() - 1) * $history->perPage() }}
            </th>
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $p->product }}
            </th>
            <td class="px-6 py-3">
                {{ $p->promo ?? ('-') }}
            </td>
            <td class="px-6 py-3">
                <div class="{{ $p->type == 0 ? ('bg-blue-500 hover:bg-blue-700') : ($p->type == 1 ? ('bg-yellow-500 hover:bg-yellow-700') : ($p->type == 2 ? ('bg-green-500 hover:bg-green-700') : ('bg-red-500 hover:bg-red-700') )) }} w-[4rem] text-center text-white font-bold py-2 px-2 rounded">
                    {{ $p->type == 0 ? ('Add') : ($p->type == 1 ? ('In') : ($p->type == 2 ? ('Adjust') : ('Delete') )) }}
                </div>
            </td>
            <td class="px-6 py-3">
                Rp. {{ formatRupiah($p->price) }}
            </td>
            <td class="px-6 py-3">
                //
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
