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
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-3 text-center" style="width: 8%;">1</td>
                <td class="border border-gray-300 px-4 py-3" style="width: 32%;">Laptop Dell XPS 13</td>
                <td class="border border-gray-300 px-4 py-3" style="width: 30%;">Ahmad bin Ismail</td>
                <td class="border border-gray-300 px-4 py-3 text-center" style="width: 15%;">2024-01-15</td>
                <td class="border border-gray-300 px-4 py-3 text-center" style="width: 15%;">2024-01-22</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-3 text-center">2</td>
                <td class="border border-gray-300 px-4 py-3">Projektor Epson EB-X51</td>
                <td class="border border-gray-300 px-4 py-3">Siti Aminah binti Abdullah</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-02-01</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-02-03</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-3 text-center">3</td>
                <td class="border border-gray-300 px-4 py-3">Kamera DSLR Canon EOS 850D</td>
                <td class="border border-gray-300 px-4 py-3">Muhammad Hafiz bin Omar</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-02-10</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-02-17</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-3 text-center">4</td>
                <td class="border border-gray-300 px-4 py-3">Mikrofon Wireless Shure</td>
                <td class="border border-gray-300 px-4 py-3">Nurul Izzah binti Hassan</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-02-15</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-02-16</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-3 text-center">5</td>
                <td class="border border-gray-300 px-4 py-3">Tablet iPad Pro 12.9"</td>
                <td class="border border-gray-300 px-4 py-3">Khairul Anuar bin Razak</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-03-01</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-03-15</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-3 text-center">6</td>
                <td class="border border-gray-300 px-4 py-3">Skrin Projektor Mudah Alih</td>
                <td class="border border-gray-300 px-4 py-3">Farah Liyana binti Mohd</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-03-05</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-03-07</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-3 text-center">7</td>
                <td class="border border-gray-300 px-4 py-3">Pembesar Suara Bluetooth JBL</td>
                <td class="border border-gray-300 px-4 py-3">Amir Hamzah bin Yusof</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-03-10</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-03-11</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-3 text-center">8</td>
                <td class="border border-gray-300 px-4 py-3">Komputer Riba HP Pavilion</td>
                <td class="border border-gray-300 px-4 py-3">Zainab binti Ibrahim</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-03-15</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-03-29</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-3 text-center">9</td>
                <td class="border border-gray-300 px-4 py-3">Tripod Kamera Profesional</td>
                <td class="border border-gray-300 px-4 py-3">Azman bin Karim</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-04-01</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-04-03</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-3 text-center">10</td>
                <td class="border border-gray-300 px-4 py-3">Gimbal DJI OM 5</td>
                <td class="border border-gray-300 px-4 py-3">Nor Syahirah binti Ahmad</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-04-05</td>
                <td class="border border-gray-300 px-4 py-3 text-center">2024-04-12</td>
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

    // Updated PDF Export with text truncation and safer margins
    document.getElementById('exportPDF').addEventListener('click', function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Set document properties
        doc.setProperties({
            title: 'Smart Inventory Management System - Report',
            author: 'SIMS',
            subject: 'Inventory Report',
            keywords: 'inventory, report, management'
        });

        // Helper function to truncate text while maintaining readability
        function truncateText(text, width, fontSize) {
            doc.setFontSize(fontSize);
            if (doc.getStringUnitWidth(text) * fontSize > width) {
                while (doc.getStringUnitWidth(text + '...') * fontSize > width) {
                    text = text.slice(0, -1);
                }
                return text + '...';
            }
            return text;
        }

        // Add header with gradient-like styling
        doc.setFillColor(30, 64, 175);
        doc.rect(0, 0, 220, 40, 'F');
        
        // Add header text
        doc.setTextColor(255, 255, 255);
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(20);
        doc.text('Smart Inventory Management System', 105, 20, { align: 'center' });
        doc.setFontSize(14);
        doc.text('Laporan Inventori', 105, 30, { align: 'center' });

        // Add date and time with more left margin
        doc.setTextColor(100, 100, 100);
        doc.setFontSize(10);
        doc.text(`Tarikh: ${new Date().toLocaleDateString('ms-MY')}`, 35, 50);
        doc.text(`Masa: ${new Date().toLocaleTimeString('ms-MY')}`, 35, 57);

        // Get table data
        const table = document.getElementById('reportTable');
        const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent);
        const rows = Array.from(table.querySelectorAll('tbody tr')).map(row => 
            Array.from(row.querySelectorAll('td')).map(td => td.textContent)
        );

        // Improved table styling with safer margins
        const startY = 70;
        const margin = 35; // Further increased margins
        const pageWidth = doc.internal.pageSize.width;
        const tableWidth = pageWidth - (2 * margin);
        
        // Adjusted column widths with safer proportions
        const colWidths = [
            tableWidth * 0.07,  // ID column (7%)
            tableWidth * 0.40,  // Item name column (31%)
            tableWidth * 0.29,  // Borrower name column (29%)
            tableWidth * 0.12, // Start date (16.5%)
            tableWidth * 0.12  // End date (16.5%)
        ];

        // Maximum text widths for truncation (in mm)
        const maxWidths = [
            colWidths[0] - 2,    // ID
            colWidths[1] - 10,   // Item name
            colWidths[2] - 10,   // Borrower name
            colWidths[3] - 2,    // Start date
            colWidths[4] - 2     // End date
        ];

        // Draw table headers with background
        doc.setFillColor(241, 245, 249);
        doc.rect(margin, startY - 5, tableWidth, 12, 'F');
        
        doc.setFont('helvetica', 'bold');
        doc.setTextColor(71, 85, 105);
        doc.setFontSize(11);
        
        let currentX = margin;
        headers.forEach((header, i) => {
            const xPos = currentX + (i === 0 ? colWidths[i]/2 : 
                         i === 1 || i === 2 ? 8 : // Increased left padding for names
                         colWidths[i]/2);
            const align = i === 0 ? 'center' :
                         i === 1 || i === 2 ? 'left' :
                         'center';
            const truncatedHeader = truncateText(header, maxWidths[i], 11);
            doc.text(truncatedHeader, xPos, startY + 2, { align: align });
            currentX += colWidths[i];
        });

        // Draw table content
        let currentY = startY + 12;
        doc.setFont('helvetica', 'normal');
        doc.setTextColor(0, 0, 0);
        doc.setFontSize(10);

        rows.forEach((row, rowIndex) => {
            // Add new page if needed
            if (currentY > 270) {
                doc.addPage();
                currentY = 20;
                
                // Add header to new page with same styling
                doc.setFillColor(241, 245, 249);
                doc.rect(margin, currentY - 5, tableWidth, 12, 'F');
                
                doc.setFont('helvetica', 'bold');
                doc.setTextColor(71, 85, 105);
                doc.setFontSize(11);
                
                currentX = margin;
                headers.forEach((header, i) => {
                    const xPos = currentX + (i === 0 ? colWidths[i]/2 :
                                i === 1 || i === 2 ? 8 :
                                colWidths[i]/2);
                    const align = i === 0 ? 'center' :
                                i === 1 || i === 2 ? 'left' :
                                'center';
                    const truncatedHeader = truncateText(header, maxWidths[i], 11);
                    doc.text(truncatedHeader, xPos, currentY + 2, { align: align });
                    currentX += colWidths[i];
                });
                
                currentY += 12;
                doc.setFont('helvetica', 'normal');
                doc.setTextColor(0, 0, 0);
                doc.setFontSize(10);
            }

            // Alternate row background
            if (rowIndex % 2 === 1) {
                doc.setFillColor(249, 250, 251);
                doc.rect(margin, currentY - 5, tableWidth, 12, 'F');
            }

            // Draw row content with proper alignment and truncation
            currentX = margin;
            row.forEach((cell, i) => {
                const xPos = currentX + (i === 0 ? colWidths[i]/2 :
                            i === 1 || i === 2 ? 8 :
                            colWidths[i]/2);
                const align = i === 0 ? 'center' :
                            i === 1 || i === 2 ? 'left' :
                            'center';
                const truncatedCell = truncateText(String(cell), maxWidths[i], 10);
                doc.text(truncatedCell, xPos, currentY + 2, { align: align });
                currentX += colWidths[i];
            });
            currentY += 12;
        });

        // Add footer with better positioning
        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
            doc.setPage(i);
            doc.setFont('helvetica', 'italic');
            doc.setFontSize(8);
            doc.setTextColor(156, 163, 175);
            doc.text(
                `Muka Surat ${i} daripada ${pageCount}`, 
                pageWidth / 2, 
                doc.internal.pageSize.height - 15, 
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