<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>
</head>

<body class="bg-slate-50">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-xl fixed h-full">
            <div class="p-6 border-b border-slate-800">
                <div class="flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                    </svg>

                    <h1
                        class="text-xl font-extrabold bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent tracking-wider">
                        PEMINJAMAN
                    </h1>
                </div>
            </div>

            <nav class="flex-1 mt-6 px-4 space-y-2">
                <?php if(auth()->user()->role === 'admin'): ?>
                    <a href="<?php echo e(route('users.index')); ?>"
                        class="group flex items-center p-3 rounded-xl <?php echo e(request()->routeIs('users.index') ? 'bg-indigo-900 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50'); ?> transition-all duration-200">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-800 mr-2 group-hover:bg-indigo-500/20 group-hover:text-indigo-400 transition-all">
                            <i class="fa-solid fa-users text-sm"></i>
                        </div>
                        <span class="font-medium">Daftar User</span>
                    </a>

                    <a href="<?php echo e(route('kategori.index')); ?>"
                        class="group flex items-center p-3 rounded-xl <?php echo e(request()->routeIs('kategori.*') ? 'bg-indigo-900 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50'); ?> transition-all duration-200">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-800 mr-2 group-hover:bg-indigo-500/20 group-hover:text-indigo-400 transition-all">
                            <i class="fa-solid fa-tags text-sm"></i>
                        </div>
                        <span class="font-medium">Kategori Alat</span>
                    </a>

                    <a href="<?php echo e(route('alat.index')); ?>"
                        class="group flex items-center p-3 rounded-xl <?php echo e(request()->routeIs('alat.*') ? 'bg-indigo-900 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50'); ?> transition-all duration-200">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-800 mr-2 group-hover:bg-indigo-500/20 group-hover:text-indigo-400 transition-all">
                            <i class="fa-solid fa-box text-sm"></i>
                        </div>
                        <span class="font-medium">Daftar Alat</span>
                    </a>

                    <a href="<?php echo e(route('datapeminjaman.index')); ?>"
                        class="group flex items-center p-3 rounded-xl <?php echo e(request()->routeIs('datapeminjaman.*') ? 'bg-indigo-900 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50'); ?> transition-all duration-200">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-800 mr-2 group-hover:bg-indigo-500/20 group-hover:text-indigo-400 transition-all">
                            <i class="fa-solid fa-clipboard-list text-sm"></i>
                        </div>
                        <span class="font-medium">Data Peminjaman</span>
                    </a>

                     <a href="<?php echo e(route('logaktivitas.index')); ?>"
                        class="group flex items-center p-3 rounded-xl <?php echo e(request()->routeIs('logaktivitas.*') ? 'bg-indigo-900 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50'); ?> transition-all duration-200">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-800 mr-2 group-hover:bg-indigo-500/20 group-hover:text-indigo-400 transition-all">
                            <i class="fa-solid fa-solid fa-clock-rotate-left text-sm"></i>
                        </div>
                        <span class="font-medium">Log Aktivitas</span>
                    </a>
                <?php endif; ?>

                <?php if(auth()->user()->role === 'petugas'): ?>
                    <a href="<?php echo e(route('petugas.index')); ?>"
                        class="group flex items-center p-3 rounded-xl <?php echo e(request()->routeIs('petugas.*') ? 'bg-indigo-900 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50'); ?> transition-all duration-200">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-800 mr-2 group-hover:bg-indigo-500/20 group-hover:text-indigo-400 transition-all">
                            <i class="fa-solid fa-check-to-slot text-sm"></i>
                        </div>
                        <span class="font-medium">Data Peminjaman</span>
                    </a>

                    <a href="<?php echo e(route('cetaklaporan.index')); ?>"
                        class="group flex items-center p-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/50 transition-all duration-200">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-800 mr-2 group-hover:bg-indigo-500/20 group-hover:text-indigo-400 transition-all">
                            <i class="fa-solid fa-print text-sm"></i>
                        </div>
                        <span class="font-medium">Cetak Laporan</span>
                    </a>
                <?php endif; ?>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center mb-4 px-2">
                    <div
                        class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center mr-3 text-xs font-bold uppercase">
                        <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-medium truncate"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-xs text-slate-500 italic capitalize"><?php echo e(auth()->user()->role); ?></p>
                    </div>
                </div>
                <form action="/logout" method="POST">
                    <?php echo csrf_field(); ?>
                    <button
                        class="w-full flex items-center justify-center gap-2 bg-red-500/10 text-red-500 border border-red-500/20 py-2 rounded-lg hover:bg-red-500 hover:text-white transition duration-300">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="text-sm font-semibold">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col ml-64 min-h-screen bg-[#f8fafc]">
            <header
                class="bg-white/80 backdrop-blur-md shadow-sm p-4 flex justify-between items-center px-8 sticky top-0 z-40 border-b border-slate-100">
                <h2 class="text-slate-500 font-medium italic text-sm">Sistem Informasi Inventaris Alat</h2>
                <div class="flex items-center gap-4 text-slate-600">
                    <i class="fa-regular fa-bell cursor-pointer hover:text-indigo-600 transition-colors"></i>
                    <div class="h-6 w-[1px] bg-slate-200"></div>
                    <div class="flex flex-col items-end">
                        <span
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Hari
                            Ini</span>
                        <span class="text-sm font-bold text-slate-700 leading-none"><?php echo e(date('d M Y')); ?></span>
                    </div>
                </div>
            </header>

            <div class="p-8">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>

    <?php if(session('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?php echo e(session('success')); ?>',
                timer: 1500,
                showConfirmButton: false,
                iconColor: '#4f46e5'
            });
        </script>
    <?php endif; ?>

</body>

</html>
<?php /**PATH D:\xampp\htdocs\peminjaman_alat\resources\views/layouts/app.blade.php ENDPATH**/ ?>