<div class="p-1 hola">
    <p class="font-semibold text-lg text-gray-800">{{ strtoupper('Kerangjang Belanja') }}</p>
    @if ($cart->count() == 0)
        <p class="text-center text-gray-500">Tidak ada data</p>
    @else
        <form class="uhuyy" action="{{ route('update_cart') }}" method="POST">
            @csrf
            <div class="overflow-y-auto overflow-x-hidden h-[57vh] border border-gray-300 rounded-md px-4">
                <table class="min-w-full max-h-[57vh] table-auto">
                    <tbody>
                        @foreach ($cart as $c)
                            <tr class="border-b border-gray-200">
                                <!-- Image column -->
                                <td class="py-2 pr-4">
                                    <img src="{{ $c->product->image != null ? $c->product->image : asset('image_not_found.jpg') }}" alt="{{ $c->product->products }}" class="w-16 h-16 object-cover rounded">
                                    <input type="hidden" name="product[]" id="product[]" value="{{ $c->product->id }}">
                                </td>
                                <!-- Product and Quantity column -->
                                <td class="py-2 text-gray-700">
                                    <p class="font-medium">{{ $c->product->products }}</p>
                                    <div class="mt-1">
                                        <input type="number" id="quantity[]" name="quantity_[]" value="{{ $c->quantity }}" class="w-16 px-2 py-1 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </td>
                                <!-- Delete button column -->
                                <td class="py-2 text-right">
                                    <a href="javascript:void(0)" class="text-red-500 hover:text-red-700 delete-cart" data-url="{{ route('delete_cart', $c->id) }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Submit button -->
            <div class="mt-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-md py-2">Submit</button>
            </div>
        </form>
    @endif
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.delete-cart', function() {

            var userURL = $(this).data('url');
            var trObj = $(this);

            if (confirm("Are you sure you want to delete this data?") == true) {
                $.ajax({
                    url: userURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        trObj.parents("tr").remove();
                        showSuccessPopup(data.success);
                        // Cek jika keranjang sudah kosong
                        if ($('tbody tr').length == 0) {
                            $('form.uhuyy').remove();  // Menghapus form
                            $('.overflow-y-auto').remove();  // Menghapus div yang membungkus tabel
                            $('.p-4.hola').append('<p class="text-center text-gray-500">Tidak ada data</p>');  // Menambahkan pesan "Tidak ada data"
                        }
                    }
                });
            }

        });

    });
</script>
<script>
    function showSuccessPopup(message) {
        // Set pesan ke dalam popup
        document.getElementById('popupMessage').innerText = message;

        // Tampilkan popup
        const popup = document.getElementById('successPopup2');
        popup.classList.remove('hidden');
        popup.classList.add('block');

        // Popup otomatis menghilang setelah 5 detik
        setTimeout(function() {
            HideSuccessPopup();
        }, 5000); // 5000ms = 5 detik
    }

    function HideSuccessPopup() {
        const popup = document.getElementById('successPopup2');
        popup.classList.remove('block');
        popup.classList.add('hidden');
    }

    // Tutup popup ketika tombol "X" diklik
    document.getElementById('closePopup2').addEventListener('click', HideSuccessPopup);
</script>
