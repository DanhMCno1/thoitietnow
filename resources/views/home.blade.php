<x-user-layout>
    <x-slot name="title">
        Weather forecast comparison
    </x-slot>
    <!-- Main Content -->
    <main class="container mx-auto py-8 flex">
        <div class="w-1/2 bg-white rounded shadow p-4 text-center">
            <div class="weather-info">
                <h2>Weather Forecast Comparison: <span id="city-name">--</span></h2>

                <!-- WeatherAPI Data -->
                <div class="font-bold text-2xl mt-4">WeatherAPI Data</div>
                <div class="font-bold text-5xl text-blue-500">
                    <img id="weather-icon" src="images/weather-icons/sunning.png" alt="Weather Icon" class="w-20 inline-block">
                    <span id="temp_c">--</span>°F
                </div>
                <div class="text-gray-500 font-semibold">
                    <span id="condition">--</span>
                </div>
                <div class="feels-like">
                    Feel like <span id="feelslike_c">--</span>°F
                </div>

                <div class="flex mt-6 text-gray-600 justify-around">
                    <!-- Weather details -->
                    <div class="weather-detail">
                        <div>Low/High</div>
                        <span id="min_temp">--</span>°/<span id="max_temp">--</span>°
                    </div>
                    <div class="weather-detail">
                        <div>Humidity</div>
                        <span id="humidity">--</span>%
                    </div>
                    <div class="weather-detail">
                        <div>Vision</div>
                        <span id="vis_km">--</span> km
                    </div>
                    <div class="weather-detail">
                        <div>Wind</div>
                        <span id="wind_kph">--</span> km/h
                    </div>
                    <div class="weather-detail">
                        <div>Sunrise/Sunset</div>
                        <span id="sunrise">--</span> / <span id="sunset">--</span>
                    </div>
                </div>

                <!-- OpenWeatherMap Data -->
                <div class="font-bold text-2xl mt-8">OpenWeatherMap Data</div>
                <div class="font-bold text-5xl text-green-500">
                    <img id="openweather-icon" src="images/weather-icons/default.png" alt="Weather Icon" class="w-20 inline-block">
                    <span id="open_temp_c">--</span>°F
                </div>
                <div class="text-gray-500 font-semibold">
                    <span id="open_condition">--</span>
                </div>
                <div class="feels-like">
                    Feel like <span id="open_feelslike_c">--</span>°F
                </div>

                <div class="flex mt-6 text-gray-600 justify-around">
                    <div class="weather-detail">
                        <div>Low/High</div>
                        <span id="open_min_temp">--</span>°/<span id="open_max_temp">--</span>°
                    </div>
                    <div class="weather-detail">
                        <div>Humidity</div>
                        <span id="open_humidity">--</span>%
                    </div>
                    <div class="weather-detail">
                        <div>Visibility</div>
                        <span id="open_visibility">--</span> km
                    </div>
                    <div class="weather-detail">
                        <div>Wind</div>
                        <span id="open_wind_kph">--</span> km/h
                    </div>
                    <div class="weather-detail">
                        <div>Sunrise/Sunset</div>
                        <span id="open_sunrise">--</span> / <span id="open_sunset">--</span>
                    </div>
                </div>
            </div>
        </div>
        <div id="forecast-container" class="w-1/2 flex justify-evenly mt-4">
            <!-- WeatherAPI forecast data -->
        </div>
    </main>

    <!-- Chart Containers -->
    <div class="grid grid-cols-2 mx-auto px-48">
        <div>
            <div class="chart-container h-96">
                <canvas id="rain-chance-chart"></canvas>
            </div>
            <div class="chart-container h-96">
                <canvas id="rainfall-chart"></canvas>
            </div>
            <div class="chart-container h-96">
                <canvas id="weekly-rain-chance-chart"></canvas>
            </div>
        </div>

        <div>
            <div class="chart-container h-96">
                <canvas id="rain-chance-chart-openweathermap"></canvas>
            </div>
            <div class="chart-container h-96">
                <canvas id="rainfall-chart-openweathermap"></canvas>
            </div>
            <div class="chart-container h-96">
                <canvas id="weekly-rain-chance-chart-openweathermap"></canvas>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let charts = {}; // Store all charts

                async function fetchWeather(city = "Hanoi") {
                    const weatherApiKey = '2c5b2e5a1240412db9a102920240411';
                    const weatherApiUrl = `https://api.weatherapi.com/v1/forecast.json?key=${weatherApiKey}&q=${city}&days=7&aqi=no&alerts=no`;

                    try {
                        const response = await fetch(weatherApiUrl);
                        if (!response.ok) {
                            throw new Error('Failed to fetch data from WeatherAPI');
                        }
                        const data = await response.json();

                        function convertCtoF(celsius) {
                            return (celsius * 9/5) + 32;
                        }

                        // Update HTML with WeatherAPI data
                        document.getElementById('city-name').textContent = data.location.name;
                        document.getElementById('temp_c').textContent = convertCtoF(data.current.temp_c).toFixed(1);
                        document.getElementById('feelslike_c').textContent = convertCtoF(data.current.feelslike_c).toFixed(1);
                        document.getElementById('condition').textContent = data.current.condition.text;
                        document.getElementById('humidity').textContent = data.current.humidity;
                        document.getElementById('vis_km').textContent = data.current.vis_km;
                        document.getElementById('wind_kph').textContent = data.current.wind_kph;
                        document.getElementById('sunrise').textContent = data.forecast.forecastday[0].astro.sunrise;
                        document.getElementById('sunset').textContent = data.forecast.forecastday[0].astro.sunset;
                        document.getElementById('min_temp').textContent = convertCtoF(data.forecast.forecastday[0].day.mintemp_c).toFixed(1);
                        document.getElementById('max_temp').textContent = convertCtoF(data.forecast.forecastday[0].day.maxtemp_c).toFixed(1);

                        // Set WeatherAPI icon
                        const condition = data.current.condition.text.toLowerCase();
                        let iconPath = 'images/weather-icons/default.png'; // Hình ảnh mặc định
                        if (condition.includes('sunny') || condition.includes('clear')) {
                            iconPath = 'images/weather-icons/sunning.png';
                        } else if (condition.includes('partly cloudy')) {
                            iconPath = 'images/weather-icons/partly-cloudy.png';
                        } else if (condition.includes('cloudy') || condition.includes('overcast')) {
                            iconPath = 'images/weather-icons/cluster-clouds.png';
                        } else if (condition.includes('fog') || condition.includes('mist')) {
                            iconPath = 'images/weather-icons/fog.png';
                        } else if (condition.includes('rain') || condition.includes('showers')) {
                            iconPath = 'images/weather-icons/rain.png';
                        } else if (condition.includes('thunder') || condition.includes('storm')) {
                            iconPath = 'images/weather-icons/storm.png';
                        } else if (condition.includes('snow') || condition.includes('light snow')) {
                            iconPath = 'images/weather-icons/snow.png';
                        }
                        document.getElementById('weather-icon').src = iconPath;

                        // Call OpenWeatherMap fetch
                        fetchOpenWeather(city);

                        // Display WeatherAPI forecast (3 days)
                        const forecastContainer = document.getElementById('forecast-container');
                        forecastContainer.innerHTML = '';
                        data.forecast.forecastday.slice(0, 3).forEach(day => {
                            const forecastHTML = `
                                <div class="forecast-day bg-white rounded shadow p-4 text-center w-48">
                                    <h3>${new Date(day.date).toLocaleDateString('vi-VN', { weekday: 'short', day: '2-digit', month: '2-digit' })}</h3>
                                    <img src="${day.day.condition.icon}" alt="Weather Icon" class="w-10 h-10 mx-auto">
                                    <p>${day.day.condition.text}</p>
                                    <p class="my-2">${convertCtoF(day.day.mintemp_c).toFixed(1)}°F / ${convertCtoF(day.day.maxtemp_c).toFixed(1)}°F</p>
                                    <p><img src="https://thoitiet.app/assets/images/icon-1/humidity-xl.svg" class="w-5 h-5 mx-auto" alt="Độ ẩm không khí"> ${day.day.avghumidity}%</p>
                                </div>
                            `;
                            forecastContainer.innerHTML += forecastHTML;
                        });

                        // Bar chart for rain chance by hour
                        const rainChanceData = data.forecast.forecastday[0].hour.map(hour => hour.chance_of_rain);
                        const hourlyLabels = data.forecast.forecastday[0].hour.map(hour => new Date(hour.time).getHours() + ':00');
                        createBarChart('rain-chance-chart', hourlyLabels, 'Chance of rain (%)', rainChanceData, 'rgba(54, 162, 235, 0.6)');

                        // Bar chart for hourly rainfall
                        const rainfallData = data.forecast.forecastday[0].hour.map(hour => hour.precip_mm);
                        createBarChart('rainfall-chart', hourlyLabels, 'Rainfall (mm)', rainfallData, 'rgba(75, 192, 192, 0.6)');

                        // Line chart for daily temperature and rain chance
                        const weeklyRainChance = data.forecast.forecastday.map(day => day.day.daily_chance_of_rain);
                        const weeklyTemp = data.forecast.forecastday.map(day => convertCtoF(day.day.avgtemp_c).toFixed(1));
                        const weeklyLabels = data.forecast.forecastday.map(day => new Date(day.date).toLocaleDateString('vi-VN', { weekday: 'short', day: '2-digit', month: '2-digit' }));
                        createLineChart('weekly-rain-chance-chart', weeklyLabels, [
                            {
                                label: 'Temperature (°F)',
                                data: weeklyTemp,
                                borderColor: 'rgba(255, 99, 132, 0.6)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                type: 'line',
                                fill: false,
                                tension: 0.1
                            },
                            {
                                label: 'Chance of rain (%)',
                                data: weeklyRainChance,
                                borderColor: 'rgba(54, 162, 235, 0.6)',
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                type: 'line',
                                fill: false,
                                tension: 0.1
                            }
                        ]);

                    } catch (error) {
                        console.error("Error fetching WeatherAPI data:", error);
                        alert("Failed to fetch data from WeatherAPI. Please try again later.");
                    }
                }

                async function fetchOpenWeather(city = "Hanoi") {
                    const openWeatherApiKey = '8a20dec3a0d89b95d3626c4b77da1834';
                    const openWeatherApiUrl = `https://api.openweathermap.org/data/2.5/forecast?q=${city}&appid=${openWeatherApiKey}&units=metric`;

                    try {
                        const response = await fetch(openWeatherApiUrl);
                        if (!response.ok) {
                            throw new Error('Failed to fetch data from OpenWeatherMap');
                        }
                        const data = await response.json();

                        function convertCtoF(celsius) {
                            return (celsius * 9/5) + 32;
                        }

                        // Get current weather data (first forecast entry)
                        const currentWeather = data.list[0];
                        document.getElementById('open_temp_c').textContent = convertCtoF(currentWeather.main.temp).toFixed(1);
                        document.getElementById('open_feelslike_c').textContent = convertCtoF(currentWeather.main.feels_like).toFixed(1);
                        document.getElementById('open_condition').textContent = currentWeather.weather[0].description;
                        document.getElementById('open_humidity').textContent = currentWeather.main.humidity;
                        document.getElementById('open_wind_kph').textContent = (currentWeather.wind.speed * 3.6).toFixed(1); // Convert m/s to km/h
                        document.getElementById('open_min_temp').textContent = convertCtoF(currentWeather.main.temp_min).toFixed(1);
                        document.getElementById('open_max_temp').textContent = convertCtoF(currentWeather.main.temp_max).toFixed(1);
                        document.getElementById('open_visibility').textContent = (currentWeather.visibility / 1000).toFixed(1); // Convert visibility to km

                        // Calculate and format sunrise/sunset using timezone
                        const timezoneOffsetSeconds = data.city.timezone; // Offset in seconds
                        const timezoneOffsetString = `UTC${timezoneOffsetSeconds >= 0 ? '+' : ''}${timezoneOffsetSeconds / 3600}`;

                        const sunrise = luxon.DateTime.fromSeconds(data.city.sunrise, { zone: timezoneOffsetString });
                        const sunset = luxon.DateTime.fromSeconds(data.city.sunset, { zone: timezoneOffsetString });

                        document.getElementById('open_sunrise').textContent = sunrise.toFormat('hh:mm a');
                        document.getElementById('open_sunset').textContent = sunset.toFormat('hh:mm a');

                        // Set the OpenWeatherMap icon
                        const iconCode = currentWeather.weather[0].icon;
                        document.getElementById('openweather-icon').src = `https://openweathermap.org/img/wn/${iconCode}@2x.png`;

                        // Prepare hourly rain chance and rainfall data for charts
                        const hourlyLabels = data.list.map(entry => {
                            const date = new Date(entry.dt * 1000);
                            return date.getHours() + ':00';
                        });

                        const rainChanceData = data.list.map(entry => entry.pop * 100); // Probability of precipitation in %
                        const rainfallData = data.list.map(entry => (entry.rain ? entry.rain['3h'] || 0 : 0)); // Rain volume in mm

                        // Create bar charts for rain chance and rainfall
                        createBarChart('rain-chance-chart-openweathermap', hourlyLabels, 'Chance of rain (%)', rainChanceData, 'rgba(75, 192, 192, 0.6)');
                        createBarChart('rainfall-chart-openweathermap', hourlyLabels, 'Rainfall (mm)', rainfallData, 'rgba(153, 102, 255, 0.6)');

                        // Prepare data for the line chart (7-day forecast)
                        const dailyTempData = data.list.filter((_, index) => index % 8 === 0).slice(0, 7).map(entry => convertCtoF(entry.main.temp).toFixed(1));
                        const dailyRainChance = data.list.filter((_, index) => index % 8 === 0).slice(0, 7).map(entry => entry.pop * 100);
                        const dailyLabels = data.list.filter((_, index) => index % 8 === 0).slice(0, 7).map(entry => {
                            const date = new Date(entry.dt * 1000);
                            return date.toLocaleDateString('vi-VN', { weekday: 'short', day: '2-digit', month: '2-digit' });
                        });

                        // Create a line chart for temperature and rain chance
                        createLineChart('weekly-rain-chance-chart-openweathermap', dailyLabels, [
                            {
                                label: 'Temperature (°F)',
                                data: dailyTempData,
                                borderColor: 'rgba(255, 99, 132, 0.6)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                type: 'line',
                                fill: false,
                                tension: 0.1
                            },
                            {
                                label: 'Chance of rain (%)',
                                data: dailyRainChance,
                                borderColor: 'rgba(54, 162, 235, 0.6)',
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                type: 'line',
                                fill: false,
                                tension: 0.1
                            }
                        ]);

                    } catch (error) {
                        console.error("Error fetching OpenWeatherMap data:", error);
                        alert("Failed to fetch data from OpenWeatherMap. Please try again later.");
                    }
                }

                // Chức năng tạo biểu đồ cột
                function createBarChart(chartId, labels, label, data, backgroundColor) {
                    // Lọc các phần tử chỉ giữ lại các mốc 3 tiếng một lần
                    const filteredLabels = labels.filter((_, index) => index % 3 === 0);
                    const filteredData = data.filter((_, index) => index % 3 === 0);

                    if (charts[chartId]) {
                        charts[chartId].destroy();
                    }

                    const ctx = document.getElementById(chartId).getContext('2d');
                    charts[chartId] = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: filteredLabels,
                            datasets: [{
                                label: label,
                                data: filteredData,
                                backgroundColor: backgroundColor
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                datalabels: {
                                    anchor: 'end',
                                    align: 'end',
                                    color: '#000',
                                    font: {
                                        weight: 'bold'
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    });
                }

                // Tạo biểu đồ line
                function createLineChart(chartId, labels, datasets) {
                    if (charts[chartId]) {
                        charts[chartId].destroy();
                    }

                    const ctx = document.getElementById(chartId).getContext('2d');
                    charts[chartId] = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                    color: '#000',
                                    font: {
                                        weight: 'bold'
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    });
                }

                document.querySelectorAll('.province-item').forEach(item => {
                    item.addEventListener('click', (event) => {
                        event.preventDefault();
                        const province = event.target.getAttribute('data-province');
                        if (province) {
                            fetchWeather(province);
                            document.getElementById('city-input').value = province;
                        }
                    });
                });

                document.getElementById('search-form').addEventListener('submit', (event) => {
                    event.preventDefault();
                    const city = document.getElementById('city-input').value.trim();
                    if (city) {
                        fetchWeather(city);
                    } else {
                        alert("Please enter a city name.");
                    }
                });

                fetchWeather();
            });
        </script>
    </x-slot>
</x-user-layout>
