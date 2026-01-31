<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div
    class="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div
            class="mx-auto h-16 w-16 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
            <i class="fa-solid fa-shield-halved text-white text-3xl"></i>
        </div>

        <h2 class="mt-6 text-center text-3xl font-extrabold text-slate-800">
            Selamat Datang
        </h2>
        <p class="mt-2 text-center text-sm text-slate-500">
            Silahkan masuk ke akun Anda untuk melanjutkan
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4">
        <div class="bg-white py-10 px-8 shadow-xl shadow-slate-200/50 rounded-3xl border border-slate-100">
            <form class="space-y-6" action="/login" method="POST">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-slate-400 text-sm"></i>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm"
                            placeholder="Masukkan email anda">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-semibold text-slate-700">
                            Password
                        </label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-slate-400 text-sm"></i>
                        </div>
                        <input id="password" name="password" type="password" required
                            class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm"
                            placeholder="••••••••">
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <p class="text-sm text-slate-500">
                        Belum punya akun?
                        <a href="<?php echo e(route('register')); ?>"
                            class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                            Daftar akun anda
                        </a>
                    </p>
                </div>
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-200 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 flex items-center gap-2">
                        <span>Masuk Sekarang</span>
                        <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php if(session('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?php echo e(session('success')); ?>',
            showConfirmButton: false,
            timer: 1500,
            customClass: {
                popup: 'rounded-3xl'
            }
        })
    </script>
<?php endif; ?>

<?php if(session('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: '<?php echo e(session('error')); ?>',
            confirmButtonText: 'Coba Lagi',
            confirmButtonColor: '#4f46e5',
            customClass: {
                popup: 'rounded-3xl',
                confirmButton: 'rounded-xl px-6 py-2'
            }
        })
    </script>
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\peminjaman_alat\resources\views/auth/login.blade.php ENDPATH**/ ?>