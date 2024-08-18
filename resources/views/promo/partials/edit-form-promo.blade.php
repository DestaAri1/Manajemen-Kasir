<form id="dynamicForm" action="{{ route('promo.updated', Crypt::encryptString($promo->id)) }}" method="POST" class="bg-white p-6">
    @csrf
    @method('PUT') <!-- Menggunakan PUT untuk update data -->

    <div class="mb-5">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Promo</label>
        <input type="text" name="name" value="{{ old('name', $promo->name) }}" class="block w-full text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div id="formWrapper">
        @foreach($promo->productPromos as $key => $productPromo)
        <div class="flex flex-wrap mb-4 form-group">
            <div class="w-full md:w-3/4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                <select name="promo[]" class="block w-full text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Pilih Produk</option>
                    @foreach($produk as $p)
                    <option value="{{ $p->id }}" {{ $productPromo->product_id == $p->id ? 'selected' : '' }}>
                        {{ $p->products }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-[24.25%] ml-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                <input type="text" name="add[]" value="{{ old('add[]', $productPromo->amount) }}" class="block w-full text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <input type="hidden" name="id_promo[]" id="id_promo[]" value="{{ $productPromo->id }}">
            </div>
        </div>
        @endforeach
    </div>

    <div class="flex flex-wrap mb-4">
        <div class="w-full md:w-1/4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
            <select name="category" class="block w-full text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Pilih Kategori</option>
                <option value="0" {{ old('category', $promo->type) == '0' ? 'selected' : '' }}>Pengurangan Harga</option>
                <option value="1" {{ old('category', $promo->type) == '1' ? 'selected' : '' }}>Diskon</option>
            </select>
        </div>
        <div class="w-full md:w-[74.25%] ml-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Potongan</label>
            <input type="text" name="value" value="{{ old('value', $promo->value) }}" class="block w-full text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
    </div>

    <a href="{{ url()->previous() }}" class="bg-yellow-500 text-white px-4 py-[10.2px] rounded-md hover:bg-yellow-600">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
    </a>
    <button type="button" id="addForm" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 ml-2">Tambah Produk</button>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 ml-2">Update</button>
    <a href="{{ route('promo.productDelete', Crypt::encryptString($promo->id)) }}" class="bg-red-500 text-white px-4 py-[10.2px] rounded-md hover:bg-red-600 ml-2">Halaman Hapus Produk Terkait</a>
</form>
<div id="message" class="mt-4"></div>
</div>

<script>
    let formCount = {{ count($promo->productPromos) }};
    const maxForms = 5;

    document.getElementById('addForm').addEventListener('click', function () {
        if (formCount < maxForms) {
            formCount++;
            const formWrapper = document.getElementById('formWrapper');
            const newForm = document.createElement('div');
            newForm.className = 'form-group mb-4';
            newForm.id = 'formGroup-' + formCount;

            newForm.innerHTML = `
            <div class="flex flex-wrap mb-4">
                <div class="w-full md:w-3/4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                    <select name="promo[]" class="block w-full text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option>Pilih produk ...</option>
                        @foreach($produk as $p)
                        <option value="{{ $p->id }}">{{ $p->products }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-[14.25%] ml-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                    <input type="text" name="add[]" class="block w-full text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="w-full md:w-[9.25%] ml-2 mt-5">
                    <button type="button" class="removeForm w-full py-[8.75px] bg-red-500 text-white px-2 mt-2 rounded-lg hover:bg-red-600">Hapus</button>
                </div>
            </div>
            `;
            formWrapper.appendChild(newForm);

            newForm.querySelector('.removeForm').addEventListener('click', function () {
                newForm.remove();
                formCount--;
                document.getElementById('message').innerHTML = '';
            });
        } else {
            document.getElementById('message').innerHTML = `<p class="text-red-500">Maksimal 5 form yang dapat digandakan</p>`;
        }
    });
</script>
