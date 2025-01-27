<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        <x-pengurus-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-8 ml-64 w-full">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Semak Permohonan</h1>
                
                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempoh Pinjaman</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($borrowingRequests->isEmpty())
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center italic">Tiada permohonan</td>
                                </tr>
                            @endif
                            @foreach($borrowingRequests as $request)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $request->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $request->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $request->start_time->format('d/m/Y') }} hingga {{ $request->end_time->format('d/m/Y') }}
                                        <span class="text-gray-600 text-xs">
                                            @php
                                                $diff = $request->end_time->diff($request->start_time);
                                                $months = $diff->m;
                                                $days = $diff->d;
                                                $weeks = floor($days / 7);
                                                $remaining_days = $days % 7;
                                                
                                                $duration = [];
                                                if ($months > 0) $duration[] = $months . ' bulan';
                                                if ($weeks > 0) $duration[] = $weeks . ' minggu';
                                                if ($remaining_days > 0) $duration[] = $remaining_days . ' hari';
                                            @endphp
                                            ({{ implode(', ', $duration) }})
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($request->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($request->status === 'approved') bg-green-100 text-green-800
                                            @elseif($request->status === 'rejected') bg-red-100 text-red-800
                                            @elseif($request->status === 'returned') bg-blue-100 text-blue-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            @if($request->status === 'pending') Dalam Proses
                                            @elseif($request->status === 'approved') Diluluskan
                                            @elseif($request->status === 'rejected') Ditolak
                                            @elseif($request->status === 'returned') Dipulangkan
                                            @else {{ ucfirst($request->status) }}
                                            @endif
                                        </span>
                                        @if($request->status === 'approved' && $request->end_time < now() && $request->status !== 'returned')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Lambat Pulang</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('pengurus.inventori.permohonan.show', $request->id) }}" 
                                            class="text-indigo-600 hover:text-indigo-900">
                                            Semak
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>