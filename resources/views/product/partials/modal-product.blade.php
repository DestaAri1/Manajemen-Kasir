                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="hidden h-10 px-3 py-2 font-bold text-white bg-blue-500 rounded md:block hover:bg-blue-800" type="button">
                                Tambah Produk
                            </button>
                            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block h-10 px-6 py-2 font-bold text-white bg-blue-500 rounded md:hidden hover:bg-blue-800" type="button">
                                +
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-2xl max-h-full p-4">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Tambah Produk
                                            </h3>
                                            <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form action="{{ route('product.post') }}" method="POST">
                                            @csrf
                                            <div class="p-4 space-y-4 md:p-5">
                                                <div class="flex flex-wrap mb-6 -mx-3">
                                                    <div class="w-full px-3">
                                                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-password">
                                                        Nama Produk
                                                        </label>
                                                        <input name="product" class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap mb-6 -mx-3">
                                                    <div class="w-full px-3">
                                                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-password">
                                                        Jumlah Stock
                                                    </label>
                                                    <input name="stock" class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" type="integer">
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap mb-6 -mx-3">
                                                    <div class="w-full px-3">
                                                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-password">
                                                            Harga
                                                        </label>
                                                        <input name="price" class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" type="integer">
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap mb-6 -mx-3">
                                                    <div class="w-full px-3">
                                                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-password">
                                                            Gambar
                                                        </label>
                                                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex justify-end p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600">
                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                                                <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tutup</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

