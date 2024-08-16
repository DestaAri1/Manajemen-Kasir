import './bootstrap';

import 'flowbite';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Fungsi untuk menyembunyikan pop-up
function hideSuccessPopup() {
    document.getElementById('successPopup').classList.add('hidden');
}

// Mendaftarkan event listener untuk tombol Close
document.getElementById('closePopup').addEventListener('click', function() {
    hideSuccessPopup();
});

// Fungsi untuk menyembunyikan pop-up setelah beberapa detik
setTimeout(function() {
    hideSuccessPopup();
}, 5000);
