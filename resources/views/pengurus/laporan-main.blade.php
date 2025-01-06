<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart Inventory Management System - Report</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <!-- JS Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

  <style>
    .gradient-header {
      background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
    }
    
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
      @apply border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      @apply px-3 py-1 mx-1 rounded-md border;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      @apply bg-blue-500 text-white border-blue-500;
    }
  </style>
</head>
<body class="flex bg-gray-100">
  <x-pengurus-sidebar />

  <div class="container mx-auto p-6 flex-1 p-8 ml-64 w-full">
    <div class="gradient-header rounded-lg shadow-lg p-6 mb-8 text-white">
      <h1 class="text-3xl font-bold">Smart Inventory Management System</h1>
      <p class="text-gray-100 mt-2">Laporan Inventori</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
      <table id="reportTable" class="w-full">
        <thead>
          <tr>
            <th class="px-4 py-3 bg-gray-100 font-semibold text-gray-600 border-b">ID</th>
            <th class="px-4 py-3 bg-gray-100 font-semibold text-gray-600 border-b">Nama Item</th>
            <th class="px-4 py-3 bg-gray-100 font-semibold text-gray-600 border-b">Peminjam</th>
            <th class="px-4 py-3 bg-gray-100 font-semibold text-gray-600 border-b">Tarikh Pinjam</th>
            <th class="px-4 py-3 bg-gray-100 font-semibold text-gray-600 border-b">Tarikh Pulang</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="border border-gray-300 px-4 py-2">1</td>
            <td class="border border-gray-300 px-4 py-2">Laptop</td>
            <td class="border border-gray-300 px-4 py-2">John Doe</td>
            <td class="border border-gray-300 px-4 py-2">2024-12-01</td>
            <td class="border border-gray-300 px-4 py-2">2024-12-10</td>
          </tr>
          <tr>
            <td class="border border-gray-300 px-4 py-2">2</td>
            <td class="border border-gray-300 px-4 py-2">Projector</td>
            <td class="border border-gray-300 px-4 py-2">Jane Smith</td>
            <td class="border border-gray-300 px-4 py-2">2024-12-02</td>
            <td class="border border-gray-300 px-4 py-2">2024-12-12</td>
          </tr>
        </tbody>
      </table>

      <div class="mt-6 flex space-x-4">
        <button id="exportPDF" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center shadow-md">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Eksport ke PDF
        </button>
        <button id="exportExcel" class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition duration-200 flex items-center shadow-md">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Eksport ke Excel
        </button>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      $('#reportTable').DataTable({
        responsive: true,
        dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lf>rtip',
        language: {
          search: "Search:",
          lengthMenu: "Show _MENU_ entries",
        },
        pageLength: 10,
        order: [[0, 'desc']]
      });
    });

    // Updated PDF Export
    document.getElementById('exportPDF').addEventListener('click', function() {
        // Initialize jsPDF
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Set document properties
        doc.setFont('helvetica');
        doc.setFontSize(12);

        // Add title
        doc.setFontSize(16);
        doc.text('Smart Inventory Management System', 105, 20, { align: 'center' });
        doc.setFontSize(14);
        doc.text('Detailed Report', 105, 30, { align: 'center' });
        
        // Get table data
        const table = document.getElementById('reportTable');
        const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent);
        const rows = Array.from(table.querySelectorAll('tbody tr')).map(row => 
            Array.from(row.querySelectorAll('td')).map(td => td.textContent)
        );

        // Set initial position
        let yPos = 40;
        const xStart = 10;
        const cellWidth = 35;
        const lineHeight = 10;

        // Draw headers
        doc.setFontSize(12);
        doc.setFont('helvetica', 'bold');
        headers.forEach((header, i) => {
            doc.text(header, xStart + (i * cellWidth), yPos);
        });

        // Draw content
        doc.setFont('helvetica', 'normal');
        yPos += lineHeight;

        rows.forEach(row => {
            // Check if we need a new page
            if (yPos > 280) {
                doc.addPage();
                yPos = 20;
            }

            row.forEach((cell, i) => {
                doc.text(String(cell), xStart + (i * cellWidth), yPos);
            });
            yPos += lineHeight;
        });

        // Save the PDF
        doc.save('inventory_report.pdf');
    });

    // Excel Export
    document.getElementById('exportExcel').addEventListener('click', () => {
      const table = document.getElementById("reportTable");
      const rows = Array.from(table.rows).map(row => Array.from(row.cells).map(cell => cell.innerText));

      const workbook = XLSX.utils.book_new();
      const worksheet = XLSX.utils.aoa_to_sheet(rows);

      // Apply custom styles
      worksheet["A1"].s = { font: { bold: true }, fill: { fgColor: { rgb: "DDEBF7" } } };
      worksheet["!cols"] = rows[0].map(() => ({ wch: 20 }));

      XLSX.utils.book_append_sheet(workbook, worksheet, "Report");
      XLSX.writeFile(workbook, "detailed_report.xlsx");
    });
  </script>
</body>
</html>