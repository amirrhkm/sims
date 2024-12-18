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
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Tambah Item Inventori</h1>
                
                <form action="{{ route('pengurus.inventori-kemaskini-item-add') }}" method="POST" class="max-w-lg">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Item</label>
                            <input type="text" name="name" id="name" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Kuantiti</label>
                            <input type="number" name="quantity" id="quantity" min="0" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                    <div class="flex items-center">
                                        <input type="radio" name="category" id="category_{{ $loop->index }}" 
                                            value="{{ $category }}" class="border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            required>
                                        <label for="category_{{ $loop->index }}" class="ml-2 text-sm text-gray-700">{{ $category }}</label>
                                    </div>
                                @endforeach
                                <div class="flex items-center">
                                    <input type="radio" name="category" id="new_category_radio" value="new"
                                        class="border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <label for="new_category_radio" class="ml-2 text-sm text-gray-700">Kategori Baru</label>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden input for new category -->
                        <div id="newCategoryInput" class="hidden">
                            <label for="new_category" class="block text-sm font-medium text-gray-700">Kategori Baru</label>
                            <input type="text" name="new_category" id="new_category"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <button type="submit" 
                            class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Tambah Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Updated JavaScript for handling new category input -->
    <script>
        document.getElementById('new_category_radio').addEventListener('change', function() {
            const newCategoryInput = document.getElementById('newCategoryInput');
            const newCategoryField = document.getElementById('new_category');
            if (this.checked) {
                newCategoryInput.classList.remove('hidden');
                newCategoryField.required = true;
            } else {
                newCategoryInput.classList.add('hidden');
                newCategoryField.required = false;
                newCategoryField.value = ''; // Clear the input when hidden
            }
        });

        // Hide new category input when other radio buttons are selected
        document.querySelectorAll('input[name="category"]:not(#new_category_radio)').forEach(radio => {
            radio.addEventListener('change', function() {
                const newCategoryInput = document.getElementById('newCategoryInput');
                const newCategoryField = document.getElementById('new_category');
                newCategoryInput.classList.add('hidden');
                newCategoryField.required = false;
                newCategoryField.value = '';
            });
        });
    </script>
</body>