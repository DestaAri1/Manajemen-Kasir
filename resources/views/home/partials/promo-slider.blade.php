<h2 class="font-manrope font-bold text-4xl text-black mb-2">Promo</h2>
@if ($promo->count() > 0)
<div class="swiper-container">
    <div class="swiper-wrapper">
        @foreach ($promo as $p)
        <div class="swiper-slide bg-[#f1f1f1] rounded-lg p-4 flex flex-col justify-between">
            <div class="flex justify-between items-center">
                <p class="font-semibold text-lg">{{ $p->name }}</p>
                <p class="bg-red-500 rounded-lg text-white px-3 py-1 text-sm">
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
                        $total_diskon = $p->type == 0 ? $p->value : $total_harga * ($p->value / 100);

                        // Hitung harga setelah diskon
                        $harga_setelah_diskon = $total_harga - $total_diskon;
                    @endphp
                    {{ $p->type == 0 ? ('- Rp. ' . $p->value) : $p->value.('%') }}
                </p>
            </div>
            <div class="columns-3 gap-4">
                @foreach($p->productPromos as $productPromo)
                    <small class="block mb-2">{{ $productPromo->product->products }} {{ $productPromo->amount }}</small>
                @endforeach
            </div>
            <div class="flex justify-between">
                <div class="mt-4">
                    <form action="{{ route('add_cart') }}" method="POST" class="flex justify-center items-center">
                        @csrf
                        <!-- Minus Button -->
                        <button type="button" class="bg-red-500 text-white px-2 py-1 rounded-l hover:bg-red-600 transition-colors duration-200 minusButton2" data-id="{{ $p->id }}">-</button>

                        <!-- Input -->
                        <input type="hidden" name="promo_id" value="{{ $p->id }}">
                        <input type="number" name="quantity" id="numberInput2{{ $p->id }}" class="number w-14 text-center border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none py-1" value="0" />

                        <!-- Plus Button -->
                        <button type="button" class="bg-green-500 text-white px-2 py-1 rounded-r hover:bg-green-600 transition-colors duration-200 plusButton2" data-id="{{ $p->id }}">+</button>

                        <!-- Cart Button -->
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold ml-3 px-3 py-1 rounded transition-colors duration-200">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>
                </div>
                <div>
                    <small class="line-through mr-2">Rp. {{ formatRupiah($total_harga) }}</small>
                    <p class="text-xl font-bold mt-auto">Rp. {{ formatRupiah($harga_setelah_diskon) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var data = {{ count($promo) }};

        // Mengatur loop hanya jika data > 1
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: data > 1,
            autoplay: {
                delay: 3000,
                pauseOnMouseEnter: true
            }
        });

        // Fungsi untuk memasang event listener ke tombol + dan -
        function attachEventListeners2() {
            const plusButtons = document.querySelectorAll('.plusButton2');
            const minusButtons = document.querySelectorAll('.minusButton2');

            plusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const numberInput = document.getElementById('numberInput2' + id);
                    numberInput.value = parseInt(numberInput.value) + 1;
                });
            });

            minusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const numberInput = document.getElementById('numberInput2' + id);

                    // Cek apakah nilai lebih besar dari 0 sebelum dikurangi
                    if (parseInt(numberInput.value) > 0) {
                        numberInput.value = parseInt(numberInput.value) - 1;
                    }
                });
            });
        }

        // Panggil fungsi untuk memasang event listener
        attachEventListeners2();
    });
</script>
@else
<div class="flex justify-center">Tidak ada Promo</div>
@endif
