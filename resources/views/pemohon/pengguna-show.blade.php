<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex">
        <!-- Sidebar -->
        @if(Auth::user()->role === 'pengurus')
            <x-pengurus-sidebar />
        @else
            <x-pemohon-sidebar />
        @endif

        <!-- Main Content -->
        <div class="flex-1 p-8 ml-64 w-full">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Maklumat Pengguna</h1>
                    <p class="text-gray-500 mt-2">Profil dan maklumat terperinci pengguna</p>
                </div>
                
                <!-- User Profile Card -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- User Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white p-3 rounded-full">
                                <i class="fas fa-user text-blue-500 text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-white">{{ $user->name }}</h2>
                                <p class="text-blue-100">{{ ucfirst($user->role) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- User Details -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Contact Information -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Maklumat Hubungan</h3>
                                
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-envelope text-gray-400 w-5"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">E-mel</p>
                                        <p class="text-gray-900">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-phone text-gray-400 w-5"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">No. Telefon</p>
                                        <p class="text-gray-900">{{ $user->phone_number }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Work Information -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Maklumat Pekerjaan</h3>
                                
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-briefcase text-gray-400 w-5"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Jawatan</p>
                                        <p class="text-gray-900">{{ $user->position }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-star text-gray-400 w-5"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Gred</p>
                                        <p class="text-gray-900">{{ $user->grade }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-building text-gray-400 w-5"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Jabatan</p>
                                        <p class="text-gray-900">{{ $user->department }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-sitemap text-gray-400 w-5"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Bahagian</p>
                                        <p class="text-gray-900">{{ $user->section }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notice Box -->
                        <div class="mt-8 bg-blue-50 rounded-lg p-4">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-info-circle text-blue-500"></i>
                                <p class="text-sm text-blue-600">
                                    Sekiranya terdapat maklumat yang tidak tepat, sila hubungi pentadbir sistem di 
                                    <a href="mailto:admin@sims.com" class="font-medium hover:underline">admin@sims.com</a>
                                </p>
                            </div>
                        </div>

                        <!-- Back Button -->
                        <div class="mt-6 flex justify-end">
                            <a href="{{ url()->previous() }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-colors duration-200">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>