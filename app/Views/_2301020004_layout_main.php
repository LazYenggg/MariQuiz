<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MariQuiz - Maritime Quiz System</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: {
                        ocean: {
                            light: '#0ea5e9', // Sky 500
                            DEFAULT: '#0369a1', // Sky 700
                            dark: '#0c4a6e', // Sky 900
                        },
                        gold: '#f59e0b'
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        body { background-color: #f0f4f8; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen text-slate-800 font-sans overflow-x-hidden">

    <nav class="fixed top-0 w-full z-50 glass shadow-sm transition-all duration-300" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="flex items-center gap-3 group">
                <img src="<?= base_url('assets/img/logo-umrah.png') ?>" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_Universitas_Maritim_Raja_Ali_Haji.png'" class="h-10 w-auto transition transform group-hover:scale-110 drop-shadow-md" alt="Logo">
                <div class="leading-tight">
                    <h1 class="text-xl font-bold text-ocean-dark tracking-wide">Mari<span class="text-ocean-light">Quiz</span></h1>
                    <p class="text-[10px] font-semibold text-slate-400 tracking-wider uppercase">Maritime System</p>
                </div>
            </a>
            
            <div class="flex items-center gap-4">
                <div class="hidden md:flex flex-col text-right mr-2">
                    <span class="text-sm font-bold text-slate-700"><?= session()->get('nama_user') ?? 'Guest' ?></span>
                    <span class="text-xs text-ocean-light font-medium uppercase tracking-wider"><?= session()->get('role') ?></span>
                </div>
                <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-ocean-light to-ocean-dark flex items-center justify-center text-white font-bold shadow-lg ring-2 ring-white">
                    <?= substr(session()->get('nama_user') ?? 'U', 0, 1) ?>
                </div>
                <a href="<?= base_url('logout') ?>" 
                   class="ml-2 bg-red-50 hover:bg-red-500 hover:text-white text-red-500 p-2 rounded-lg transition duration-200 border border-red-100 shadow-sm" title="Logout">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                </a>
            </div>
        </div>
    </nav>

    <div class="h-24"></div> <main class="container mx-auto px-4 py-6 min-h-[80vh]">
        <?= $content ?>
    </main>

    <footer class="text-center py-6 text-slate-400 text-sm mt-auto">
        <p>&copy; 2025 MariQuiz System - Universitas Maritim Raja Ali Haji</p>
        <p class="text-xs mt-1">Dikembangkan oleh Kelompok Farrel Razan</p>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Init Animate On Scroll
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    </script>

    <?php if(session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('success') ?>',
            icon: 'success',
            confirmButtonColor: '#0369a1',
            timer: 3000
        });
    </script>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            title: 'Gagal!',
            text: '<?= session()->getFlashdata('error') ?>',
            icon: 'error',
            confirmButtonColor: '#ef4444'
        });
    </script>
    <?php endif; ?>
</body>
</html>