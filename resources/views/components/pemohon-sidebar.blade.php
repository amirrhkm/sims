<div class="fixed h-screen w-64 bg-gray-900 text-white flex flex-col transition-all duration-300">
    <!-- Logo and App Title -->
    <div class="p-4 flex items-center space-x-3 justify-between">
        <h1 class="text-xl font-bold text-center">SIMS</h1>
        <p class="text-xs text-gray-400">v0.0.9</p>
    </div>

    <!-- User Info -->
    <div class="p-4 border-t border-gray-800">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 rounded-full flex items-center justify-center pl-3">
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <a href="{{ route('pemohon.pengguna-show', Auth::user()->id) }}" class="text-sm font-medium">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
        <a href="/pemohon/dashboard" method="GET" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('pemohon.dashboard') ? 'bg-blue-600 bg-opacity-50' : '' }}">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="/pemohon/inventori" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('pemohon.inventori') ? 'bg-blue-600 bg-opacity-50' : '' }}">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <span>Inventori</span>
        </a>

        <a href="{{ route('pemohon.laporan') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('pemohon.laporan') ? 'bg-blue-600 bg-opacity-50' : '' }}">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span>Laporan</span>
        </a>
    </nav>

    <!-- Logout Button -->
    <div class="p-4 border-t border-gray-800 mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center space-x-3 p-3 w-full rounded-lg hover:bg-red-600 transition-all duration-200 text-white">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Log Keluar</span>
            </button>
        </form>
    </div>
</div>
