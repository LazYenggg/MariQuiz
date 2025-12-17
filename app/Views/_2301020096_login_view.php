<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MariQuiz</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: {
                        umrah: {
                            blue: '#004aad', // Biru UMRAH (Gelap)
                            cyan: '#00a8e8', // Biru Laut Terang
                            yellow: '#ffcc00' // Kuning Aksen
                        }
                    },
                    animation: {
                        'levitate': 'float 4s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #f3f4f6; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden bg-gradient-to-tr from-slate-200 to-blue-50">

    <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>

    <div class="bg-white rounded-[30px] shadow-2xl w-full max-w-5xl flex overflow-hidden relative z-10 min-h-[550px]" data-aos="zoom-in" data-aos-duration="800">
        
        <div class="hidden md:flex w-1/2 flex-col justify-center items-center p-12 relative bg-slate-50 border-r border-slate-100">
            <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#004aad_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="relative z-10 mb-8 animate-levitate">
                <img src="<?= base_url('assets/img/logo-umrah.png') ?>" 
                     onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_Universitas_Maritim_Raja_Ali_Haji.png'" 
                     class="h-40 w-auto drop-shadow-xl" 
                     alt="Logo UMRAH">
            </div>

            <div class="text-center z-10">
                <h1 class="text-4xl font-bold text-umrah-blue mb-2 tracking-tight">Mari<span class="text-umrah-cyan">Quiz</span></h1>
                <p class="text-slate-500 font-medium">Sistem Evaluasi Akademik<br>Universitas Maritim Raja Ali Haji</p>
                
                <div class="mt-8 flex justify-center gap-2">
                    <div class="h-1.5 w-1.5 rounded-full bg-umrah-blue"></div>
                    <div class="h-1.5 w-1.5 rounded-full bg-umrah-cyan"></div>
                    <div class="h-1.5 w-1.5 rounded-full bg-umrah-yellow"></div>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center bg-white">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-800">Selamat Datang</h2>
                <p class="text-slate-400 mt-2">Silakan login menggunakan ID Akademik Anda.</p>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg">
                    <p class="font-bold">Gagal Masuk</p>
                    <p><?= session()->getFlashdata('error') ?></p>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/login') ?>" method="post" class="space-y-6">
                <div>
                    <label class="block text-slate-600 text-sm font-bold mb-2 ml-1">Username / NIM / NIDN</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-umrah-blue transition">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </span>
                        <input type="text" name="username" class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-slate-50 border border-slate-200 focus:border-umrah-blue focus:ring-4 focus:ring-blue-500/10 outline-none transition font-medium text-slate-700 placeholder-slate-400" placeholder="Masukkan ID Pengguna" required>
                    </div>
                </div>

                <div>
                    <label class="block text-slate-600 text-sm font-bold mb-2 ml-1">Password</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-umrah-blue transition">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </span>
                        <input type="password" name="password" class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-slate-50 border border-slate-200 focus:border-umrah-blue focus:ring-4 focus:ring-blue-500/10 outline-none transition font-medium text-slate-700 placeholder-slate-400" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-umrah-blue to-blue-600 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-1 active:scale-95">
                    Masuk Aplikasi
                </button>
            </form>
            
            <p class="mt-8 text-center text-xs text-slate-400">
                &copy; 2025 - MariQuiz System
            </p>
        </div>
    </div>

    <script>
        AOS.init();

        // SweetAlert Trigger jika ada Error dari PHP Session
        <?php if(session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: '<?= session()->getFlashdata('error') ?>',
                confirmButtonColor: '#004aad',
                confirmButtonText: 'Coba Lagi',
                background: '#fff',
                customClass: { popup: 'rounded-2xl' }
            });
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session()->getFlashdata('success') ?>',
                confirmButtonColor: '#004aad',
                timer: 2000
            });
        <?php endif; ?>
    </script>
</body>
</html>