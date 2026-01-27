@extends('layouts.app')

@section('title', 'Dashboard Penerima Bantuan')

@section('content')
    <div class="min-h-screen bg-slate-100">
        {{-- HEADER AREA --}}
        @include('beneficiaries.partials.header')
        {{-- END HEADER AREA --}}
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            {{-- STAT CARD AREA --}}
            @include('beneficiaries.partials.statistic-cards')
            {{-- END STAT CARD AREA --}}

            {{-- CHART AREA --}}
            @include('beneficiaries.partials.charts')
            {{-- END CHART AREA --}}

            {{-- BANJAR STAT TABLE --}}
            @include('beneficiaries.partials.banjar-stats-table')
            {{-- END BANJAR STAT TABLE --}}

            {{-- BENEFICIARIES DATA TABLE --}}
            @include('beneficiaries.partials.beneficiaries-table')
            {{-- BENEFICIARIES DATA TABLE --}}
        </div>
    </div>

    <footer>
        @include('beneficiaries.partials.footer')
    </footer>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Chart 1: Banjar Distribution Chart (Stacked/Spread Toggle)
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('banjarDistributionChart');
                if (!ctx) return;

                // Prepare data for chart
                const banjarNames = @json($banjarDetails->pluck('name'));
                const assistanceData = {};

                @foreach ($socialAssistances as $assistance)
                    assistanceData['{{ $assistance->name }}'] = @json(
                        $banjarDetails->map(function ($banjar) use ($assistance) {
                            return $banjar->assistance_counts[$assistance->id] ?? 0;
                        }));
                @endforeach

                const colors = @json($socialAssistances->pluck('color'));

                // Create datasets
                const datasets = Object.keys(assistanceData).map((key, index) => ({
                    label: key,
                    data: assistanceData[key],
                    backgroundColor: colors[index] + '80',
                    borderColor: colors[index],
                    borderWidth: 1,
                    borderRadius: 2,
                }));

                // CHANGE: Make stacked the default
                let chartType = 'stacked';
                let chart;

                // Function to create/update chart
                function createChart(type) {
                    chartType = type;

                    if (chart) {
                        chart.destroy();
                    }

                    chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: banjarNames,
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: window.innerWidth < 640 ? 'bottom' : 'right',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 15,
                                        font: {
                                            size: 11
                                        },
                                        boxWidth: 12,
                                        boxHeight: 12
                                    }
                                },
                                tooltip: {
                                    mode: chartType === 'stacked' ? 'index' : 'nearest',
                                    intersect: false
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: true
                                    },
                                    ticks: {
                                        font: {
                                            size: 11
                                        }
                                    },
                                    stacked: chartType === 'stacked'
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1,
                                        font: {
                                            size: 11
                                        },
                                        precision: 0
                                    },
                                    stacked: chartType === 'stacked'
                                }
                            },
                            animation: {
                                duration: 300
                            }
                        }
                    });
                }

                // CHANGE: Create initial chart as STACKED
                createChart('stacked');

                // Initialize button states for stacked as default (NEW VERSION)
                function initializeToggleButtons() {
                    const groupedBtn = document.getElementById('grouped-chart-btn');
                    const stackedBtn = document.getElementById('stacked-chart-btn');

                    // Reset both buttons to neutral state
                    groupedBtn.className =
                        'rounded-full px-4 py-2 text-sm font-medium text-gray-600 transition-all duration-200 hover:text-gray-900 hover:shadow';
                    stackedBtn.className =
                        'rounded-full px-4 py-2 text-sm font-medium text-gray-600 transition-all duration-200 hover:text-gray-900 hover:shadow';

                    // Set stacked as active (blue gradient)
                    stackedBtn.className =
                        'rounded-full bg-gradient-to-r from-cyan-500 to-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-200';
                }

                // Call it on initialization
                initializeToggleButtons();

                // Function to toggle button styles
                function toggleChartButtons(activeType) {
                    const groupedBtn = document.getElementById('grouped-chart-btn');
                    const stackedBtn = document.getElementById('stacked-chart-btn');

                    // Reset both buttons
                    groupedBtn.className =
                        'rounded-full px-4 py-2 text-sm font-medium text-gray-600 transition-all duration-200 hover:text-gray-900 hover:shadow';
                    stackedBtn.className =
                        'rounded-full px-4 py-2 text-sm font-medium text-gray-600 transition-all duration-200 hover:text-gray-900 hover:shadow';

                    // Set active button
                    if (activeType === 'grouped') {
                        groupedBtn.className =
                            'rounded-full bg-gradient-to-r from-cyan-500 to-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-200';
                    } else {
                        stackedBtn.className =
                            'rounded-full bg-gradient-to-r from-cyan-500 to-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-200';
                    }
                }

                // Add button event listeners
                document.getElementById('grouped-chart-btn').addEventListener('click', function() {
                    createChart('grouped');
                    toggleChartButtons('grouped');
                });

                document.getElementById('stacked-chart-btn').addEventListener('click', function() {
                    createChart('stacked');
                    toggleChartButtons('stacked');
                });

                // -------------------------------------------------
                // Chart 2: Gender Distribution Pie Chart
                // -------------------------------------------------
                const genderCtx = document.getElementById('genderChart');
                if (genderCtx) {
                    // Get gender data from controller
                    const genderLabels = ['Laki-Laki', 'Perempuan'];
                    const genderData = [
                        {{ $genderStats['male'] ?? 0 }},
                        {{ $genderStats['female'] ?? 0 }}
                    ];

                    // Calculate percentages
                    const totalGender = genderData.reduce((a, b) => a + b, 0);
                    const malePercentage = totalGender > 0 ? Math.round((genderData[0] / totalGender) * 100) : 0;
                    const femalePercentage = totalGender > 0 ? Math.round((genderData[1] / totalGender) * 100) : 0;

                    const genderChartData = {
                        labels: genderLabels,
                        datasets: [{
                            data: genderData,
                            backgroundColor: [
                                '#3B82F6', // Blue for male
                                '#EC4899' // Pink for female
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2,
                            hoverOffset: 15
                        }]
                    };

                    const genderChart = new Chart(genderCtx, {
                        type: 'pie',
                        data: genderChartData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            aspectRatio: 1,
                            plugins: {
                                legend: {
                                    position: window.innerWidth < 640 ? 'bottom' : 'right',
                                    labels: {
                                        padding: 15,
                                        boxWidth: 10,
                                        usePointStyle: true,
                                        font: {
                                            size: 11
                                        },
                                        generateLabels: function(chart) {
                                            const data = chart.data;
                                            if (data.labels.length && data.datasets.length) {
                                                return data.labels.map((label, i) => {
                                                    const value = data.datasets[0].data[i];
                                                    const percentage = totalGender > 0 ? Math.round(
                                                        (value / totalGender) * 100) : 0;
                                                    return {
                                                        text: `${label}: ${value} (${percentage}%)`,
                                                        fillStyle: data.datasets[0].backgroundColor[
                                                            i],
                                                        strokeStyle: data.datasets[0].borderColor,
                                                        lineWidth: data.datasets[0].borderWidth,
                                                        hidden: isNaN(data.datasets[0].data[i]) ||
                                                            data.datasets[0].data[i] === 0,
                                                        index: i
                                                    };
                                                });
                                            }
                                            return [];
                                        }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const percentage = totalGender > 0 ? Math.round((value /
                                                totalGender) * 100) : 0;
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                },
                                // Add title plugin to show total
                                // title: {
                                //     display: true,
                                //     text: `Total: ${totalGender}`,
                                //     position: 'bottom',
                                //     font: {
                                //         size: 12,
                                //         weight: 'bold'
                                //     },
                                //     padding: {
                                //         top: 10,
                                //         bottom: 20
                                //     }
                                // }
                            },
                            animation: {
                                animateScale: true,
                                animateRotate: true
                            }
                        }
                    });

                    // If no data, show message
                    if (totalGender === 0) {
                        genderCtx.style.display = 'none';
                        const noDataDiv = document.createElement('div');
                        noDataDiv.className = 'flex flex-col items-center justify-center h-full text-gray-400';
                        noDataDiv.innerHTML = `
            <svg class="h-12 w-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm">Tidak ada data jenis kelamin</p>
        `;
                        genderCtx.parentElement.appendChild(noDataDiv);
                    }
                }

                // -------------------------------------------------
                // Chart 3: Banjar Distribution doughnut Chart
                // -------------------------------------------------
                const banjarPieCtx = document.getElementById('banjarPieChart');
                if (banjarPieCtx) {
                    const banjarLabels = @json($banjarDetails->pluck('name'));
                    const banjarData = @json($banjarDetails->pluck('total'));

                    // Generate colors for banjars
                    const banjarColors = [
                        '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
                        '#EC4899', '#06B6D4', '#84CC16', '#F97316', '#6366F1'
                    ];

                    const banjarPieData = {
                        labels: banjarLabels,
                        datasets: [{
                            data: banjarData,
                            backgroundColor: banjarColors.slice(0, banjarLabels.length),
                            borderColor: '#ffffff',
                            borderWidth: 2,
                            hoverOffset: 15
                        }]
                    };

                    new Chart(banjarPieCtx, {
                        type: 'doughnut',
                        data: banjarPieData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            aspectRatio: 1,
                            plugins: {
                                legend: {
                                    position: window.innerWidth < 640 ? 'bottom' : 'right',
                                    labels: {
                                        padding: 15,
                                        usePointStyle: true,
                                        font: {
                                            size: 10
                                        },
                                        boxWidth: 10,
                                        boxHeight: 10
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = Math.round((value / total) * 100);
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            },
                            cutout: '60%',
                            animation: {
                                animateScale: true,
                                animateRotate: true
                            }
                        }
                    });
                }

                // -------------------------------------------------
                // Chart 4: Assistance Distribution Pie Chart
                // -------------------------------------------------
                const assistanceCtx = document.getElementById('assistanceChart');
                if (assistanceCtx) {
                    const assistanceLabels = @json($socialAssistanceStats->pluck('name'));
                    const assistanceData = @json($socialAssistanceStats->pluck('beneficiaries_count'));
                    const assistanceColors = @json($socialAssistanceStats->pluck('color'));

                    const assistanceChartData = {
                        labels: assistanceLabels,
                        datasets: [{
                            data: assistanceData,
                            backgroundColor: assistanceColors.map(color => color + 'CC'),
                            borderColor: assistanceColors,
                            borderWidth: 2,
                            hoverOffset: 15
                        }]
                    };

                    new Chart(assistanceCtx, {
                        type: 'doughnut',
                        data: assistanceChartData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            aspectRatio: 1,
                            plugins: {
                                legend: {
                                    position: window.innerWidth < 640 ? 'bottom' : 'right',
                                    labels: {
                                        padding: 15,
                                        usePointStyle: true,
                                        font: {
                                            size: 10
                                        },
                                        boxWidth: 10,
                                        boxHeight: 10
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = Math.round((value / total) * 100);
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            },
                            animation: {
                                animateScale: true,
                                animateRotate: true
                            }
                        }
                    });
                }

                function isMobile() {
                    return window.innerWidth < 640; // Tailwind sm breakpoint
                }

                // -------------------------------------------------
                // AJAX Table Loading
                // -------------------------------------------------
                // Load initial beneficiaries data
                loadBeneficiaries();

                // Search functionality
                let searchTimeout;
                document.getElementById('search-input').addEventListener('input', function(e) {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        loadBeneficiaries(1);
                    }, 300);
                });

                // Filter functionality
                document.getElementById('banjar-filter').addEventListener('change', function() {
                    loadBeneficiaries(1);
                });

                document.getElementById('assistance-filter').addEventListener('change', function() {
                    loadBeneficiaries(1);
                });
            });

            // Load beneficiaries via AJAX
            function loadBeneficiaries(page = 1) {
                const search = document.getElementById('search-input').value;
                const banjar = document.getElementById('banjar-filter').value;
                const assistance = document.getElementById('assistance-filter').value;

                // Build query parameters
                const params = new URLSearchParams({
                    page: page,
                    search: search,
                    banjar: banjar,
                    assistance: assistance
                });

                fetch(`/beneficiaries/data?${params.toString()}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Update table body
                        const tableBody = document.getElementById('beneficiaries-table-body');
                        if (data.data && data.data.length > 0) {
                            tableBody.innerHTML = data.data.map((beneficiary, index) => `
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        ${data.from + index}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="font-medium text-gray-900">${beneficiary.nama_lengkap}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                            ${beneficiary.banjar ? beneficiary.banjar.name : 'N/A'}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                        ${beneficiary.nik_display || beneficiary.nomor_induk_kependudukan}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${beneficiary.gender && beneficiary.gender.name === 'Laki-Laki' ? 'bg-green-100 text-green-800' : 'bg-pink-100 text-pink-800'}">
                                            ${beneficiary.gender ? beneficiary.gender.name : 'N/A'}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            ${beneficiary.social_assistances && beneficiary.social_assistances.length > 0
                                                ? beneficiary.social_assistances.map(assistance => `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span class="inline-flex items-center rounded px-2 py-1 text-xs font-medium" style="background-color: ${assistance.color}20; color: ${assistance.color};">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ${assistance.name}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                `).join('')
                                                : '<span class="text-xs text-gray-400">Tidak ada bantuan</span>'
                                            }
                                        </div>
                                    </td>
                                </tr>
                            `).join('');
                        } else {
                            tableBody.innerHTML = `
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="mt-2 text-sm">Tidak ada data yang ditemukan</p>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }

                        const paginationContainer = document.getElementById('pagination-container');

                        if (data.total > 0) {
                            const isMobile = window.innerWidth < 640;

                            let html = `
        <div class="text-sm text-gray-600 text-center">
            Menampilkan <span class="text-xs font-medium">${data.from}</span>
            sampai <span class="font-medium">${data.to}</span>
            dari <span class="font-medium">${data.total}</span> data
        </div>
        <div class="flex items-center gap-1 flex-wrap justify-center">
    `;

                            /* ===== MOBILE MODE ===== */
                            if (isMobile) {
                                html += `
            <button onclick="loadBeneficiaries(1)"
                class="px-3 py-2 text-gray-600 rounded bg-gray-100 ${data.current_page === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-200'}"
                ${data.current_page === 1 ? 'disabled' : ''}>
                Awal

            </button>

            <button onclick="loadBeneficiaries(${data.current_page - 1})"
                class="px-3 py-2 text-gray-600 rounded bg-gray-100 ${data.current_page === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-200'}"
                ${data.current_page === 1 ? 'disabled' : ''}>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
</svg>

            </button>

            <span class="inline-flex items-center justify-center w-10 h-10 rounded bg-blue-600 text-white font-bold">
    ${data.current_page}
</span>

            <button onclick="loadBeneficiaries(${data.current_page + 1})"
                class="px-3 py-2 rounded text-gray-600 bg-gray-100 ${data.current_page === data.last_page ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-200'}"
                ${data.current_page === data.last_page ? 'disabled' : ''}>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
</svg>

            </button>

            <button onclick="loadBeneficiaries(${data.last_page})"
                class="px-3 py-2 rounded text-gray-600 bg-gray-100 ${data.current_page === data.last_page ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-200'}"
                ${data.current_page === data.last_page ? 'disabled' : ''}>
                Akhir

            </button>
        `;
                            }

                            /* ===== DESKTOP MODE ===== */
                            else {
                                const start = Math.max(1, data.current_page - 1);
                                const end = Math.min(data.last_page, data.current_page + 1);

                                html += `
            <button onclick="loadBeneficiaries(${data.current_page - 1})"
                class="px-4 py-2 rounded bg-gray-100 ${data.current_page === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-200'}"
                ${data.current_page === 1 ? 'disabled' : ''}>
                Prev
            </button>
        `;

                                if (start > 1) {
                                    html +=
                                        `<button onclick="loadBeneficiaries(1)" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">1</button>`;
                                    if (start > 2) html += `<span class="px-2">...</span>`;
                                }

                                for (let i = start; i <= end; i++) {
                                    html += `
                <button onclick="loadBeneficiaries(${i})"
                    class="px-4 py-2 rounded ${i === data.current_page ? 'bg-blue-600 text-white font-bold' : 'bg-gray-100 hover:bg-gray-200'}">
                    ${i}
                </button>
            `;
                                }

                                if (end < data.last_page) {
                                    if (end < data.last_page - 1) html += `<span class="px-2">...</span>`;
                                    html +=
                                        `<button onclick="loadBeneficiaries(${data.last_page})" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">${data.last_page}</button>`;
                                }

                                html += `
            <button onclick="loadBeneficiaries(${data.current_page + 1})"
                class="px-4 py-2 rounded bg-gray-100 ${data.current_page === data.last_page ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-200'}"
                ${data.current_page === data.last_page ? 'disabled' : ''}>
                Next
            </button>
        `;
                            }

                            html += `</div>`;
                            paginationContainer.innerHTML = html;
                        } else {
                            paginationContainer.innerHTML = '';
                        }

                    })
                    .catch(error => {
                        console.error('Error loading beneficiaries:', error);
                        const tableBody = document.getElementById('beneficiaries-table-body');
                        tableBody.innerHTML = `
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-red-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="h-12 w-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="mt-2 text-sm">Terjadi kesalahan saat memuat data</p>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
            }
        </script>
    @endpush

    <style>
        /* Custom scrollbar for banjar cards */
        #banjar-cards-container::-webkit-scrollbar {
            width: 6px;
        }

        #banjar-cards-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        #banjar-cards-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        #banjar-cards-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Smooth transitions */
        .transition-colors {
            transition: background-color 0.2s ease;
        }

        .transition-transform {
            transition: transform 0.2s ease;
        }

        .transition-shadow {
            transition: box-shadow 0.2s ease;
        }

        /* Pagination styling */
        #pagination-container button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        #pagination-container button:hover:not(:disabled) {
            transform: translateY(-1px);
        }

        /* Ensure pagination is visible */
        #pagination-container {
            min-height: 40px;
        }

        /* Chart container styling */
        .chart-container {
            position: relative;
            width: 100%;
        }
    </style>
@endsection
