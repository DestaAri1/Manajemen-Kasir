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
            <div class="flex justify-end mt-12">
                <small class="line-through mr-2">Rp. {{ formatRupiah($total_harga) }}</small>
                <p class="text-xl font-bold mt-auto">Rp. {{ formatRupiah($harga_setelah_diskon) }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    var data = {{ count($promo) }}
    var isMobile = window.matchMedia("(max-width: 768px)").matches;
    var slidesPerViewValue = isMobile ? 1 : (data > 1 ? 2 : 1);
    var spaceBetweenValue = isMobile ? 30 : (data > 1 ? 30 : 0)

    // Fungsi untuk mengkloning slide pertama jika jumlah slide ganjil
    function handleOddSlides(swiper) {
        const slides = swiper.slides;
        if (slides.length % 2 !== 0) {
            const firstSlide = slides[0].cloneNode(true);
            swiper.appendSlide(firstSlide);
        }
    }

    var swiper = new Swiper('.swiper-container', {
        slidesPerView: slidesPerViewValue,
        spaceBetween: spaceBetweenValue,
        loop: true,
        autoplay: {
            delay: 3000,
            pauseOnMouseEnter: true
        },
        on: {
            init: function () {
            handleOddSlides(this);
            }
        }
    });
</script>
@else
<div class="flex justify-center">Tidak ada Promo</div>
@endif


