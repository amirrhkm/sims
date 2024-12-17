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
                <h1 class="text-2xl font-semibold text-gray-900 pb-4">Maklumat Pengguna</h1>
                
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th width="40%" class="text-left">Nama</th>
                                                    <td>{{ $user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">E-mel</th>
                                                    <td>{{ $user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">Peranan</th>
                                                    <td>{{ ucfirst($user->role) }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">Jawatan</th>
                                                    <td>{{ $user->position }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">Gred</th>
                                                    <td>{{ $user->grade }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">Jabatan</th>
                                                    <td>{{ $user->department }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">Bahagian</th>
                                                    <td>{{ $user->section }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-left">No. Telefon</th>
                                                    <td>{{ $user->phone_number }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Add notice about contacting admin -->
                                    <div class="mt-4 p-4 bg-gray-50 rounded-lg text-sm text-gray-600">
                                        <p>Sekiranya terdapat maklumat yang tidak tepat, sila hubungi pentadbir sistem di <a href="mailto:admin@sims.com" class="text-blue-600 hover:underline">admin@sims.com</a></p>
                                    </div>
                                    <div class="mt-3 text-red-500 font-semibold hover:text-red-600">
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>