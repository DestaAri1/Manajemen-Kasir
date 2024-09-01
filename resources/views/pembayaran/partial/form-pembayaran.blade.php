<div class="overflow-y-auto overflow-x-hidden h-[57vh] border border-gray-300 rounded-md px-4">
    <table class="min-w-full max-h-[57vh] table-auto">
        <thead class="text-left">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th colspan="2">Detail</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $total_harga_semua = 0;
            @endphp
            @foreach ($cart as $c)
                <tr class="border-b border-gray-200">
                    <td class="py-2 pr-4">{{ $no++ }}</td>
                    <td class="py-2 pr-4">
                        <img src="{{ !empty($c->promo) ? asset('image_not_found.jpg') : (!empty($c->product) && $c->product->image != null ? $c->product->image : asset('image_not_found.jpg')) }}"
                             alt="{{ !empty($c->product) ? $c->product->products : $c->promo->name }}"
                             class="w-16 h-16 object-cover rounded">
                        <input type="hidden" name="product[]" value="{{ $c->product->id ?? $c->promo->id }}">
                    </td>
                    <td class="py-2 text-gray-700">
                        <p class="font-medium">{{ !empty($c->product) ? $c->product->products : $c->promo->name }}</p>
                    </td>
                    <td class="py-2 text-gray-700">
                        <p class="font-medium">{{ $c->quantity }}</p>
                    </td>
                    <td class="py-2 text-gray-700">
                        @if (!empty($c->promo))
                            @foreach ($c->promo->productPromos as $productPromo)
                                <p class="font-medium">{{ $productPromo->amount * $c->quantity }}</p>
                            @endforeach
                        @else
                            <p class="font-medium">-</p>
                        @endif
                    </td>
                    <td class="py-2 text-gray-700">
                        @if (!empty($c->promo))
                            @foreach ($c->promo->productPromos as $productPromo)
                                <p class="font-medium">{{ $productPromo->product->products }}</p>
                            @endforeach
                        @else
                            <p class="font-medium">-</p>
                        @endif
                    </td>
                    <td class="py-2 text-gray-700">
                        @php
                            $total_harga = 0;
                            if (!empty($c->promo)) {
                                foreach ($c->promo->productPromos as $productPromo) {
                                    $jumlah = $productPromo->amount;
                                    $harga = $productPromo->product->price;
                                    $total_harga += $jumlah * $harga;
                                }
                            } else {
                                $total_harga = $c->product->price;
                            }

                            // Hitung diskon jika promo tersedia
                            $total_diskon = !empty($c->promo)
                                ? ($c->promo->type == 0 ? $c->promo->value : $total_harga * ($c->promo->value / 100))
                                : 0;

                            $harga_final = ($total_harga - $total_diskon) * $c->quantity;
                            $total_harga_semua += $harga_final;
                        @endphp
                        <p class="font-medium">Rp. {{ formatRupiah($harga_final) }}</p>
                    </td>
                    <td class="py-2">
                        <a href="javascript:void(0)" class="text-red-500 hover:text-red-700 delete-cart" data-url="{{ route('delete_cart', $c->id) }}">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<table class="min-w-full">
    <tbody>
        <tr class="text-lg font-semibold">
            <td class="w-[75%] text-right">Total Harga</td>
            <td class="w-[5%] text-center">:</td>
            <td>Rp. {{ formatRupiah($total_harga_semua) }}</td>
        </tr>
        <tr>
            <td class="w-[75%] text-right">Jumlah Bayar</td>
            <td class="w-[5%] text-center">:</td>
            <td><input class="py-0" type="text" id="amount" name="amount" onkeyup="FormatRupiah(this)"></td>
        </tr>
    </tbody>
</table>
<script>
    function FormatRupiah(element) {
        let angka = element.value.replace(/[^,\d]/g, "").toString();
        let splitAngka = angka.split(",");
        let sisa = splitAngka[0].length % 3;
        let rupiah = splitAngka[0].substr(0, sisa);
        let ribuan = splitAngka[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = splitAngka[1] !== undefined ? rupiah + "," + splitAngka[1] : rupiah;
        element.value = rupiah ? "Rp " + rupiah : "";
    }
</script>
