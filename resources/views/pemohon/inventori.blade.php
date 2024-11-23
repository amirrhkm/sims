

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        <x-pemohon-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-2xl font-semibold text-gray-900">Inventori</h1>
                
                <div class="navigation-buttons flex gap-4 mt-6 w-1/2">
                    <a href="/pemohon/inventori/borang-permohonan" 
                        class="flex-1 bg-gray-800 text-white text-center font-semibold py-4 px-1 rounded-xl shadow-lg hover:bg-gray-900 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 ease-out">
                        Permohonan Baru
                    </a>
                    <a href="/pemohon/inventori/lihat-permohonan" 
                        class="flex-1 bg-gray-800 text-white text-center font-semibold py-4 px-1 rounded-xl shadow-lg hover:bg-gray-900 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 ease-out">
                        Lihat Permohonan
                    </a>
                    <a href="/pemohon/inventori/lihat-inventori" 
                        class="flex-1 bg-gray-800 text-white text-center font-semibold py-4 px-1 rounded-xl shadow-lg hover:bg-gray-900 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 ease-out">
                        Lihat Inventori
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>