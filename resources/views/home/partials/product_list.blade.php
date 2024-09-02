<section>
    <div class="mx-auto max-w-7xl mt-6">
        <div class="flex justify-between items-center mb-8">
            <h2 class="font-manrope font-bold text-4xl text-black">
                List Produk
            </h2>
            <div class="flex items-center space-x-2">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari ..." class="py-2 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 w-full md:w-64" />
                    <button class="absolute inset-y-0 right-0 flex items-center px-3">
                        <i class="fa fa-search text-gray-500 hover:text-gray-700 transition-colors duration-200"></i>
                    </button>
                </div>
            </div>
        </div>
        @if ($produk->count() == 0)
            <div class="flex justify-center">Tidak ada produk</div>
        @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 product-grid">
            @foreach ($produk as $p)
            <div class="bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg overflow-hidden border border-gray-200">
                <a href="javascript:;" class="group">
                    <div class="relative">
                        <img src="{{ $p->image != null ? $p->image : asset('image_not_found.jpg') }}" alt="Produk Image" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent w-full p-4">
                            <h6 class="text-white text-xs leading-4">
                                {{ Str::limit($p->products, 35, ' ...') }}
                            </h6>
                        </div>
                    </div>
                    <div class="p-4">
                        <h6 class="font-semibold text-sm text-gray-600">Stok: {{ $p->stock }}</h6>
                        <h6 class="font-semibold text-lg text-indigo-600 mt-1">Rp. {{ formatRupiah($p->price) }}</h6>
                    </div>
                </a>
                <div class="pb-4">
                    <form action="{{ route('add_cart') }}" method="POST" class="flex justify-center items-center">
                        @csrf
                        <button type="button" class="bg-red-500 text-white px-2 py-1 rounded-l hover:bg-red-600 transition-colors duration-200 minusButton" data-id="{{ $p->id }}">-</button>

                        <input type="hidden" name="product_id" value="{{ $p->id }}">
                        <input type="number" name="quantity" id="numberInput{{ $p->id }}" class="number w-14 text-center border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none py-1" value="0" />

                        <button type="button" class="bg-green-500 text-white px-2 py-1 rounded-r hover:bg-green-600 transition-colors duration-200 plusButton" data-id="{{ $p->id }}">+</button>

                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold ml-3 px-3 py-1 rounded transition-colors duration-200">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Tambahkan Pagination Links di sini -->
        <div class="mt-8">
            {{ $produk->links() }}
        </div>
    </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');

    // Panggil fungsi untuk memasang event listener awal
    attachEventListeners();

    searchInput.addEventListener('keyup', function() {
        const query = this.value.trim(); // Hilangkan spasi kosong di depan/belakang query

        // Jika input kosong, reload halaman untuk menampilkan semua produk
        if (query === '') {
            location.reload();
            return;
        }

        // AJAX request
        fetch(`/home/search?query=${query}`)
        .then(response => response.json())
        .then(data => {
            let productContainer = document.querySelector('.product-grid');
            productContainer.innerHTML = ''; // Kosongkan produk lama

            if (data.length > 0) {
                data.forEach(product => {
                    productContainer.innerHTML += `
                        <div class="bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg overflow-hidden border border-gray-200">
                            <a href="javascript:;" class="group">
                                <div class="relative">
                                    <img src="${product.image ? product.image : '{{ asset('image_not_found.jpg') }}'}" alt="Produk Image" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                                    <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent w-full p-4">
                                        <h6 class="text-white text-xs leading-4">
                                            ${product.products.length > 35 ? product.products.substring(0, 35) + ' ...' : product.products}
                                        </h6>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h6 class="font-semibold text-sm text-gray-600">Stok: ${product.stock}</h6>
                                    <h6 class="font-semibold text-lg text-indigo-600 mt-1">${formatRupiah(product.price)}</h6>
                                </div>
                            </a>
                            <div class="pb-4">
                                <form action="{{ route('add_cart') }}" method="POST" class="flex justify-center items-center">
                                    @csrf
                                    <button type="button" class="bg-red-500 text-white px-2 py-1 rounded-l hover:bg-red-600 transition-colors duration-200 minusButton" data-id="${product.id}">-</button>
                                    <input type="hidden" name="product_id" value="${product.id}">
                                    <input type="number" name="quantity" id="numberInput${product.id}" class="number w-14 text-center border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none py-1" value="0" />
                                    <button type="button" class="bg-green-500 text-white px-2 py-1 rounded-r hover:bg-green-600 transition-colors duration-200 plusButton" data-id="${product.id}">+</button>
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold ml-3 px-3 py-1 rounded transition-colors duration-200">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </button>
                                </form>
                            </div>
                        </div>`;
                });

                // Pasang ulang event listener setelah produk diperbarui
                attachEventListeners();
            } else {
                productContainer.innerHTML = `<p class="text-center text-gray-500 col-span-4">Tidak ada produk ditemukan</p>`;
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Event listener untuk link pagination
    document.addEventListener('click', function(event) {
        if (event.target.tagName === 'A' && event.target.closest('.pagination')) {
            event.preventDefault();
            let url = event.target.getAttribute('href');

            fetch(url)
            .then(response => response.json())
            .then(data => {
                let productContainer = document.querySelector('.product-grid');
                productContainer.innerHTML = ''; // Kosongkan produk lama

                data.data.forEach(product => {
                    productContainer.innerHTML += `
                        <div class="bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg overflow-hidden border border-gray-200">
                            <a href="javascript:;" class="group">
                                <div class="relative">
                                    <img src="${product.image ? product.image : '{{ asset('image_not_found.jpg') }}'}" alt="Produk Image" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                                    <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent w-full p-4">
                                        <h6 class="text-white text-xs leading-4">
                                            ${product.products.length > 35 ? product.products.substring(0, 35) + ' ...' : product.products}
                                        </h6>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h6 class="font-semibold text-sm text-gray-600">Stok: ${product.stock}</h6>
                                    <h6 class="font-semibold text-lg text-indigo-600 mt-1">${formatRupiah(product.price)}</h6>
                                </div>
                            </a>
                            <div class="pb-4">
                                <form action="{{ route('add_cart') }}" method="POST" class="flex justify-center items-center">
                                    @csrf
                                    <button type="button" class="bg-red-500 text-white px-2 py-1 rounded-l hover:bg-red-600 transition-colors duration-200 minusButton" data-id="${product.id}">-</button>
                                    <input type="hidden" name="product_id" value="${product.id}">
                                    <input type="number" name="quantity" id="numberInput${product.id}" class="number w-14 text-center border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none py-1" value="0" />
                                    <button type="button" class="bg-green-500 text-white px-2 py-1 rounded-r hover:bg-green-600 transition-colors duration-200 plusButton" data-id="${product.id}">+</button>
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold ml-3 px-3 py-1 rounded transition-colors duration-200">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </button>
                                </form>
                            </div>
                        </div>`;
                });

                // Pasang ulang event listener setelah produk diperbarui
                attachEventListeners();
            })
            .catch(error => console.error('Error:', error));
        }
    });
});

    // Fungsi untuk memasang event listener ke tombol + dan -
    function attachEventListeners() {
        const plusButtons = document.querySelectorAll('.plusButton');
        const minusButtons = document.querySelectorAll('.minusButton');

        plusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const numberInput = document.getElementById('numberInput' + id);
                numberInput.value = parseInt(numberInput.value) + 1;
            });
        });

        minusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const numberInput = document.getElementById('numberInput' + id);

                // Cek apakah nilai lebih besar dari 0 sebelum dikurangi
                if (parseInt(numberInput.value) > 0) {
                    numberInput.value = parseInt(numberInput.value) - 1;
                }
            });
        });
    }

    // Fungsi formatRupiah untuk menampilkan harga dengan format Rupiah
    function formatRupiah(angka) {
        const numberString = angka.toString().replace(/[^,\d]/g, '');
        const split = numberString.split(',');
        const sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            const separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp. ' + rupiah;
    }
</script>
