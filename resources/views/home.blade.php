<x-user-layout>
    <x-slot name="title">
        Dự báo thời tiết
    </x-slot>
    <div class="weather-content">
        <h2>Dự báo thời tiết Hà Nội</h2>
        <div class="forecast">
            <div class="current-weather">
                <h3>Hiện tại</h3>
                <p>25°C - Sương Mờ</p>
            </div>
            <div class="future-weather">
                <h3>Nhiệt độ Hà Nội</h3>
                <div class="row">
                    <div class="col">Ngày: 25°C</div>
                    <div class="col">Đêm: 20°C</div>
                    <div class="col">Sáng: 22°C</div>
                    <div class="col">Tối: 23°C</div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
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
                document.getElementById('local-time').textContent = `Giờ địa phương: ${hours}:${minutes}:${seconds} ${day}/${month}/${year}`;
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
                            document.getElementById('user-location').textContent = `Thành phố của bạn: ${data.city || 'Không xác định'}`;
                        })
                        .catch(error => {
                            console.error('Error fetching location:', error);
                        });
                });
            } else {
                document.getElementById('user-location').textContent = "Thành phố của bạn: Không xác định";
            }

        </script>
    </x-slot>
</x-user-layout>
