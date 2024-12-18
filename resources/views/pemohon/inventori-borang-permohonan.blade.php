<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        <x-pemohon-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-8 ml-64 w-full">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Borang Permohonan</h1>
                
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('pemohon.inventori-borang-permohonan') }}">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Borrowing Duration -->
                    <div class="mb-6 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tarikh & Masa Mula</label>
                            <input name="start_time" type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tarikh & Masa Tamat</label>
                            <input name="end_time" type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                    </div>

                    <!-- Dynamic Item Selection -->
                    <div id="itemSelections">
                        <div class="mb-4 grid grid-cols-12 gap-4 items-end">
                            <div class="col-span-11">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Item</label>
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
                            <div class="col-span-1">
                                <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Add Item Button -->
                    <div class="mb-6">
                        <button type="button" id="addItem" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            + Tambah Item
                        </button>
                    </div>

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