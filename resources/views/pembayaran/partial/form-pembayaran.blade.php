<div class="overflow-y-auto overflow-x-hidden h-[57vh] border border-gray-300 rounded-md px-4">
    <table class="min-w-full max-h-[57vh] table-auto">
        <thead class="text-left">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Detail</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1; // Inisialisasi variabel $no di luar foreach
            @endphp
            @foreach ($cart as $c)
                @if (!empty($c->promo))
                    <tr class="border-b border-gray-200">
                        <!-- Image column -->
                        <td class="py-2 pr-4">{{ $no++ }}</td>
                        <td class="py-2 pr-4">
                            <img src="{{ asset('image_not_found.jpg') }}" alt="{{ $c->promo->name }}" class="w-16 h-16 object-cover rounded">
                            <input type="hidden" name="product[]" id="product[]" value="{{ $c->promo->id }}">
                        </td>
                        <!-- Product and Quantity column -->
                        <td class="py-2 text-gray-700">
                            <p class="font-medium">{{ $c->promo->name }}</p>
                            {{-- <div class="mt-1">
                                <input disabled type="number" id="quantity[]" name="quantity_[]" value="{{ $c->quantity }}" class="w-16 px-2 py-1 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div> --}}
                        </td>
                        <td class="py-2 text-gray-700">
                            <p class="font-medium">{{ $c->quantity }}</p>
                        </td>
                        <!-- Delete button column -->
                        <td class="py-2 text-right">
                            <a href="javascript:void(0)" class="text-red-500 hover:text-red-700 delete-cart" data-url="{{ route('delete_cart', $c->id) }}">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endif
                @if (!empty($c->product))
                    <tr class="border-b border-gray-200">
                        <td class="py-2 pr-4">{{ $no++ }}</td>
                        <!-- Image column -->
                        <td class="py-2 pr-4">
                            <img src="{{ $c->product->image != null ? $c->product->image : asset('image_not_found.jpg') }}" alt="{{ $c->product->products }}" class="w-16 h-16 object-cover rounded">
                            <input type="hidden" name="product[]" id="product[]" value="{{ $c->product->id }}">
                        </td>
                        <!-- Product and Quantity column -->
                        <td class="py-2 text-gray-700">
                            <p class="font-medium">{{ $c->product->products }}</p>
                            <div class="mt-1">
                                <input disabled type="number" id="quantity[]" name="quantity_[]" value="{{ $c->quantity }}" class="w-16 px-2 py-1 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </td>
                        <!-- Delete button column -->
                        <td class="py-2 text-right">
                            <a href="javascript:void(0)" class="text-red-500 hover:text-red-700 delete-cart" data-url="{{ route('delete_cart', $c->id) }}">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
