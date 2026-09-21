<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unduh Dokumen</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('/images/background.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="relative flex items-center justify-center min-h-screen bg-[#f8f9fa] antialiased overflow-hidden font-poppins">
    
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/background.png') }}" alt="Background" class="w-full h-full object-cover opacity-90">
    </div>

    <!-- Top Left Logos -->
    <div class="absolute top-6 left-6 lg:top-10 lg:left-10 flex items-center gap-3 z-10">
        <img src="{{ asset('images/Logo_kementerian_keuangan_republik_indonesia.png') }}" alt="Kementerian Keuangan" class="h-8 md:h-[2.5rem] w-auto object-contain">
        <div class="h-7 md:h-10 w-[1.5px] bg-[#293d7c]/60"></div>
        <img src="{{ asset('images/logo_djp.png') }}" alt="DJP" class="h-16 md:h-[5.5rem] w-auto object-contain -ml-3 md:-ml-5">
    </div>

    <!-- Language Dropdown -->
    <div class="absolute top-6 right-6 lg:top-10 lg:right-10 z-30">
        <!-- Trigger -->
        <button id="lang-dropdown-btn" class="flex items-center gap-2 md:gap-2.5 bg-white px-3 md:px-4 py-2 md:py-2.5 rounded-full shadow-[0_4px_16px_rgba(0,0,0,0.06)] border border-gray-50 focus:outline-none transition-all cursor-pointer">
            <!-- ID Flag -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36" class="w-6 h-6 md:w-7 md:h-7 rounded-full shadow-[0_0_2px_rgba(0,0,0,0.2)] object-cover">
              <path fill="#EEE" d="M0 18c0 9.941 8.059 18 18 18s18-8.059 18-18S27.941 0 18 0 0 8.059 0 18z"/>
              <path fill="#ED2939" d="M0 18C0 8.059 8.059 0 18 0s18 8.059 18 18H0z"/>
            </svg>
            <span class="text-[#172052] font-semibold text-sm md:text-[15px] ml-1">ID</span>
            <svg id="lang-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-[1.1rem] md:h-[1.1rem] text-[#172052] ml-1 transition-transform duration-300">
              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div id="lang-dropdown-menu" class="absolute right-0 mt-3 w-[12rem] bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-gray-100 p-2 flex flex-col gap-1 opacity-0 invisible transition-all duration-200 transform origin-top-right scale-95">
            <!-- Item 1 (Active) -->
            <a href="#" class="flex items-center gap-3.5 px-3.5 py-3 bg-[#e6e9f0] rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36" class="w-6 h-6 rounded-full shadow-[0_0_2px_rgba(0,0,0,0.2)] object-cover shrink-0">
                  <path fill="#EEE" d="M0 18c0 9.941 8.059 18 18 18s18-8.059 18-18S27.941 0 18 0 0 8.059 0 18z"/>
                  <path fill="#ED2939" d="M0 18C0 8.059 8.059 0 18 0s18 8.059 18 18H0z"/>
                </svg>
                <span class="text-[#172052] font-semibold text-[15px]">Indonesia</span>
            </a>
            
            <!-- Item 2 -->
            <a href="/upload" class="flex items-center gap-3.5 px-3.5 py-3 hover:bg-gray-50 rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36" class="w-6 h-6 rounded-full shadow-[0_0_2px_rgba(0,0,0,0.2)] object-cover shrink-0">
                  <path fill="#EEE" d="M0 18c0 9.941 8.059 18 18 18s18-8.059 18-18S27.941 0 18 0 0 8.059 0 18z"/>
                  <path fill="#DD2E44" d="M0 14h36v2H0zm0 4h36v2H0zm0 4h36v2H0zm2.222 4h31.556v2H2.222zm4.195 4h23.167v2H6.417zM18 0c-3.141 0-6.096.811-8.625 2h21.25c-2.529-1.189-5.484-2-8.625-2zM4.153 4h27.695v2H4.153zM1.01 8h33.98v2H1.01zm-.79 4h35.56v2H.22z"/>
                  <path fill="#0033A0" d="M0 18c0-8.618 6.059-15.82 14.118-17.588V18H0z"/>
                  <circle fill="#EEE" cx="3" cy="5" r="1"/><circle fill="#EEE" cx="7" cy="5" r="1"/><circle fill="#EEE" cx="11" cy="5" r="1"/><circle fill="#EEE" cx="5" cy="8" r="1"/><circle fill="#EEE" cx="9" cy="8" r="1"/><circle fill="#EEE" cx="3" cy="11" r="1"/><circle fill="#EEE" cx="7" cy="11" r="1"/><circle fill="#EEE" cx="11" cy="11" r="1"/><circle fill="#EEE" cx="5" cy="14" r="1"/><circle fill="#EEE" cx="9" cy="14" r="1"/>
                </svg>
                <span class="text-slate-600 font-medium text-[15px]">English</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-[1.5rem] sm:rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 sm:p-8 w-full max-w-[450px] z-10">
        
        <h1 class="text-3xl sm:text-[1.85rem] font-bold text-[#172052] mb-2 tracking-tight leading-tight">Unduh Dokumen</h1>
        <p class="text-gray-500 mb-6 text-[15px]">Masukkan nomor dokumen untuk mengunduh dokumen</p>

        <form id="download-form" action="{{ route('document.download') }}" method="POST" novalidate>
            @csrf
            
            <!-- Nomor Dokumen -->
            <div class="mb-5">
                <label for="nomor_dokumen" class="block text-[#172052] font-semibold mb-2 text-[15px]">Nomor Dokumen</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.125rem] w-[1.125rem] text-[#172052]" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                    </div>
                    <input type="text" id="nomor_dokumen" name="nomor_dokumen" placeholder="Masukkan nomor dokumen dari dokumen" required class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#172052] focus:ring-1 focus:ring-[#172052] transition-colors text-[15px] placeholder-gray-400">
                </div>
            </div>

            <!-- Verifikasi -->
            <div class="mb-7">
                <label class="block text-[#172052] font-semibold mb-2 text-[15px]">Verifikasi</label>
                <div class="inline-flex items-center border border-gray-200 rounded-xl px-4 py-2.5 w-56 relative overflow-hidden bg-white">
                    
                    <!-- Hidden real checkbox but focusable (z-20) -->
                    <input type="checkbox" id="robot" name="robot" required class="absolute w-[1.25rem] h-[1.25rem] opacity-0 z-20 cursor-pointer left-4">
                    
                    <!-- Box element container -->
                    <div class="relative w-[1.25rem] h-[1.25rem] mr-3 flex items-center justify-center shrink-0">
                        <!-- Border Box -->
                        <div id="verify-box" class="absolute inset-0 rounded-md border-2 border-gray-300 flex items-center justify-center transition-all duration-200 z-10">
                            <!-- Checkmark SVG -->
                            <svg id="verify-check" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white scale-0 transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        
                        <!-- Spinner SVG -->
                        <svg id="verify-spinner" class="absolute inset-0 animate-spin w-[1.25rem] h-[1.25rem] text-[#172052] opacity-0 transition-opacity duration-200 z-10 pointer-events-none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>

                    <!-- Label text -->
                    <label for="robot" id="verify-text" class="text-[#172052] font-medium cursor-pointer text-[14.5px] z-20 select-none whitespace-nowrap">Saya bukan robot</label>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="download-btn" class="w-full bg-gradient-to-r from-[#293d7c] to-[#101633] hover:from-[#213268] hover:to-[#0b1029] text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-[#101633]/20 transition-all duration-200 text-[15px] cursor-pointer flex items-center justify-center gap-2.5">
                <svg id="btn-spinner" class="animate-spin w-[1.15rem] h-[1.15rem] text-yellow-400 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span id="btn-text">Unduh Dokumen</span>
            </button>
        </form>

    </div>

    <!-- Footer Copyright -->
    <div class="absolute bottom-6 left-6 lg:bottom-10 lg:left-10 z-10">
        <p class="text-slate-600/90 font-medium text-[11px] md:text-[12px] tracking-wide">
            &copy; 2026 Direktorat Jenderal Pajak. Seluruh hak cipta dilindungi.
        </p>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('lang-dropdown-btn');
            const dropdownMenu = document.getElementById('lang-dropdown-menu');
            const chevron = document.getElementById('lang-chevron');

            // Toggle dropdown on button click
            dropdownButton.addEventListener('click', function(e) {
                e.stopPropagation();
                
                // Toggle menu visibility and scale
                dropdownMenu.classList.toggle('opacity-0');
                dropdownMenu.classList.toggle('invisible');
                dropdownMenu.classList.toggle('scale-95');
                dropdownMenu.classList.toggle('scale-100');
                
                // Toggle chevron rotation (180 degrees)
                chevron.classList.toggle('rotate-180');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                    dropdownMenu.classList.remove('scale-100');
                    chevron.classList.remove('rotate-180');
                }
            });

            // Verification Checkbox Animation Logic
            const realCheckbox = document.getElementById('robot');
            const verifyBox = document.getElementById('verify-box');
            const verifyCheck = document.getElementById('verify-check');
            const verifySpinner = document.getElementById('verify-spinner');
            const verifyText = document.getElementById('verify-text');
            
            let isVerifying = false;

            realCheckbox.addEventListener('click', function(e) {
                // If already verified, prevent unchecking
                if (realCheckbox.classList.contains('verified')) {
                    e.preventDefault();
                    return;
                }
                
                // Prevent immediate checking to show animation first
                e.preventDefault();
                
                if (isVerifying) return;
                isVerifying = true;
                
                // Hide border box, show spinner
                verifyBox.classList.add('opacity-0');
                verifySpinner.classList.remove('opacity-0');
                verifyText.textContent = 'Memverifikasi...';
                
                // Simulate verification delay (800ms)
                setTimeout(() => {
                    // Physically check the input for form submission
                    realCheckbox.checked = true;
                    realCheckbox.classList.add('verified'); 
                    realCheckbox.style.cursor = 'default';
                    
                    // Hide spinner
                    verifySpinner.classList.add('opacity-0');
                    
                    // Show box with blue background and checkmark
                    verifyBox.classList.remove('opacity-0', 'border-gray-300');
                    verifyBox.classList.add('bg-[#3b82f6]', 'border-[#3b82f6]');
                    verifyCheck.classList.remove('scale-0');
                    verifyCheck.classList.add('scale-100');
                    
                    verifyText.textContent = 'Terverifikasi';
                    verifyText.style.cursor = 'default';
                    isVerifying = false;
                }, 800); 
            });

            // Download Button Animation & SweetAlert Logic
            const downloadForm = document.getElementById('download-form');
            const downloadBtn = document.getElementById('download-btn');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');
            const nomorInput = document.getElementById('nomor_dokumen');

            // Handle Backend Session Error via SweetAlert
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Unduh Gagal',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#172052'
                });
            @endif

            downloadForm.addEventListener('submit', function(e) {
                // Client-side Validation (SweetAlert)
                if (!nomorInput.value.trim()) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Masukkan nomor dokumen terlebih dahulu',
                        confirmButtonColor: '#172052'
                    });
                    return;
                }
                
                if (!realCheckbox.checked) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Unduh Gagal',
                        text: 'Klik kotak centang untuk melanjutkan',
                        confirmButtonColor: '#172052'
                    });
                    return;
                }
                
                // Prevent duplicate visual submissions
                if (downloadBtn.disabled) {
                    e.preventDefault();
                    return;
                }
                
                // Visual Loading State
                downloadBtn.disabled = true;
                downloadBtn.classList.add('opacity-90', 'cursor-wait');
                btnSpinner.classList.remove('hidden');
                btnText.textContent = 'Memproses...';
                
                // Revert the button back to normal after a short delay (2.5 seconds)
                setTimeout(() => {
                    downloadBtn.disabled = false;
                    downloadBtn.classList.remove('opacity-90', 'cursor-wait');
                    btnSpinner.classList.add('hidden');
                    btnText.textContent = 'Unduh Dokumen';
                }, 2500);
            });
        });
    </script>
</body>
</html>

