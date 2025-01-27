<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        <x-pengurus-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-8 ml-64 w-full">
            <div class="max-w-3xl mx-auto">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900">Butiran Permohonan #{{ $borrowingRequest->id }}</h1>
                    <a href="{{ route('pengurus.inventori.permohonan.index') }}" class="text-gray-600 hover:text-gray-900">
                        &larr; Kembali
                    </a>
                </div>

                <!-- Request Details -->
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pemohon</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jawatan</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->user->position }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Gred</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->user->grade }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Bahagian</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->user->department }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">No. Telefon</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->user->phone_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <p class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($borrowingRequest->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($borrowingRequest->status === 'approved') bg-green-100 text-green-800
                                    @elseif($borrowingRequest->status === 'returned') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    @if($borrowingRequest->status === 'pending') Dalam Proses
                                    @elseif($borrowingRequest->status === 'approved') Diluluskan
                                    @elseif($borrowingRequest->status === 'rejected') Ditolak
                                    @elseif($borrowingRequest->status === 'returned') Dipulangkan
                                    @else {{ ucfirst($borrowingRequest->status) }}
                                    @endif
                                </span>
                                @if($borrowingRequest->status === 'approved' && $borrowingRequest->end_time < now() && $borrowingRequest->status !== 'returned')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Lambat Pulang</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tempoh Pinjaman</p>
                            <p class="mt-1 text-sm text-gray-900">
                                @php
                                    $diff = $borrowingRequest->end_time->diff($borrowingRequest->start_time);
                                    $months = $diff->m;
                                    $days = $diff->d;
                                    $weeks = floor($days / 7);
                                    $remaining_days = $days % 7;
                                    
                                    $duration = [];
                                    if ($months > 0) $duration[] = $months . ' bulan';
                                    if ($weeks > 0) $duration[] = $weeks . ' minggu';
                                    if ($remaining_days > 0) $duration[] = $remaining_days . ' hari';
                                @endphp
                                {{ implode(', ', $duration) }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tarikh Mula</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->start_time->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tarikh Tamat</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->end_time->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Admin Details (New Section) -->
                @if($borrowingRequest->status !== 'pending' && $borrowingRequest->processed_by)
                    <div class="bg-white shadow rounded-lg p-6 mb-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Maklumat Pemproses</h2>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Pemproses</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->processedBy->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->processedBy->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jawatan</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->processedBy->position }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jabatan</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->processedBy->department }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tarikh Diproses</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $borrowingRequest->processed_at?->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Items List -->
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Senarai Barang</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuantiti</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($borrowingRequest->formattedItems as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['name'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['category'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['quantity'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($borrowingRequest->status === 'pending')
                    <!-- Approval Form -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Tindakan</h2>
                        <form action="{{ route('pengurus.inventori.permohonan.update', $borrowingRequest->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <!-- Add Date/Time Fields -->
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="start_time" class="block text-sm font-medium text-gray-700">Tarikh & Masa Mula</label>
                                    <input type="datetime-local" id="start_time" name="start_time" 
                                        value="{{ $borrowingRequest->start_time->format('Y-m-d\TH:i') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="end_time" class="block text-sm font-medium text-gray-700">Tarikh & Masa Tamat</label>
                                    <input type="datetime-local" id="end_time" name="end_time" 
                                        value="{{ $borrowingRequest->end_time->format('Y-m-d\TH:i') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="remarks" class="block text-sm font-medium text-gray-700">Catatan</label>
                                <textarea id="remarks" name="remarks" rows="3" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Masukkan catatan jika ada..."></textarea>
                            </div>

                            <div class="flex justify-end space-x-3">
                                <button type="submit" name="action" value="rejected"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Ditolak
                                </button>
                                <button type="submit" name="action" value="approved"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Diluluskan
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Display Remarks if request is already processed -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Catatan</h2>
                        <p class="text-sm text-gray-600">{{ $borrowingRequest->remarks ?: 'Tiada catatan' }}</p>
                    </div>
                @endif
                <!-- Return Button -->
                @if($borrowingRequest->status === 'approved' && $borrowingRequest->status !== 'returned')
                    <div class="mt-6">
                        <a href="{{ route('pengurus.inventori.permohonan.returned', $borrowingRequest->id) }}" 
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Tandakan telah dipulangkan
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
