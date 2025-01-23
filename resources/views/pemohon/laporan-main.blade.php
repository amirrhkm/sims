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
            <th class="px-4 py-3 bg-gray-100 font-semibold text-gray-600 border-b">Status</th>
          </tr>
        </thead>
        <tbody>
            @foreach($borrowingRequests as $request)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-3 text-center">{{ $request['id'] }}</td>
                    <td class="border border-gray-300 px-4 py-3">{{ $request['nama_item'] }}</td>
                    <td class="border border-gray-300 px-4 py-3">{{ $request['peminjam'] }}</td>
                    <td class="border border-gray-300 px-4 py-3 text-center">{{ $request['tarikh_pinjam'] }}</td>
                    <td class="border border-gray-300 px-4 py-3 text-center">{{ $request['tarikh_pulang'] }}</td>
                    <td class="border border-gray-300 px-4 py-3 text-center">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            @if($request['status'] === 'approved') bg-green-100 text-green-800
                            @elseif($request['status'] === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($request['status']) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>

      <div class="mt-6 flex space-x-4">
        <button id="exportPDF" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center shadow-md">
          <svg class="w-5 h-5 mr-2 export-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <svg class="w-5 h-5 mr-2 loading-icon hidden animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
          </svg>
          <span class="button-text">Eksport ke PDF</span>
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
      const table = $('#reportTable').DataTable({
        responsive: true,
        dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lf>rtip',
        language: {
          search: "Cari:",
          lengthMenu: "Papar _MENU_ rekod",
          info: "Memaparkan _START_ hingga _END_ daripada _TOTAL_ rekod",
          paginate: {
            first: "Pertama",
            last: "Terakhir",
            next: "Seterusnya",
            previous: "Sebelumnya"
          }
        },
        pageLength: 10,
        order: [[0, 'asc']]
      });
    });

    document.getElementById('exportPDF').addEventListener('click', async function() {
        const button = this;
        const buttonText = button.querySelector('.button-text');
        const exportIcon = button.querySelector('.export-icon');
        const loadingIcon = button.querySelector('.loading-icon');

        try {
            button.disabled = true;
            exportIcon.classList.add('hidden');
            loadingIcon.classList.remove('hidden');
            buttonText.textContent = 'Menjana PDF...';

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            // Define column widths (total should be around 170 to fit on page)
            const colWidths = [15, 45, 35, 25, 25, 25];
            const maxWidths = [6, 20, 15, 10, 10, 10]; // Max characters per column
            
            // Header
            doc.setFillColor(30, 64, 175);
            doc.rect(0, 0, 220, 40, 'F');
            
            doc.setTextColor(255, 255, 255);
            doc.setFont('helvetica', 'bold');
            doc.setFontSize(20);
            doc.text('Smart Inventory Management System', 105, 20, { align: 'center' });
            doc.setFontSize(14);
            doc.text('Laporan Inventori', 105, 30, { align: 'center' });

            // Table headers
            let currentY = 50;
            const margin = 20;
            
            doc.setFillColor(241, 245, 249);
            doc.rect(margin, currentY - 5, 170, 10, 'F');
            
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(71, 85, 105);
            doc.setFontSize(10);
            
            let currentX = margin;
            const headers = ['ID', 'Nama Item', 'Peminjam', 'Tarikh Pinjam', 'Tarikh Pulang', 'Status'];
            headers.forEach((header, i) => {
                doc.text(header, currentX + 2, currentY);
                currentX += colWidths[i];
            });
            
            // Table content
            doc.setFont('helvetica', 'normal');
            doc.setTextColor(0, 0, 0);
            currentY += 10;

            // Get table data
            const rows = Array.from(document.querySelectorAll('#reportTable tbody tr'));
            
            for (const row of rows) {
                if (currentY > 270) {
                    doc.addPage();
                    currentY = 20;
                    
                    // Add headers to new page
                    doc.setFillColor(241, 245, 249);
                    doc.rect(margin, currentY - 5, 170, 10, 'F');
                    
                    doc.setFont('helvetica', 'bold');
                    doc.setTextColor(71, 85, 105);
                    currentX = margin;
                    headers.forEach((header, i) => {
                        doc.text(header, currentX + 2, currentY);
                        currentX += colWidths[i];
                    });
                    
                    doc.setFont('helvetica', 'normal');
                    doc.setTextColor(0, 0, 0);
                    currentY += 10;
                }

                const cells = Array.from(row.querySelectorAll('td'));
                currentX = margin;
                
                cells.forEach((cell, i) => {
                    let text = cell.innerText.trim();
                    // Truncate text if too long
                    if (text.length > maxWidths[i]) {
                        text = text.substring(0, maxWidths[i]) + '...';
                    }
                    doc.text(text, currentX + 2, currentY);
                    currentX += colWidths[i];
                });
                
                currentY += 7;
                
                // Add light gray line between rows
                doc.setDrawColor(229, 231, 235);
                doc.line(margin, currentY - 3, margin + 170, currentY - 3);
            }

            // Add footer with page numbers
            const pageCount = doc.internal.getNumberOfPages();
            for (let i = 1; i <= pageCount; i++) {
                doc.setPage(i);
                doc.setFont('helvetica', 'italic');
                doc.setFontSize(8);
                doc.setTextColor(156, 163, 175);
                doc.text(
                    `Muka Surat ${i} daripada ${pageCount}`, 
                    105, 
                    doc.internal.pageSize.height - 10, 
                    { align: 'center' }
                );
            }

            // Save the PDF
            doc.save('laporan_inventori.pdf');

        } catch (error) {
            console.error('Error generating PDF:', error);
            alert('Ralat semasa menjana PDF. Sila cuba lagi.');
        } finally {
            button.disabled = false;
            exportIcon.classList.remove('hidden');
            loadingIcon.classList.add('hidden');
            buttonText.textContent = 'Eksport ke PDF';
        }
    });

    // Excel Export
    document.getElementById('exportExcel').addEventListener('click', () => {
      const table = document.getElementById("reportTable");
      const ws_data = [
        ['ID', 'Nama Item', 'Peminjam', 'Tarikh Pinjam', 'Tarikh Pulang', 'Status']
      ];

      // Get all rows except header
      const rows = Array.from(table.querySelectorAll('tbody tr'));
      
      rows.forEach(row => {
        const rowData = Array.from(row.querySelectorAll('td')).map(cell => {
          // For status column, get the text content without extra spaces
          if (cell.querySelector('.rounded-full')) {
            return cell.querySelector('.rounded-full').textContent.trim();
          }
          return cell.textContent.trim();
        });
        ws_data.push(rowData);
      });

      const wb = XLSX.utils.book_new();
      const ws = XLSX.utils.aoa_to_sheet(ws_data);

      // Add some styling
      const headerStyle = {
        font: { bold: true },
        fill: { fgColor: { rgb: "DDEBF7" } },
        alignment: { horizontal: "center" }
      };

      // Apply styles to header row
      const range = XLSX.utils.decode_range(ws['!ref']);
      for (let C = range.s.c; C <= range.e.c; ++C) {
        const address = XLSX.utils.encode_cell({ r: 0, c: C });
        ws[address].s = headerStyle;
      }

      XLSX.utils.book_append_sheet(wb, ws, "Laporan Inventori");
      XLSX.writeFile(wb, "laporan_inventori.xlsx");
    });
  </script>
</body>
</html>