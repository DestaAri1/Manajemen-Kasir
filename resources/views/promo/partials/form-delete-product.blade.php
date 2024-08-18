<div class="bg-white p-6">
    <div>
        @foreach($promo->productPromos as $key => $productPromo)
        <div class="flex flex-wrap mb-4 form-group">
            <div class="w-full md:w-[70%]">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                <select disabled name="promo[]" class="block w-full text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Pilih Produk</option>
                    @foreach($produk as $p)
                    <option value="{{ $p->id }}" {{ $productPromo->product_id == $p->id ? 'selected' : '' }}>
                        {{ $p->products }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-[19.25%] md:ml-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                <input disabled type="text" name="add[]" value="{{ old('add[]', $productPromo->amount) }}" class="block w-full text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="w-full md:w-[4.25%] md:ml-2 mt-2 md:mt-5 items-center">
                <form action="{{ route('promo.productDelete.destroy', Crypt::encryptString($productPromo->id)) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="removeForm w-full py-[8.75px] bg-red-500 text-white lg:px-2 mt-2 rounded-lg hover:bg-red-600">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <a href="{{ route('promo.updated', Crypt::encryptString($promo->id)) }}" class="bg-yellow-500 text-white px-4 py-[10.2px] rounded-md hover:bg-yellow-600">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
    </a>
</div>

