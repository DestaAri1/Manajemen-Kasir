@if (count($errors) > 0)
    <div id="successPopup" class="bg-red-500 flex z-10 items-center text-white px-4 py-2 rounded-md fixed top-50 left-1/2 transform -translate-x-1/2 -translate-y-1/2 transition duration-[5000ms]">
        <ul class="pl-2">
            @foreach ($errors->all() as $error)
                <li class="list-decimal">{{ $error }}</li>
            @endforeach
        </ul>
        <button id="closePopup" class="ml-4 w-6 h-6 bg-white text-gray-800 px-1 rounded">X</button>
    </div>
@endif
