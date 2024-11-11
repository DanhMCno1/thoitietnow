<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('logo-thoitietnow.ico') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@2.3.2/build/global/luxon.min.js"></script>

</head>
<body class="bg-gray-100">
<!-- Header -->
<header class="bg-blue-500 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <h1 class="text-xl font-bold">
                <a href="/">
                    <img src="{{ asset('logo-thoitietnow.ico') }}">
                </a>
            </h1>
            <form id="search-form" class="mb-4">
                <div class="flex items-center gap-4 justify-center">
                    <input
                        type="text"
                        id="city-input"
                        name="search"
                        class="border rounded-lg px-4 py-2 text-black"
                        placeholder="Enter the city name"
                    />
                    <button
                        type="submit"
                        id="search-button"
                        class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24" fill="white">
                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        <div class="space-x-4 flex">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5" fill="white">
                <path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
            <span class="text-sm" id="local-time"></span>
        </div>
    </div>

    <div class="flex justify-around items-center p-6 bg-white shadow-md">
        <!-- Menu Items -->
        <div class="flex space-x-12 text-gray-600">
            <li class="hs-dropdown [--trigger:hover] relative inline-flex space-x-1">
                <a href="#" id="hs-dropdown-hover-event" class="hs-dropdown-toggle text-black flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
                        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM288 176c0-44.2-35.8-80-80-80s-80 35.8-80 80c0 48.8 46.5 111.6 68.6 138.6c6 7.3 16.8 7.3 22.7 0c22.1-27 68.6-89.8 68.6-138.6zm-112 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>
                    <span class="text-md">City / State</span>
                    <svg class="hs-dropdown-open:rotate-180 size-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </a>
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full z-50">
                    <div class="p-4 grid grid-cols-5 gap-4 text-sm text-gray-700 whitespace-pre-line" id="province-list">
                        @foreach($states as $state)
                            <a href="" class="block hover:bg-gray-100 p-1 province-item" data-province="{{ $state->name }}">{{ $state->name }}</a>
                        @endforeach
                    </div>
                </div>
            </li>

            <li class="hs-dropdown [--trigger:hover] relative inline-flex space-x-1">
                <a href="" id="hs-dropdown-hover-event-2" class="hs-dropdown-toggle text-black hover:text-gray-600 flex items-center ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="w-6 h-6">
                        <path d="M294.2 1.2c5.1 2.1 8.7 6.7 9.6 12.1l14.1 84.7 84.7 14.1c5.4 .9 10 4.5 12.1 9.6s1.5 10.9-1.6 15.4l-38.5 55c-2.2-.1-4.4-.2-6.7-.2c-23.3 0-45.1 6.2-64 17.1l0-1.1c0-53-43-96-96-96s-96 43-96 96s43 96 96 96c8.1 0 15.9-1 23.4-2.9c-36.6 18.1-63.3 53.1-69.8 94.9l-24.4 17c-4.5 3.2-10.3 3.8-15.4 1.6s-8.7-6.7-9.6-12.1L98.1 317.9 13.4 303.8c-5.4-.9-10-4.5-12.1-9.6s-1.5-10.9 1.6-15.4L52.5 208 2.9 137.2c-3.2-4.5-3.8-10.3-1.6-15.4s6.7-8.7 12.1-9.6L98.1 98.1l14.1-84.7c.9-5.4 4.5-10 9.6-12.1s10.9-1.5 15.4 1.6L208 52.5 278.8 2.9c4.5-3.2 10.3-3.8 15.4-1.6zM144 208a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM639.9 431.9c0 44.2-35.8 80-80 80l-271.9 0c-53 0-96-43-96-96c0-47.6 34.6-87 80-94.6l0-1.3c0-53 43-96 96-96c34.9 0 65.4 18.6 82.2 46.4c13-9.1 28.8-14.4 45.8-14.4c44.2 0 80 35.8 80 80c0 5.9-.6 11.7-1.9 17.2c37.4 6.7 65.8 39.4 65.8 78.7z"/></svg>
                    <span class="text-md">Weather news</span>
                    <svg class="hs-dropdown-open:rotate-180 size-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </a>
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full z-50" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-hover-event-2">
                    <div class="p-1 space-y-0.5">
                        <a href="{{ route('daily.weather') }}" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                            Daily Weather
                        </a>
                        <a href="" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                            Nature
                        </a>
                        <a href="" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" >
                            General News
                        </a>
                        <a href="" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                            Discovery
                        </a>
                    </div>
                </div>
            </li>
            <li class="list-none">
                <a href="{{ route('daily.weather') }}" class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-6 h-6">
                        <path d="M288 0c17.7 0 32 14.3 32 32l0 17.7C451.8 63.4 557.7 161 573.9 285.9c2 15.6-17.3 24.4-27.8 12.7C532.1 283 504.8 272 480 272c-38.7 0-71 27.5-78.4 64.1c-1.7 8.7-8.7 15.9-17.6 15.9s-15.8-7.2-17.6-15.9C359 299.5 326.7 272 288 272s-71 27.5-78.4 64.1c-1.7 8.7-8.7 15.9-17.6 15.9s-15.8-7.2-17.6-15.9C167 299.5 134.7 272 96 272c-24.8 0-52.1 11-66.1 26.7C19.4 310.4 .1 301.5 2.1 285.9C18.3 161 124.2 63.4 256 49.7L256 32c0-17.7 14.3-32 32-32zm0 304c12.3 0 23.5 4.6 32 12.2l0 114.3c0 45-36.5 81.4-81.4 81.4c-30.8 0-59-17.4-72.8-45l-2.3-4.7c-7.9-15.8-1.5-35 14.3-42.9s35-1.5 42.9 14.3l2.3 4.7c3 5.9 9 9.6 15.6 9.6c9.6 0 17.4-7.8 17.4-17.4l0-114.3c8.5-7.6 19.7-12.2 32-12.2z"/></svg>
                    <span class="text-md">Daily Weather</span>
                </a>
            </li>
            <li class="list-none">
                <a href="" class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="w-6 h-6">
                        <path d="M88 216c81.7 10.2 273.7 102.3 304 232H0c99.5-8.1 184.5-137 88-232zm32-152c32.3 35.6 47.7 83.9 46.4 133.6C249.3 231.3 373.7 321.3 400 448h96C455.3 231.9 222.8 79.5 120 64z"/></svg>
                    <span class="text-md">Widget</span>
                </a>
            </li>
        </div>

        <!-- Location Info -->
        <li class="flex items-center space-x-2 text-gray-600 list-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-5 h-5">
                <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
            </svg>
            <span class="text-sm">Your City: <span class="text-blue-800" id="user-location"></span></span>
        </li>
    </div>
</header>
{{ $slot }}
<!-- Footer -->
<footer class="bg-gray-200 text-center py-4 mt-8">
    <p class="text-sm">&copy; 2024 Weather. All rights reserved.</p>
</footer>
</body>
@if (isset($script))
    {{ $script }}
@endif
<script>
    // Hàm cập nhật thời gian theo thời gian thực
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const year = now.getFullYear();
        document.getElementById('local-time').textContent = `Local time: ${hours}:${minutes}:${seconds} ${day}/${month}/${year}`;
    }

    // Cập nhật thời gian mỗi phút
    setInterval(updateTime, 1000);
    updateTime();
    // Lấy vị trí người dùng
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            // Gọi API của bên thứ ba để lấy tên thành phố từ tọa độ (sử dụng API như OpenWeather hoặc một dịch vụ khác)
            fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=vi`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('user-location').textContent = ` ${data.city || 'Undefined'}`;
                })
                .catch(error => {
                    console.error('Error fetching location:', error);
                });
        });
    } else {
        document.getElementById('user-location').textContent = "--";
    }

</script>
</html>
