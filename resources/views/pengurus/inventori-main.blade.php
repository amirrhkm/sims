<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        .nav-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(229, 231, 235, 0.5);
        }
        .nav-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.15);
            border-color: #3b82f6;
        }
        .icon-wrapper {
            transition: all 0.3s ease;
        }
        .nav-card:hover .icon-wrapper {
            transform: scale(1.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-pengurus-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-8 ml-64">
            <div class="max-w-7xl mx-auto">
                <!-- Header Section -->
                <div class="gradient-header rounded-xl shadow-lg p-8 mb-8 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 opacity-10">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold mb-3">Pengurusan Inventori</h1>
                    <p class="text-gray-100 text-lg">Panel Kawalan Pengurus</p>
                </div>
                
                <!-- Navigation Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <!-- Semak Permohonan Card -->
                    <a href="{{ route('pengurus.inventori.permohonan.index') }}" 
                        class="nav-card bg-white rounded-xl overflow-hidden group">
                        <div class="p-8">
                            <div class="icon-wrapper bg-blue-50 rounded-xl p-4 mb-6 inline-block">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors">
                                Semak Permohonan
                            </h2>
                            <p class="text-gray-600">Semak dan proses permohonan peminjaman inventori</p>
                            <div class="mt-6 flex items-center text-blue-600">
                                <span class="text-sm font-medium">Lihat Permohonan</span>
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Kemaskini Inventori Card -->
                    <a href="{{ route('pengurus.inventori-kemaskini') }}" 
                        class="nav-card bg-white rounded-xl overflow-hidden group">
                        <div class="p-8">
                            <div class="icon-wrapper bg-green-50 rounded-xl p-4 mb-6 inline-block">
                                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-green-600 transition-colors">
                                Kemaskini Inventori
                            </h2>
                            <p class="text-gray-600">Urus dan kemaskini senarai inventori</p>
                            <div class="mt-6 flex items-center text-green-600">
                                <span class="text-sm font-medium">Urus Inventori</span>
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>