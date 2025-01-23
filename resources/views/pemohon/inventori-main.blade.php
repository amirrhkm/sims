<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        .nav-card {
            transition: all 0.3s ease;
        }
        .nav-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex">
        <!-- Sidebar -->
        <x-pemohon-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-8 ml-64 w-full">
            <div class="max-w-7xl mx-auto">
                <!-- Header Section -->
                <div class="gradient-header rounded-lg shadow-lg p-8 mb-8 text-white">
                    <h1 class="text-3xl font-bold mb-2">Inventori</h1>
                    <p class="text-gray-100">Sistem Pengurusan Inventori yang Mudah dan Efisien</p>
                </div>
                
                <!-- Navigation Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <!-- Permohonan Baru Card -->
                    <a href="{{ route('pemohon.inventori-borang-permohonan') }}" 
                        class="nav-card bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="bg-blue-50 rounded-lg p-4 mb-4 inline-block">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Permohonan Baru</h2>
                            <p class="text-gray-600">Buat permohonan peminjaman inventori baharu</p>
                        </div>
                    </a>

                    <!-- Lihat Permohonan Card -->
                    <a href="/pemohon/inventori/lihat-permohonan" 
                        class="nav-card bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="bg-green-50 rounded-lg p-4 mb-4 inline-block">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Lihat Permohonan</h2>
                            <p class="text-gray-600">Semak status permohonan peminjaman anda</p>
                        </div>
                    </a>

                    <!-- Lihat Inventori Card -->
                    <a href="{{ route('pemohon.inventori.lihat') }}" 
                        class="nav-card bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="bg-purple-50 rounded-lg p-4 mb-4 inline-block">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Lihat Inventori</h2>
                            <p class="text-gray-600">Semak senarai inventori yang tersedia</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>