<x-app-layout>
    <x-slot name="header">
        <h2 class="mt-[60px] font-semibold text-lg text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button id="btn-history-full" onclick="showSection('history-full', this)" class="bg-gray-100 hover:bg-gray-500 text-center font-bold py-2 px-4 rounded-3xl">Semua</button>
                    <button id="btn-section2" onclick="showSection('section2', this)" class="bg-gray-100 hover:bg-gray-500 text-center font-bold py-2 px-4 rounded-3xl ml-2">Pendapatan</button>
                    <button id="btn-section3" onclick="showSection('section3', this)" class="bg-gray-100 hover:bg-gray-500 text-center font-bold py-2 px-4 rounded-3xl ml-2">Barang Masuk</button>
                    <button id="btn-section4" onclick="showSection('section4', this)" class="bg-gray-100 hover:bg-gray-500 text-center font-bold py-2 px-4 rounded-3xl ml-2">Hapus</button>
                    <section id="history-full" class="section mt-5">
                        @include('history.partials.list-history')
                    </section>
                    <section id="section2" class="section mt-5">
                        @include('history.partials.pendapatan-list')
                    </section>
                    <section id="section3" class="section mt-5">
                        @include('history.partials.list-barang-masuk')
                    </section>
                    <section id="section4" class="section mt-5">
                        @include('history.partials.list-penghapusan')
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(sectionId, btn) {
            document.querySelectorAll('.section').forEach(function(section) {
                section.style.display = 'none';
            });

            document.getElementById(sectionId).style.display = 'block';

            document.querySelectorAll('button').forEach(function(button) {
                button.classList.remove('on');
                button.classList.add('bg-gray-100');
            });

            btn.classList.add('on');
        }

        document.addEventListener('DOMContentLoaded', function() {
            showSection('history-full', document.getElementById('btn-history-full'));
        });
    </script>
</x-app-layout>
