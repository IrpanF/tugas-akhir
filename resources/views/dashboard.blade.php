<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white shadow-sm sm:rounded-lg">
        <h3 class="text-lg font-semibold">Selamat Datang di Dashboard Prediksi Harga Emas!</h3>
        <p class="text-gray-600 mt-2">Berikut adalah grafik tren harga emas berdasarkan data historis.</p>

        <!-- Kotak Info -->
        <div class="grid grid-cols-3 gap-4 my-6 text-center">
            <div class="p-4 bg-blue-100 border border-blue-400 rounded-lg shadow">
                <h4 class="font-semibold text-lg">Return</h4>
                <p id="returnValue" class="text-2xl font-bold text-blue-600">-</p>
            </div>
            <div class="p-4 bg-green-100 border border-green-400 rounded-lg shadow">
                <h4 class="font-semibold text-lg">Standard Deviation</h4>
                <p id="stdevValue" class="text-2xl font-bold text-green-600">-</p>
            </div>
            <div class="p-4 bg-red-100 border border-red-400 rounded-lg shadow">
                <h4 class="font-semibold text-lg">Risk</h4>
                <p id="riskValue" class="text-2xl font-bold text-red-600">-</p>
            </div>
        </div>

        <!-- Canvas untuk Grafik -->
        <div class="mt-6 flex justify-center">
            <canvas id="goldPriceChart" width="800" height="400"></canvas>
        </div>
    </div>

    <!-- Import Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("{{ route('chart-data') }}") 
                .then(response => response.json())
                .then(data => {
                    console.log("Data dari server:", data); // Debug data yang diterima

                    // Konversi harga menjadi angka (float)
                    const prices = data.prices.map(price => parseFloat(price) || 0);
                    console.log("Data harga yang diproses:", prices);

                    const minPrice = Math.min(...prices);
                    const maxPrice = Math.max(...prices);

                    // **Hitung Return**
                    const returns = [];
                    for (let i = 1; i < prices.length; i++) {
                        returns.push((prices[i] - prices[i - 1]) / prices[i - 1]); 
                    }
                    const avgReturn = (returns.reduce((a, b) => a + b, 0) / returns.length) * 100;

                    // **Hitung Standard Deviation**
                    const mean = avgReturn / 100;
                    const variance = returns.map(r => Math.pow(r - mean, 2)).reduce((a, b) => a + b, 0) / returns.length;
                    const stdDev = Math.sqrt(variance) * 100;

                    // **Hitung Risk (Misalnya: Std Dev dikalikan faktor)**
                    const risk = stdDev * 1.5;

                    // **Tampilkan di UI**
                    document.getElementById("returnValue").innerText = avgReturn.toFixed(2) + "%";
                    document.getElementById("stdevValue").innerText = stdDev.toFixed(2) + "%";
                    document.getElementById("riskValue").innerText = risk.toFixed(2) + "%";

                    // **Render Chart**
                    const ctx = document.getElementById('goldPriceChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.dates,  
                            datasets: [{
                                label: 'Harga Emas (USD/oz)',
                                data: prices,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)', 
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    title: { display: true, text: 'Tanggal' },
                                    ticks: {
                                        autoSkip: true,
                                        maxTicksLimit: 10
                                    }
                                },
                                y: { 
                                    title: { display: true, text: 'Harga (USD/oz)' },
                                    min: minPrice - 5,
                                    max: maxPrice + 5,
                                    suggestedMin: minPrice - 5,
                                    ticks: {
                                        stepSize: 5
                                    }
                                }
                            }
                        }
                    });
                });
        });
    </script>
</x-app-layout>
