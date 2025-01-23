<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .gradient-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        .search-input:focus {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
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
                <div class="gradient-header rounded-lg shadow-lg p-6 mb-8 text-white">
                    <h1 class="text-3xl font-bold">Senarai Inventori</h1>
                    <p class="text-gray-100 mt-2">Senarai item yang tersedia untuk dipinjam</p>
                </div>

                <!-- Search and Filter Section -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <form action="{{ route('pemohon.inventori.lihat') }}" method="GET" class="flex gap-4 items-center">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search"
                                   placeholder="Cari item mengikut nama atau kategori..." 
                                   class="search-input w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 transition duration-150 ease-in-out"
                                   value="{{ request('search') }}">
                        </div>
                        
                        <div class="flex gap-2">
                            <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                Cari
                            </button>
                            
                            @if(request('search'))
                                <a href="{{ route('pemohon.inventori.lihat') }}" 
                                   class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150 ease-in-out flex items-center">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Inventory Table -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Barang
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kuantiti
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($inventories as $item)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-600">{{ $item->category }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-600">
                                            <span class="font-medium">{{ $item->quantity }}</span> / {{ $item->total_quantity }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $item->quantity > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $item->quantity > 0 ? 'Tersedia' : 'Habis' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 bg-gray-50">
                                        <div class="flex flex-col items-center justify-center py-6">
                                            <svg class="h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <span class="text-gray-600">Tiada inventori dijumpai</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if($inventories->hasPages())
                        <div class="bg-white px-6 py-4 border-t border-gray-200">
                            {{ $inventories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
