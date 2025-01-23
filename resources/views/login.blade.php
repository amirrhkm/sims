<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Inventory</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add custom styles -->
    <style>
        .gradient-background {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
    </style>
</head>
<body class="min-h-screen gradient-background flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <!-- Alert Messages -->
        @if (session('username_error'))
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-md" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="font-bold">Nama Pengguna Tidak Dijumpai</p>
                        <p class="text-sm">Nama pengguna yang anda masukkan tiada dalam sistem kami. Sila cuba lagi.</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('password_error'))
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-md" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="font-bold">Kata Laluan Tidak Sah</p>
                        <p class="text-sm">Kata laluan yang anda masukkan tidak sah. Sila cuba lagi.</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('inactive_error'))
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-md" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="font-bold">Akun Tidak Aktif</p>
                        <p class="text-sm">Akun anda saat ini tidak aktif. Sila hubungi administrator.</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-md" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="font-bold">Login Error</p>
                        <ul class="text-sm list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Login Card -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="p-6 bg-white">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Selamat Kembali</h1>
                    <p class="text-gray-600">Smart Inventory Management System</p>
                </div>
            </div>

            <!-- Login Form -->
            <div class="p-6 space-y-6 bg-gray-50">
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Username
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 outline-none"
                            placeholder="Masukkan username"
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Kata Laluan
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 outline-none"
                            placeholder="Masukkan kata laluan"
                        >
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition duration-200"
                    >
                        Sign In
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                <p class="text-center text-sm text-gray-600">
                    Protected by SIMS
                </p>
            </div>
        </div>
    </div>
</body>
</html>