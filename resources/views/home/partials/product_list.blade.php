<section>
    <div class="mx-auto max-w-7xl mt-2">
        <h2 class="font-manrope font-bold text-4xl text-black mb-2">
            List Produk
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-1 gap-4">
            @foreach ($produk as $p)
            <div class="mx-auto mt-2 sm:mr-0 group cursor-pointer lg:mx-auto bg-white transition-all duration-500">
                <a href="javascript:;">
                    <div class="">
                        <img src="https://pagedone.io/asset/uploads/1700726158.png" alt="face cream image" class="w-full aspect-square rounded-2xl">
                    </div>
                    <div>
                        <h6 class="font-semibold text-justify text-xs leading-2 text-black transition-all duration-500 group-hover:text-indigo-600">
                            {{ Str::limit($p->products, 35, ' ...') }}
                        </h6>
                        <h6 class="font-semibold text-xs leading-4 text-black">Stok : {{ $p->stock }}</h6>
                        <h6 class="font-semibold text-xl leading-8 text-indigo-600">$100</h6>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
