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
  <x-pemohon-sidebar />

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
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Set document properties and styling
        doc.setProperties({
            title: 'Smart Inventory Management System - Report',
            author: 'SIMS',
            subject: 'Inventory Report',
            keywords: 'inventory, report, management'
        });

        // Add header with gradient-like styling
        doc.setFillColor(30, 64, 175); // Blue-600
        doc.rect(0, 0, 220, 40, 'F');
        
        // Add header text
        doc.setTextColor(255, 255, 255);
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(20);
        doc.text('Smart Inventory Management System', 105, 20, { align: 'center' });
        doc.setFontSize(14);
        doc.text('Laporan Inventori', 105, 30, { align: 'center' });

        // Add date and time
        doc.setTextColor(100, 100, 100);
        doc.setFontSize(10);
        doc.text(`Tarikh: ${new Date().toLocaleDateString('ms-MY')}`, 20, 50);
        doc.text(`Masa: ${new Date().toLocaleTimeString('ms-MY')}`, 20, 57);

        // Get table data
        const table = document.getElementById('reportTable');
        const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent);
        const rows = Array.from(table.querySelectorAll('tbody tr')).map(row => 
            Array.from(row.querySelectorAll('td')).map(td => td.textContent)
        );

        // Table styling
        const startY = 70;
        const cellPadding = 5;
        const lineHeight = 10;
        const colWidth = 38;

        // Draw table headers with background
        doc.setFillColor(241, 245, 249); // Gray-100
        doc.rect(10, startY - 5, doc.internal.pageSize.width - 20, lineHeight + 5, 'F');
        
        doc.setFont('helvetica', 'bold');
        doc.setTextColor(71, 85, 105); // Gray-600
        doc.setFontSize(11);
        
        headers.forEach((header, i) => {
            doc.text(header, 15 + (i * colWidth), startY + 2);
        });

        // Draw table content
        let currentY = startY + lineHeight;
        doc.setFont('helvetica', 'normal');
        doc.setTextColor(0, 0, 0);
        doc.setFontSize(10);

        rows.forEach((row, rowIndex) => {
            // Add new page if needed
            if (currentY > 270) {
                doc.addPage();
                currentY = 20;
                
                // Add header to new page
                doc.setFillColor(241, 245, 249);
                doc.rect(10, currentY - 5, doc.internal.pageSize.width - 20, lineHeight + 5, 'F');
                
                doc.setFont('helvetica', 'bold');
                doc.setTextColor(71, 85, 105);
                doc.setFontSize(11);
                
                headers.forEach((header, i) => {
                    doc.text(header, 15 + (i * colWidth), currentY + 2);
                });
                
                currentY += lineHeight;
                doc.setFont('helvetica', 'normal');
                doc.setTextColor(0, 0, 0);
                doc.setFontSize(10);
            }

            // Alternate row background
            if (rowIndex % 2 === 1) {
                doc.setFillColor(249, 250, 251); // Gray-50
                doc.rect(10, currentY - 5, doc.internal.pageSize.width - 20, lineHeight + 5, 'F');
            }

            row.forEach((cell, i) => {
                doc.text(String(cell), 15 + (i * colWidth), currentY + 2);
            });
            currentY += lineHeight;
        });

        // Add footer
        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
            doc.setPage(i);
            doc.setFont('helvetica', 'italic');
            doc.setFontSize(8);
            doc.setTextColor(156, 163, 175); // Gray-400
            doc.text(
                `Muka Surat ${i} daripada ${pageCount}`, 
                doc.internal.pageSize.width / 2, 
                doc.internal.pageSize.height - 10, 
                { align: 'center' }
            );
        }

        // Save the PDF
        doc.save('laporan_inventori.pdf');
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