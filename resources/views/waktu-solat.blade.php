<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Waktu Solat Malaysia - Dapatkan waktu solat terkini untuk seluruh Malaysia">
    <title>Waktu Solat Malaysia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .header-title {
            color: #764ba2 !important;
        }

        .prayer-card {
            transition: all 0.3s ease;
        }

        .prayer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .active-prayer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .loader {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .islamic-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="gradient-bg islamic-pattern text-white py-6 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="header-title text-3xl md:text-4xl font-bold mb-2">
                    <i class="fas fa-mosque mr-2"></i>Waktu Solat Malaysia
                </h1>
                <p class="text-sm md:text-base opacity-90" style="color: #764ba2;">Waktu Solat Terkini Untuk Seluruh Malaysia</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-4">
        <!-- Zone Selection -->
        <div class="bg-white rounded-lg shadow-lg p-4 mb-4 fade-in">
            <div class="grid md:grid-cols-3 gap-3">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1 text-sm">
                        <i class="fas fa-map-marker-alt mr-1 text-purple-600"></i>Pilih Zon
                    </label>
                    <select id="zoneSelect" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <option value="">Memuat zon...</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1 text-sm">
                        <i class="fas fa-calendar-alt mr-1 text-purple-600"></i>Bulan
                    </label>
                    <select id="monthSelect" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Mac</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Jun</option>
                        <option value="7">Julai</option>
                        <option value="8">Ogos</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Disember</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1 text-sm">
                        <i class="fas fa-calendar mr-1 text-purple-600"></i>Tahun
                    </label>
                    <select id="yearSelect" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <!-- Will be populated by JavaScript -->
                    </select>
                </div>
            </div>
            <button id="searchBtn" class="w-full mt-3 gradient-bg text-white py-2 rounded-lg font-semibold text-sm hover:opacity-90 transition duration-300">
                <i class="fas fa-search mr-2"></i>Cari Waktu Solat
            </button>
        </div>

        <!-- Loading Indicator -->
        <div id="loadingIndicator" class="text-center py-6 hidden">
            <div class="loader mx-auto mb-3"></div>
            <p class="text-gray-600 text-sm">Memuat data...</p>
        </div>

        <!-- Prayer Times Display -->
        <div id="prayerTimesContainer" class="hidden fade-in">
            <!-- Today's Prayer Times -->
            <div class="bg-white rounded-lg shadow-lg p-4 mb-4">
                <h2 class="text-lg font-bold text-gray-800 mb-3 text-center">
                    <i class="fas fa-clock mr-2 text-purple-600"></i>Waktu Solat Hari Ini
                </h2>
                <div id="todayPrayerTimes" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-2">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>

            <!-- Monthly Calendar -->
            <div class="bg-white rounded-lg shadow-lg p-4">
                <h2 class="text-lg font-bold text-gray-800 mb-3 text-center">
                    <i class="fas fa-calendar-days mr-2 text-purple-600"></i>Kalendar Bulanan
                </h2>
                <div class="overflow-x-auto" style="max-height: 400px; overflow-y: auto;">
                    <table class="w-full text-xs">
                        <thead class="sticky top-0 bg-white z-10">
                            <tr class="gradient-bg text-white">
                                <th class="px-2 py-2 text-left">Tarikh</th>
                                <th class="px-2 py-2">Hijri</th>
                                <th class="px-2 py-2">Imsak</th>
                                <th class="px-2 py-2">Subuh</th>
                                <th class="px-2 py-2">Syuruk</th>
                                <th class="px-2 py-2">Zohor</th>
                                <th class="px-2 py-2">Asar</th>
                                <th class="px-2 py-2">Maghrib</th>
                                <th class="px-2 py-2">Isyak</th>
                            </tr>
                        </thead>
                        <tbody id="prayerTimesTable">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Error Message -->
        <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Ralat!</strong>
            <span class="block sm:inline" id="errorText"></span>
        </div>
    </main>

    <!-- Footer -->
    <footer class="gradient-bg text-white py-3 mt-6">
        <div class="container mx-auto px-4 text-center">
            <p class="text-xs mb-1">&copy; {{ date('Y') }} Waktu Solat Malaysia. Semua hak cipta terpelihara.</p>
            <p class="text-xs opacity-75">Data daripada API Waktu Solat Malaysia</p>
        </div>
    </footer>

    <script>
        // Global variables
        let zonesData = [];
        let prayerData = [];

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadZones();
            populateYears();
            setCurrentDate();
            
            // Event listeners
            document.getElementById('searchBtn').addEventListener('click', searchPrayerTimes);
            document.getElementById('zoneSelect').addEventListener('change', searchPrayerTimes);
        });

        // Load zones
        async function loadZones() {
            try {
                const response = await fetch('/api/zones');
                zonesData = await response.json();
                
                const zoneSelect = document.getElementById('zoneSelect');
                zoneSelect.innerHTML = '<option value="">Pilih Zon...</option>';
                
                zonesData.forEach(zone => {
                    const option = document.createElement('option');
                    option.value = zone.code;
                    option.textContent = `${zone.code} - ${zone.name}`;
                    zoneSelect.appendChild(option);
                });

                // Set default to KDH01
                zoneSelect.value = 'KDH01';
                searchPrayerTimes();
            } catch (error) {
                showError('Gagal memuat senarai zon');
            }
        }

        // Populate years
        function populateYears() {
            const yearSelect = document.getElementById('yearSelect');
            const currentYear = new Date().getFullYear();
            
            for (let year = currentYear - 1; year <= currentYear + 1; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                if (year === currentYear) option.selected = true;
                yearSelect.appendChild(option);
            }
        }

        // Set current date
        function setCurrentDate() {
            const now = new Date();
            document.getElementById('monthSelect').value = now.getMonth() + 1;
        }

        // Search prayer times
        async function searchPrayerTimes() {
            const zone = document.getElementById('zoneSelect').value;
            const month = document.getElementById('monthSelect').value;
            const year = document.getElementById('yearSelect').value;

            if (!zone) {
                showError('Sila pilih zon');
                return;
            }

            showLoading();
            hideError();

            try {
                const response = await fetch(`/api/prayer-times?zone=${zone}&month=${month}&year=${year}`);
                const data = await response.json();

                if (data.error) {
                    throw new Error(data.error);
                }

                prayerData = data.prayers || [];
                displayPrayerTimes(data);
                hideLoading();
            } catch (error) {
                hideLoading();
                showError('Gagal memuat data waktu solat: ' + error.message);
            }
        }

        // Display prayer times
        function displayPrayerTimes(data) {
            const container = document.getElementById('prayerTimesContainer');
            container.classList.remove('hidden');

            // Display today's prayer times
            displayTodayPrayerTimes(data.prayers);

            // Display monthly calendar
            displayMonthlyCalendar(data.prayers);
        }

        // Display today's prayer times
        function displayTodayPrayerTimes(prayers) {
            const today = new Date().getDate();
            const todayPrayer = prayers.find(p => p.day === today);

            if (!todayPrayer) return;

            const container = document.getElementById('todayPrayerTimes');
            const prayerNames = [
                { key: 'imsak', name: 'Imsak', icon: 'fa-cloud-moon' },
                { key: 'fajr', name: 'Subuh', icon: 'fa-moon' },
                { key: 'syuruk', name: 'Syuruk', icon: 'fa-sun' },
                { key: 'dhuhr', name: 'Zohor', icon: 'fa-sun' },
                { key: 'asr', name: 'Asar', icon: 'fa-cloud-sun' },
                { key: 'maghrib', name: 'Maghrib', icon: 'fa-cloud-moon' },
                { key: 'isha', name: 'Isyak', icon: 'fa-moon' }
            ];

            container.innerHTML = prayerNames.map(prayer => `
                <div class="prayer-card bg-gradient-to-br from-purple-50 to-indigo-50 rounded-lg p-2 text-center border-2 border-purple-100">
                    <div class="text-purple-600 mb-1">
                        <i class="fas ${prayer.icon} text-lg"></i>
                    </div>
                    <h3 class="font-semibold text-gray-700 text-xs mb-1">${prayer.name}</h3>
                    <p class="text-lg font-bold text-purple-600">${formatTime(todayPrayer[prayer.key])}</p>
                </div>
            `).join('');
        }

        // Display monthly calendar
        function displayMonthlyCalendar(prayers) {
            const tbody = document.getElementById('prayerTimesTable');
            const today = new Date().getDate();

            tbody.innerHTML = prayers.map(prayer => {
                const isToday = prayer.day === today;
                const rowClass = isToday ? 'bg-purple-50 font-semibold' : 'hover:bg-gray-50';
                
                return `
                    <tr class="${rowClass}">
                        <td class="px-2 py-1 border-b text-left">
                            ${isToday ? '<i class="fas fa-calendar-day mr-1 text-purple-600"></i>' : ''}
                            ${prayer.day} ${getMonthName(document.getElementById('monthSelect').value)}
                        </td>
                        <td class="px-2 py-1 border-b text-center">${prayer.hijri}</td>
                        <td class="px-2 py-1 border-b text-center">${formatTime(prayer.imsak)}</td>
                        <td class="px-2 py-1 border-b text-center">${formatTime(prayer.fajr)}</td>
                        <td class="px-2 py-1 border-b text-center">${formatTime(prayer.syuruk)}</td>
                        <td class="px-2 py-1 border-b text-center">${formatTime(prayer.dhuhr)}</td>
                        <td class="px-2 py-1 border-b text-center">${formatTime(prayer.asr)}</td>
                        <td class="px-2 py-1 border-b text-center">${formatTime(prayer.maghrib)}</td>
                        <td class="px-2 py-1 border-b text-center">${formatTime(prayer.isha)}</td>
                    </tr>
                `;
            }).join('');
        }

        // Helper functions
        function formatTime(timestamp) {
            if (!timestamp) return '-';
            const date = new Date(timestamp * 1000);
            return date.toLocaleTimeString('ms-MY', { hour: '2-digit', minute: '2-digit' });
        }

        function getMonthName(month) {
            const months = ['Jan', 'Feb', 'Mac', 'Apr', 'Mei', 'Jun', 'Jul', 'Ogos', 'Sep', 'Okt', 'Nov', 'Dis'];
            return months[parseInt(month) - 1];
        }

        function showLoading() {
            document.getElementById('loadingIndicator').classList.remove('hidden');
            document.getElementById('prayerTimesContainer').classList.add('hidden');
        }

        function hideLoading() {
            document.getElementById('loadingIndicator').classList.add('hidden');
        }

        function showError(message) {
            const errorDiv = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            errorText.textContent = message;
            errorDiv.classList.remove('hidden');
        }

        function hideError() {
            document.getElementById('errorMessage').classList.add('hidden');
        }
    </script>
</body>
</html>
