<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        <x-pengurus-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-8 w-full ml-64">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Pengurusan Pengguna</h2>
                    <a href="{{ route('pengurus.pengguna-add') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        + Tambah Pengguna Baru
                    </a>
                </div>

                <!-- Pentadbir Table -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Senarai Pentadbir</h3>
                    
                    <!-- Single Search Filter for Pentadbir -->
                    <div class="mb-4">
                        <input type="text" 
                               id="pengurusSearch" 
                               placeholder="Cari pentadbir..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <table id="pengurusTable" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pengurus as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex space-x-2 justify-end">
                                            <a href="{{ route('pengurus.pengguna-edit', $user->id) }}" 
                                               class="text-blue-600 hover:text-blue-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('pengurus.pengguna-hapus', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 pr-2" 
                                                        onclick="return confirm('Adakah anda pasti untuk memadam pengguna ini?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tiada pentadbir dijumpai</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="px-6 py-4">
                            {{ $pengurus->links() }}
                        </div>
                    </div>
                </div>

                <!-- Pemohon Table -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Senarai Pemohon</h3>
                    
                    <!-- Single Search Filter for Pemohon -->
                    <div class="mb-4">
                        <input type="text" 
                               id="pemohonSearch" 
                               placeholder="Cari pemohon..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <table id="pemohonTable" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">Bahagian</th>
                                    <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">Seksyen/Unit</th> -->
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pemohon as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->department }}</td>
                                    <!-- <td class="px-6 py-4 whitespace-nowrap">{{ $user->section }}</td> -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex space-x-2 justify-end">
                                            <a href="{{ route('pengurus.pengguna-edit', $user->id) }}" 
                                               class="text-blue-600 hover:text-blue-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('pengurus.pengguna-hapus', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 pr-2" 
                                                        onclick="return confirm('Adakah anda pasti untuk memadam pengguna ini?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tiada pemohon dijumpai</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="px-6 py-4">
                            {{ $pemohon->links() }}
                        </div>
                    </div>
                </div>

                <!-- Simplified search script -->
                <script>
                    $(document).ready(function() {
                        // Pengurus Search
                        $("#pengurusSearch").on("keyup", function() {
                            const searchText = $(this).val().toLowerCase();
                            $("#pengurusTable tbody tr").filter(function() {
                                const rowText = $(this).text().toLowerCase();
                                $(this).toggle(rowText.includes(searchText));
                            });
                        });

                        // Pemohon Search
                        $("#pemohonSearch").on("keyup", function() {
                            const searchText = $(this).val().toLowerCase();
                            $("#pemohonTable tbody tr").filter(function() {
                                const rowText = $(this).text().toLowerCase();
                                $(this).toggle(rowText.includes(searchText));
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</body>