<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        <x-pengurus-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-2xl mx-auto">
                <!-- Header -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Tambah Pengguna Baru</h2>
                </div>

                <!-- Form -->
                <form action="{{ route('pengurus.pengguna-add') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
                    @csrf
                    
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                        <input type="text" name="name" id="name" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                               required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" id="email" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                               required>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Kata Laluan</label>
                        <input type="password" name="password" id="password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                               required minlength="8">
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Peranan</label>
                        <select name="role" id="role" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                required>
                            <option value="">Pilih Peranan</option>
                            <option value="pemohon">Pemohon</option>
                            <option value="pengurus">Pengurus</option>
                        </select>
                    </div>

                    <!-- Position -->
                    <div class="mb-4">
                        <label for="position" class="block text-gray-700 text-sm font-bold mb-2">Jawatan</label>
                        <input type="text" name="position" id="position" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                               required>
                    </div>

                    <!-- Grade -->
                    <div class="mb-4">
                        <label for="grade" class="block text-gray-700 text-sm font-bold mb-2">Gred</label>
                        <input type="text" name="grade" id="grade" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                               required>
                    </div>

                    <!-- Department Dropdown -->
                    <div class="mb-4">
                        <label for="department" class="block text-gray-700 text-sm font-bold mb-2">Jabatan</label>
                        <select name="department" id="department" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                required
                                onchange="updateSections()">
                            <option value="">Pilih Jabatan</option>
                            <option value="Bahagian Korporat">Bahagian Korporat</option>
                            <option value="Bahagian Khidmat Pengurusan">Bahagian Khidmat Pengurusan</option>
                            <option value="Unit Integriti">Unit Integriti</option>
                            <option value="Bahagian Rancangan Fizikal Negara">Bahagian Rancangan Fizikal Negara</option>
                            <option value="Bahagian Perancangan Wilayah">Bahagian Perancangan Wilayah</option>
                            <option value="Bahagian Rancangan Pembangunan">Bahagian Rancangan Pembangunan</option>
                            <option value="Bahagian Penyelidikan dan Pembangunan">Bahagian Penyelidikan dan Pembangunan</option>
                            <option value="Bahagian Perundangan dan Kawal Selia Perancangan">Bahagian Perundangan dan Kawal Selia Perancangan</option>
                            <option value="Bahagian Maklumat Gunatanah Negara">Bahagian Maklumat Gunatanah Negara</option>
                        </select>
                    </div>

                    <!-- Section Dropdown -->
                    <div class="mb-4">
                        <label for="section" class="block text-gray-700 text-sm font-bold mb-2">Seksyen</label>
                        <select name="section" id="section" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                required>
                            <option value="">Pilih Seksyen/Unit</option>
                        </select>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-6">
                        <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Nombor Telefon</label>
                        <input type="text" name="phone_number" id="phone_number" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                               placeholder="+60123456789" required>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('pengurus.pengguna') }}" 
                           class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors duration-200">
                            Kembali
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    const departmentSections = {
        'Bahagian Korporat': [
            'Pejabat Pengarah Korporat',
            'Unit Kualiti, Keurusetiaan dan Penyelarasan',
            'Unit Komunikasi Korporat dan Hubungan Awam',
            'Unit Hubungan Antarabangsa'
        ],
        'Bahagian Khidmat Pengurusan': [
            'Pejabat Pengarah Khidmat Pengurusan',
            'Seksyen Pentadbiran',
            'Seksyen Kewangan',
            'Seksyen Sumber Manusia',
            'Seksyen Teknologi Maklumat'
        ],
        'Unit Integriti': [
            'Pejabat Ketua Unit Integriti',
            'Seksyen Pengesanan, Pengesahan dan Tatatertib',
            'Seksyen Pengukuhan Integriti, Pengurusan Aduan, Tadbir Urus dan Pemantauan'
        ],
        'Bahagian Rancangan Fizikal Negara': [
            'Pejabat Pengarah Rancangan Fizikal Negara',
            'Unit Rancangan Fizikal Negara',
            'Unit Dasar Perbandaran Negara',
            'Unit Dasar Perancangan Fizikal Desa Negara',
            'Unit Pembangunan Tanah Bersepakat/Urusetia Majlis Perancang Fizikal Negara'
        ],
        'Bahagian Perancangan Wilayah': [
            'Pejabat Pengarah Perancangan Wilayah',
            'Unit Urusetia Jawatankuasa Perancangan Wilayah',
            'Unit Rancangan Wilayah',
            'Unit Projek Berkepentingan Nasional'
        ],
        'Bahagian Rancangan Pembangunan': [
            'Pejabat Projek Pengarah Zon Tengah',
            'Unit Rancangan Pembangunan 1',
            'Unit Malaysia Urban Observatory (MUO)',
            'Pusat Perancangan Bandar Pintar (PLAN-BP)',
            'Unit Rancangan Pembangunan 4',
            'Unit Rancangan Pembangunan 5',
            'Unit Pemantauan / Unit Penyelarasan Maklumat dan Perancangan',
            'Unit Pentadbiran'
        ],
        'Bahagian Penyelidikan dan Pembangunan': [
            'Pejabat Pengarah Penyelidikan dan Pembangunan',
            'Unit Penyelidikan Gunatanah, Industri, Perniagaan, Perumahan, Kemudahan Sosial, Infrastruktur dan Utiliti Tanah',
            'Unit Alam Sekitar dan Pengurusan Risiko',
            'Unit Metodologi Perancangan',
            'Unit Penilaian Dasar dan Penyelidikan Antarabangsa',
            'Unit Morfologi, Rekabentuk dan Warisan Bandar (1MYC/NBOS)',
            'Unit Kemampanan dan Bandar Selamat (NKRA)'
        ],
        'Bahagian Perundangan dan Kawal Selia Perancangan': [
            'Pejabat Pengarah Perundangan dan Kawal Selia Perancangan',
            'Unit Khidmat Nasihat Perancangan',
            'Unit Kawal Selia Perancangan',
            'Unit Gubalan Teknikal'
        ],
        'Bahagian Maklumat Gunatanah Negara': [
            'Pejabat Pengarah Maklumat Gunatanah Negara',
            'Unit Maklumat Gunatanah',
            'Unit Khidmat Pengguna'
        ]
    };

    function updateSections() {
        const departmentSelect = document.getElementById('department');
        const sectionSelect = document.getElementById('section');
        const selectedDepartment = departmentSelect.value;
        
        // Clear current options
        sectionSelect.innerHTML = '<option value="">Pilih Seksyen/Unit</option>';
        
        // Add new options based on selected department
        if (selectedDepartment && departmentSections[selectedDepartment]) {
            departmentSections[selectedDepartment].forEach(section => {
                const option = document.createElement('option');
                option.value = section;
                option.textContent = section;
                sectionSelect.appendChild(option);
            });
        }
    }

    // For edit form, set initial values
    @if(isset($user))
    window.onload = function() {
        document.getElementById('department').value = "{{ $user->department }}";
        updateSections();
        document.getElementById('section').value = "{{ $user->section }}";
    }
    @endif
    </script>
</body>
</rewritten_file>
