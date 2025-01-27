<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex">
        <x-pemohon-sidebar />

        <div class="flex-1 p-8 ml-64">
            <!-- Header with Gradient -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 mb-6">
                <h1 class="text-2xl font-bold text-white">Smart Inventory Management System</h1>
                <p class="text-blue-100 mt-2">Dashboard Sistem Pengurusan Inventori</p>
            </div>

            <!-- Metrics Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Change Active Users Card to Total Inventory Items -->
                <div onclick="window.location.href='{{ route('pemohon.inventori.lihat') }}'" 
                    class="bg-white rounded-lg shadow-md p-6 transform hover:scale-105 transition-transform duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Keseluruhan Item</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalInventory }}</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i class="fas fa-boxes text-purple-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Items Card -->
                <div onclick="window.location.href='{{ route('pemohon.inventori.lihat') }}'" 
                     class="bg-white rounded-lg shadow-md p-6 transform hover:scale-105 transition-transform duration-200 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Sedia Dipinjam</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalItems }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-box text-green-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Items Borrowed Card -->
                <div class="bg-white rounded-lg shadow-md p-6 transform hover:scale-105 transition-transform duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Dalam Pinjaman</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $itemsBorrowed }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-box-open text-blue-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Overdue Items Card -->
                <div class="bg-white rounded-lg shadow-md p-6 transform hover:scale-105 transition-transform duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Pinjaman Lebih Masa</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $overdueItems }}</p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Activity Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Borrowing Status Chart -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Status Pinjaman</h2>
                    <div class="relative" style="height: 300px;">
                        <canvas id="borrowingChart"></canvas>
                    </div>
                </div>

                <!-- Activity Log -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Aktiviti Terbaru</h2>
                    <div class="overflow-x-auto">
                        <table id="activityLog" class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Tarikh</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Pengguna</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($activities->isEmpty())
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-500">-</td>
                                        <td class="px-4 py-2 text-sm text-gray-500">-</td>
                                        <td class="px-4 py-2 text-sm text-gray-500">Tiada aktiviti untuk dipaparkan</td>
                                    </tr>
                                @else
                                    @foreach($activities as $activity)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2 text-sm">{{ $activity->created_at->format('d M, Y') }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $activity->causer->name ?? 'System' }}</td>
                                            <td class="px-4 py-2 text-sm">
                                                @if($activity->type === 'borrowing_request_created')
                                                    <span class="text-blue-600">
                                                        <i class="fas fa-plus-circle mr-1"></i>
                                                        Memohon pinjaman baharu
                                                    </span>
                                                @elseif($activity->type === 'borrowing_request_approved')
                                                    <span class="text-green-600">
                                                        <i class="fas fa-check-circle mr-1"></i>
                                                        Permohonan diluluskan
                                                    </span>
                                                @elseif($activity->type === 'borrowing_request_rejected')
                                                    <span class="text-red-600">
                                                        <i class="fas fa-times-circle mr-1"></i>
                                                        Permohonan ditolak
                                                    </span>
                                                @elseif($activity->type === 'borrowing_request_returned')
                                                    <span class="text-neutral-600">
                                                        <i class="fas fa-minus-circle mr-1"></i>
                                                        Pinjaman Tamat
                                                    </span>
                                                @else
                                                    {{ $activity->description }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Chart Initialization with improved styling
        const ctx = document.getElementById('borrowingChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Sedia Dipinjam', 'Dalam Pinjaman', 'Pinjaman Lebih Masa'],
                datasets: [{
                    data: [{{ $availableItems }}, {{ $itemsBorrowed }}, {{ $overdueItems }}],
                    backgroundColor: ['#10B981', '#3B82F6', '#EF4444'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });

    // DataTable Initialization
    $(document).ready(function () {
      $('#activityLog').DataTable();
    });

    // Modal Logic
    document.getElementById('addItemBtn').addEventListener('click', () => {
      document.getElementById('addItemModal').classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', () => {
      document.getElementById('addItemModal').classList.add('hidden');
    });
  </script>
</body>