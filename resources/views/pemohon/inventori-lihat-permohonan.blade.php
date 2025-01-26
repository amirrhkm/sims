<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        .status-badge {
            @apply px-3 py-1 text-xs font-semibold rounded-full;
            transition: all 0.2s ease-in-out;
        }
        .status-badge:hover {
            transform: translateY(-1px);
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
                <!-- Header -->
                <div class="gradient-header rounded-lg shadow-lg p-6 mb-8 text-white">
                    <h1 class="text-3xl font-bold">Senarai Permohonan</h1>
                    <p class="text-gray-100 mt-2">Senarai permohonan peminjaman inventori anda</p>
                </div>

                <!-- Notifications -->
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tarikh Permohonan
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tempoh Pinjaman
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Item
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tindakan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($borrowingRequests as $request)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            {{ $request->id }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            {{ $request->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            {{ $request->start_time->format('d/m/Y') }}<br>
                                            hingga<br>
                                            {{ $request->end_time->format('d/m/Y') }}<br>
                                            <span class="text-gray-600 text-xs">
                                                @php
                                                    $diff = $request->end_time->diff($request->start_time);
                                                    $months = $diff->m;
                                                    $days = $diff->d;
                                                    $weeks = floor($days / 7);
                                                    $remaining_days = $days % 7;
                                                @endphp
                                                ({{ $months . ' bulan, ' . $weeks . ' minggu, ' . $remaining_days . ' hari' }})
                                            </span>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <ul class="list-disc list-inside">
                                                @foreach($request->formatted_items as $item)
                                                    <li>{{ $item['name'] }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($request->status === 'approved') bg-green-100 text-green-800
                                                @elseif($request->status === 'rejected') bg-red-100 text-red-800
                                                @elseif($request->status === 'returned') bg-blue-100 text-blue-800
                                                @else bg-yellow-100 text-yellow-800
                                                @endif">
                                                @if($request->status === 'pending') Dalam Proses
                                                @elseif($request->status === 'approved') Diluluskan
                                                @elseif($request->status === 'rejected') Ditolak
                                                @elseif($request->status === 'returned') Dipulangkan
                                                @else {{ $request->status }}
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            @if($request->status === 'pending')
                                                <form action="{{ route('pemohon.inventori-hapus-permohonan', $request->id) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Adakah anda pasti untuk memadamkan permohonan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900"
                                                            {{ $request->status === 'approved' ? 'disabled' : '' }}>
                                                        Padam
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($request->status === 'rejected')
                                        <tr>
                                            <td colspan="6" class="px-5 py-1 border-b border-gray-200 bg-red-50">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <div class="flex flex-col">
                                                        <span class="text-red-600 font-medium text-sm">
                                                            ID: {{ $request->id }} - Permohonan ditolak
                                                        </span>
                                                        @if($request->remarks)
                                                            <span class="text-red-500 text-xs mt-1">
                                                                Catatan: {{ $request->remarks }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                            Tiada permohonan dijumpai.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $borrowingRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>