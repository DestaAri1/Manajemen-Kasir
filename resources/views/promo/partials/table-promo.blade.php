<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-collapse">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">No.</th>
            <th scope="col" class="px-6 py-3">Nama Promo</th>
            <th scope="col" class="px-6 py-3">Produk Promo</th>
            <th scope="col" class="px-6 py-3">Tipe</th>
            <th scope="col" class="px-6 py-3">Potongan</th>
            <th scope="col" class="px-6 py-3">Harga</th>
            <th scope="col" class="px-6 py-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($promo as $p)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-3">
                {{ $loop->iteration + ($promo->currentPage() - 1) * $promo->perPage() }}
            </th>
            <td class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $p->name }}
            </td>
            <td class="px-6 py-3">
                @if($p->productPromos->isNotEmpty())
                    <ul>
                        @foreach($p->productPromos as $productPromo)
                            <li>{{ $productPromo->amount }} {{ $productPromo->product->products }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No products associated</p>
                @endif
            </td>
            <td class="px-6 py-3">
                @if ($p->type == 0)
                    Potongan Harga
                @else
                    Diskon
                @endif
            </td>
            <td class="px-6 py-3">
                @if ($p->type == 0)
                    Rp. {{ formatRupiah($p->value) }}
                @else
                    {{ $p->value }}%
                @endif
            </td>
            <td>
                @php
                $total_harga = 0;
                $total_diskon = 0;
                @endphp

                @foreach($p->productPromos as $productPromo)
                    @php
                        $jumlah = $productPromo->amount;
                        $harga = $productPromo->product->price;
                        $total_harga += $jumlah * $harga;
                    @endphp
                @endforeach

                @php
                    // Terapkan diskon berdasarkan tipe promo
                    if ($p->type == 0) {
                        $total_diskon = $p->value;
                    } elseif ($p->type == 1) {
                        $total_diskon = $total_harga * ($p->value / 100);
                    }

                    // Hitung harga setelah diskon
                    $harga_setelah_diskon = $total_harga - $total_diskon;
                @endphp

                <strong>Harga Asli:</strong> Rp. {{ formatRupiah($total_harga) }}<br>
                <strong>Harga Setelah Diskon:</strong> Rp. {{ formatRupiah($harga_setelah_diskon) }}
            </td>
            <td>
                <div class="flex">
                    <a href="{{ route('promo.edit', Crypt::encryptString($p->id)) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </a>
                    @include('promo.partials.delete-promo')
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
