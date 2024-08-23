<section>
    <div class="mx-auto max-w-7xl mt-6">
        <div class="flex justify-between items-center mb-8">
            <h2 class="font-manrope font-bold text-4xl text-black">
                List Produk
            </h2>
            <div class="flex items-center space-x-2">
                <div class="relative">
                    <input type="text" placeholder="Cari ..." class="py-2 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 w-full md:w-64" />
                    <button class="absolute inset-y-0 right-0 flex items-center px-3">
                        <i class="fa fa-search text-gray-500 hover:text-gray-700 transition-colors duration-200"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
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
                        <!-- Minus Button -->
                        <button type="button" class="bg-red-500 text-white px-2 py-1 rounded-l hover:bg-red-600 transition-colors duration-200 minusButton" data-id="{{ $p->id }}">-</button>

                        <!-- Input -->
                        <input type="hidden" name="product_id" value="{{ $p->id }}">
                        <input type="number" name="quantity" id="numberInput{{ $p->id }}" class="number w-14 text-center border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none py-1" value="0" />

                        <!-- Plus Button -->
                        <button type="button" class="bg-green-500 text-white px-2 py-1 rounded-r hover:bg-green-600 transition-colors duration-200 plusButton" data-id="{{ $p->id }}">+</button>

                        <!-- Cart Button -->
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold ml-3 px-3 py-1 rounded transition-colors duration-200">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
