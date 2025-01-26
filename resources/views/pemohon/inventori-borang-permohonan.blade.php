<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex">
        <!-- Sidebar -->
        <x-pemohon-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-8 ml-64 w-full">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="gradient-header rounded-lg shadow-lg p-6 mb-8 text-white">
                    <h1 class="text-3xl font-bold">Borang Permohonan</h1>
                    <p class="text-gray-100 mt-2">Sila isi maklumat permohonan dengan lengkap</p>
                </div>
                
                <form class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('pemohon.inventori-borang-permohonan') }}">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Borrowing Duration -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tempoh Peminjaman</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Tarikh & Masa Mula</label>
                                <input name="start_time" type="datetime-local" 
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Tarikh & Masa Tamat</label>
                                <input name="end_time" type="datetime-local" 
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" required>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Item Selection -->
                    <div id="itemSelections">
                        <div class="mb-4 grid grid-cols-12 gap-4 items-end">
                            <div class="col-span-11">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Senarai Item</label>
                                <select name="items[0][id]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="">Pilih Item</option>
                                    @foreach($inventories->groupBy('category') as $category => $items)
                                        @if($items->where('quantity', '>', 0)->count() > 0)
                                            <optgroup label="{{ $category }}">
                                                @foreach($items as $item)
                                                    @if($item->quantity > 0)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="hidden" name="items[0][quantity]" value="1">
                            </div>
                            <!-- <div class="col-span-1">
                                <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div> -->
                        </div>
                    </div>

                    <!-- Add Item Button -->
                    <!-- <div class="mb-6">
                        <button type="button" id="addItem" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            + Tambah Item
                        </button>
                    </div> -->

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Hantar Permohonan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const itemSelections = document.getElementById('itemSelections');
            const addItemButton = document.getElementById('addItem');
            let itemCount = 1;

            // Function to update name attributes
            function updateNameAttributes() {
                const rows = itemSelections.children;
                Array.from(rows).forEach((row, index) => {
                    const select = row.querySelector('select');
                    const input = row.querySelector('input[type="hidden"]');
                    if (select) select.name = `items[${index}][id]`;
                    if (input) input.name = `items[${index}][quantity]`;
                });
            }

            addItemButton.addEventListener('click', function() {
                if (itemCount >= 8) {
                    alert('Maksimum 8 item sahaja dibenarkan');
                    return;
                }

                const newItem = itemSelections.children[0].cloneNode(true);
                newItem.querySelector('select').value = '';
                itemSelections.appendChild(newItem);
                itemCount++;
                updateNameAttributes();

                if (itemCount === 8) {
                    addItemButton.style.display = 'none';
                }
            });

            itemSelections.addEventListener('click', function(e) {
                if (e.target.closest('button') && e.target.closest('button').classList.contains('bg-red-500')) {
                    if (itemCount > 1) {
                        e.target.closest('.grid').remove();
                        itemCount--;
                        updateNameAttributes();
                        addItemButton.style.display = 'block';
                    }
                }
            });

            // Check for duplicate items
            itemSelections.addEventListener('change', function(e) {
                if (e.target.tagName === 'SELECT') {
                    const selectedId = e.target.value;
                    const selects = itemSelections.querySelectorAll('select');
                    let duplicateFound = false;
                    
                    selects.forEach(select => {
                        if (select !== e.target && select.value === selectedId) {
                            duplicateFound = true;
                        }
                    });

                    if (duplicateFound) {
                        alert('Item ini telah dipilih. Sila pilih item lain.');
                        e.target.value = '';
                    }
                }
            });
        });
    </script>
</body>