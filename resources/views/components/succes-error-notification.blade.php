@if ($message = Session::get('success'))
    <div id="successPopup" class="bg-green-500 text-white px-4 py-2 rounded-md fixed top-24 left-1/2 transform -translate-x-1/2 -translate-y-1/2 transition duration-[5000ms]">
        <span class="mr-2">{{ $message }}</span>
        <button id="closePopup" class="ml-4 bg-white text-gray-800 px-2 rounded">X</button>
    </div>
@endif
@if ($message = Session::get('error'))
    <div id="successPopup" class="bg-red-500 text-white px-4 py-2 rounded-md fixed top-24 left-1/2 transform -translate-x-1/2 -translate-y-1/2 transition duration-[5000ms]">
        <span class="mr-2">{{ $message }}</span>
        <button id="closePopup" class="ml-4 bg-white text-gray-800 px-2 rounded">X</button>
    </div>
@endif
