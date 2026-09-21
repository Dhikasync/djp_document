<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Dokumen</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4 antialiased">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 w-full max-w-2xl relative">
        <!-- Back Button -->
        <a href="/" class="inline-flex items-center gap-2 text-slate-500 hover:text-[#172052] transition-colors mb-6 font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Dashboard
        </a>

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Upload Dokumen</h1>

        <form action="{{ route('document.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Drag and drop area -->
            <div class="border-2 border-dashed border-gray-300 rounded-xl p-10 text-center hover:bg-gray-50 transition-colors relative cursor-pointer" id="drop-area">
                <!-- Input file ditumpuk transparan di atas kotak -->
                <input type="file" id="file-input" name="documents[]" multiple accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14 mx-auto text-gray-400 mb-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                <p class="text-gray-700 font-medium text-lg">Pilih file atau seret ke sini</p>
                <p class="text-gray-400 text-sm mt-2">Format yang didukung: PDF, DOC, DOCX</p>
            </div>

            <!-- List Files -->
            <div id="file-list-container" class="mt-8 hidden">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Daftar File (<span id="file-count">0</span>)</h2>
                    <button type="button" id="btn-delete-all" class="text-sm text-red-500 hover:text-red-700 font-semibold px-2 py-1 rounded hover:bg-red-50 transition-colors">Hapus Semua</button>
                </div>
                <ul id="file-list" class="space-y-3">
                    <!-- Item file akan dimunculkan di sini menggunakan Javascript -->
                </ul>
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full bg-[#172052] hover:bg-[#10173b] text-white font-semibold py-3.5 rounded-xl transition duration-200 shadow-sm">
                    Upload Dokumen
                </button>
            </div>
        </form>

        <!-- Tombol Reset Server -->
        <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="text-sm">
                <p class="font-medium text-gray-700">Manajemen Penyimpanan</p>
                <p class="text-gray-400">Hapus seluruh dokumen yang sudah tersimpan di server.</p>
            </div>
            <form id="clear-form" action="{{ route('document.clear') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-red-500 hover:text-red-700 font-semibold px-4 py-2 bg-red-50 hover:bg-red-100 rounded-lg transition-colors border border-red-100 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    Kosongkan Server
                </button>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#172052'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#172052'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    text: "{{ $errors->first() }}",
                    confirmButtonColor: '#172052'
                });
            @endif

            const clearForm = document.getElementById('clear-form');
            if (clearForm) {
                clearForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Seluruh dokumen yang ada di server akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#172052',
                        confirmButtonText: 'Ya, hapus semua!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            clearForm.submit();
                        }
                    });
                });
            }

            const fileInput = document.getElementById('file-input');
            const fileListContainer = document.getElementById('file-list-container');
            const fileList = document.getElementById('file-list');
            const fileCount = document.getElementById('file-count');
            const btnDeleteAll = document.getElementById('btn-delete-all');
            
            // Kita menggunakan DataTransfer untuk memanipulasi FileList pada input file
            let dt = new DataTransfer();

            fileInput.addEventListener('change', function(e) {
                // Tambahkan file baru tanpa menghapus file lama yang sudah dipilih
                const newFiles = this.files;
                for (let i = 0; i < newFiles.length; i++) {
                    const file = newFiles[i];
                    dt.items.add(file);
                }
                updateFileInputAndUI();
            });

            function updateFileInputAndUI() {
                // Update elemen <input type="file"> dengan DataTransfer terbaru
                fileInput.files = dt.files;
                
                // Update UI Counter & Visibility
                fileCount.textContent = dt.files.length;
                if (dt.files.length > 0) {
                    fileListContainer.classList.remove('hidden');
                } else {
                    fileListContainer.classList.add('hidden');
                }

                // Kosongkan list HTML saat ini
                fileList.innerHTML = ''; 

                // Render list file
                Array.from(dt.files).forEach((file, index) => {
                    const li = document.createElement('li');
                    li.className = 'flex items-center justify-between p-3.5 bg-gray-50 border border-gray-200 rounded-xl';
                    
                    const fileInfo = document.createElement('div');
                    fileInfo.className = 'flex items-center gap-3 overflow-hidden';
                    
                    // Ganti warna icon tergantung jenis file
                    const isPdf = file.name.toLowerCase().endsWith('.pdf');
                    const iconColor = isPdf ? 'text-red-500' : 'text-blue-500';
                    
                    const iconHtml = `<svg class="w-6 h-6 shrink-0 ${iconColor}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>`;

                    // Kalkulasi ukuran file
                    const sizeInKb = (file.size / 1024).toFixed(1);

                    fileInfo.innerHTML = iconHtml + `
                        <div class="flex flex-col truncate">
                            <span class="text-[15px] font-medium text-gray-700 truncate">${file.name}</span>
                            <span class="text-[12px] text-gray-400">${sizeInKb} KB</span>
                        </div>
                    `;
                    
                    // Tombol Hapus 1 per 1
                    const deleteBtn = document.createElement('button');
                    deleteBtn.type = 'button';
                    deleteBtn.className = 'text-gray-400 hover:text-red-500 p-2 rounded-lg hover:bg-red-50 transition-colors shrink-0';
                    deleteBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>';
                    
                    deleteBtn.onclick = function(e) {
                        e.preventDefault();
                        removeFile(index);
                    };

                    li.appendChild(fileInfo);
                    li.appendChild(deleteBtn);
                    fileList.appendChild(li);
                });
            }

            function removeFile(indexToRemove) {
                const newDt = new DataTransfer();
                const files = dt.files;
                
                // Pindahkan semua file KECUALI index yang dihapus ke object baru
                for (let i = 0; i < files.length; i++) {
                    if (i !== indexToRemove) {
                        newDt.items.add(files[i]);
                    }
                }
                dt = newDt; // Update DataTransfer
                updateFileInputAndUI();
            }

            btnDeleteAll.addEventListener('click', function(e) {
                e.preventDefault();
                dt = new DataTransfer(); // Reset menjadi kosong
                updateFileInputAndUI();
            });
        });
    </script>
</body>
</html>

