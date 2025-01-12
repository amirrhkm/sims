<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<body class="bg-gray-100">
  <x-pemohon-sidebar />

  <div class="container mx-auto p-6 flex-1 p-8 ml-64 w-full">
    <!-- Header -->
    <header class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Smart Inventory Management System</h1>
      <div class="flex items-center space-x-4">
        <input type="text" placeholder="Search..." class="border rounded px-4 py-2">
      </div>
    </header>

    <!-- Metrics Summary -->
    <div class="grid grid-cols-4 gap-4 mb-6">
      <div class="bg-blue-100 hover:bg-blue-200 p-4 rounded shadow flex items-center space-x-4">
        <i class="fas fa-box text-3xl text-blue-500"></i>
        <div>
          <h2 class="text-lg font-semibold">Jumlah Item</h2>
          <p class="text-xl font-bold" id="totalItems">{{ $totalItems }}</p>
        </div>
      </div>
      <div class="bg-green-100 hover:bg-green-200 p-4 rounded shadow flex items-center space-x-4">
        <i class="fas fa-check-circle text-3xl text-green-500"></i>
        <div>
          <h2 class="text-lg font-semibold">Item Dipinjam</h2>
          <p class="text-xl font-bold" id="itemsBorrowed">{{ $itemsBorrowed }}</p>
        </div>
      </div>
      <div class="bg-yellow-100 hover:bg-yellow-200 p-4 rounded shadow flex items-center space-x-4">
        <i class="fas fa-exclamation-triangle text-3xl text-yellow-500"></i>
        <div>
          <h2 class="text-lg font-semibold">Item Tertunggak</h2>
          <p class="text-xl font-bold" id="overdueItems">{{ $overdueItems }}</p>
        </div>
      </div>
      <div class="bg-purple-100 hover:bg-purple-200 p-4 rounded shadow flex items-center space-x-4">
        <i class="fas fa-users text-3xl text-purple-500"></i>
        <div>
          <h2 class="text-lg font-semibold">Pengguna Aktif</h2>
          <p class="text-xl font-bold" id="activeUsers">{{ $activeUsers }}</p>
        </div>
      </div>
    </div>

    <!-- Borrowing Status and Activity Log -->
    <div class="grid grid-cols-2 gap-6">
      <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Status Pinjam</h2>
        <canvas id="borrowingChart" class="w-full h-48"></canvas>
      </div>
      <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Aktiviti Terbaru</h2>
        <table id="activityLog" class="table-auto w-full border-collapse border border-gray-200">
          <thead>
            <tr class="bg-gray-100">
              <th class="border px-4 py-2">Tarikh</th>
              <th class="border px-4 py-2">Pengguna</th>
              <th class="border px-4 py-2">Tindakan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border px-4 py-2">Dec 30, 2024</td>
              <td class="border px-4 py-2">John Doe</td>
              <td class="border px-4 py-2">Borrowed "Laptop HP-15"</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  <!-- Modal -->
  <div id="addItemModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/3">
      <h2 class="text-lg font-semibold mb-4">Tambah Item Baru</h2>
      <form id="addItemForm">
        <div class="mb-4">
          <label class="block mb-2 text-sm font-medium">Nama Item</label>
          <input type="text" class="border px-4 py-2 w-full rounded" required>
        </div>
        <div class="flex justify-end space-x-2">
          <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Chart Initialization
    const ctx = document.getElementById('borrowingChart').getContext('2d');
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Tersedia', 'Dipinjam', 'Tertunggak'],
        datasets: [{
          data: [
            {{ $availableItems }},
            {{ $itemsBorrowed }},
            {{ $overdueItems }}
          ],
          backgroundColor: ['#4CAF50', '#FF9800', '#F44336'],
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom' }
        }
      }
    });

    // DataTable Initialization
    $(document).ready(function () {
      $('#activityLog').DataTable();
    });

    // Modal Logic
    document.getElementById('addItemBtn').addEventListener('click', () => {
      document.getElementById('addItemModal').classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', () => {
      document.getElementById('addItemModal').classList.add('hidden');
    });
  </script>
</body>