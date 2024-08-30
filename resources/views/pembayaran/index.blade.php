<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-[60px] font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Pembayaran') }}
        </h2>
    </x-slot>
    <div class="py-2">
        @include('components.succes-error-notification')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="#">
                        @include('pembayaran.partial.form-pembayaran')
                        @include('pembayaran.partial.pilih-metode-pembayaran')
                        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 ml-2">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
</x-app-layout>
