<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjam - Sistem Peminjaman</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="mx-auto h-16 w-16 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                <i class="fa-solid fa-user-plus text-white text-3xl"></i>
            </div>
            
            <h2 class="mt-6 text-center text-3xl font-extrabold text-slate-800">
                Daftar Akun
            </h2>
            <p class="mt-2 text-center text-sm text-slate-500">
                Lengkapi data di bawah untuk menjadi peminjam
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4">
            <div class="bg-white py-10 px-8 shadow-xl shadow-slate-200/50 rounded-3xl border border-slate-100">
                <form class="space-y-5" action="{{ route('register.post') }}" method="POST">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-user text-slate-400 text-sm"></i>
                            </div>
                            <input name="name" type="text" required value="{{ old('name') }}"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm"
                                placeholder="Masukkan Nama Lengkap Anda">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-envelope text-slate-400 text-sm"></i>
                            </div>
                            <input name="email" type="email" required value="{{ old('email') }}"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm"
                                placeholder="Masukkan Email Anda">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-slate-400 text-sm"></i>
                            </div>
                            <input name="password" type="password" required 
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm"
                                placeholder="Masukkan Password Anda">
                        </div>
                    </div>

                    <div>
                        <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-200 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 flex items-center gap-2">
                            <span>Daftar Sekarang</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-slate-500">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Pendaftaran Gagal',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#4f46e5',
            customClass: { popup: 'rounded-3xl' }
        })
    </script>
    @endif
</body>
</html>