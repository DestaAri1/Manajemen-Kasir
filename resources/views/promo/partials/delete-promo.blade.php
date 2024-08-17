<button data-modal-target="delete-modal{{ $p->id }}" data-modal-toggle="delete-modal{{ $p->id }}" type="button" class="bg-red-500 w-7 hover:bg-red-700 text-white font-bold py-2 px-2 rounded ml-2">
    <i class="fa fa-trash"></i>
</button>
<div id="delete-modal{{ $p->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-sm max-h-full p-4">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Hapus Akun
                </h3>
                <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal{{ $p->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('promo.delete', Crypt::encryptString($p->id)) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="p-4 space-y-4 md:p-5">
                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3">
                            Apakah Anda Yakin Untuk Menghapus Promo <b>{{ $p->name }}</b>?
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-end p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600">
                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Hapus</button>
                    <button data-modal-hide="delete-modal{{ $p->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
