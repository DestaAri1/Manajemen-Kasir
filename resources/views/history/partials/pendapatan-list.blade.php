@if ($income->count() == 0)
<div class="text-center">Belum ada pendapatan</div>
@else
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
                Jumlah
            </th>
            <th scope="col" class="px-6 py-3">
                Harga
            </th>
            <th scope="col" class="px-6 py-3">
                Sub Harga
            </th>
            <th scope="col" class="px-6 py-3">
                Tanggal/Waktu
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($income as $p)
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
                {{ $p->amount }}
            </td>
            <td class="px-6 py-3">
                Rp. {{ formatRupiah($p->price) }}
            </td>
            <td class="px-6 py-3">
                @php
                    $sub_total = $p->amount * $p->price;
                @endphp
                Rp. {{ formatRupiah($sub_total) }}
            </td>
            <td class="px-6 py-3">
                {{ $p->updated_at->format('j F Y ; h:i a') }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
