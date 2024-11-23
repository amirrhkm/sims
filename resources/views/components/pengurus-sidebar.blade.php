<div class="min-h-screen w-64 bg-gray-900 text-white flex flex-col transition-all duration-300">
    <!-- Logo and App Title -->
    <div class="p-4 flex items-center space-x-3">
        <h1 class="text-xl font-bold text-center">SIMS</h1>
    </div>

    <!-- User Info -->
    <div class="p-4 border-t border-gray-800">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 rounded-full flex items-center justify-center pl-3">
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <span class="text-sm font-medium">Amirul Hazim</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-2">
        <a href="/dashboard" method="GET" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 transition-all duration-200">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span>Halaman Utama</span>
        </a>

        <a href="/pemohon/inventori" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('inventori') ? 'bg-blue-600' : '' }}">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <span>Inventori</span>
        </a>

        <a href="" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('laporan') ? 'bg-blue-600' : '' }}">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span>Laporan</span>
        </a>

        <a href="" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('pembekal') ? 'bg-blue-600' : '' }}">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <span>Pembekal</span>
        </a>

        <a href="" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('pengguna') ? 'bg-blue-600' : '' }}">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <span>Pengguna</span>
        </a>
    </nav>
</div>
