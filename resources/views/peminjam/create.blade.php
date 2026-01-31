<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Peminjaman - {{ $alat->nama_alat }}</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#f8fafc] text-slate-800 font-sans antialiased">

    <main class="max-w-3xl mx-auto px-6 py-12">
        <a href="{{ route('peminjam.index') }}"
            class="inline-flex items-center gap-2 text-slate-500 hover:text-indigo-600 font-bold text-sm mb-8 transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            KEMBALI KE DAFTAR ALAT
        </a>

        <div class="bg-white border border-slate-200 rounded-[32px] overflow-hidden shadow-sm">
            <div class="p-8 border-b border-slate-100 bg-slate-50/50">
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">Form Peminjaman Alat</h1>
                <p class="text-slate-500 font-medium">Lengkapi detail peminjaman di bawah ini.</p>
            </div>
            @if ($errors->any())
                <div class="bg-rose-100 text-rose-600 p-4 rounded-xl mb-4 text-sm font-bold">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('peminjam.store') }}" method="POST" class="p-8">
                @csrf
                <input type="hidden" name="alat_id" value="{{ $alat->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="space-y-4">
                        <div>
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Nama
                                Alat</label>
                            <input type="text" value="{{ $alat->nama_alat }}" readonly
                                class="w-full bg-slate-100 border-none rounded-xl text-sm font-bold text-slate-700 p-3">
                        </div>
                        <div>
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Kode
                                Alat</label>
                            <input type="text" value="{{ $alat->kode_alat }}" readonly
                                class="w-full bg-slate-100 border-none rounded-xl text-sm font-bold text-slate-700 p-3 italic">
                        </div>
                        <div>
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Nama
                                Peminjam</label>
                            <input type="text" value="{{ auth()->user()->name }}" readonly
                                class="w-full bg-slate-100 border-none rounded-xl text-sm font-bold text-slate-700 p-3">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Tanggal
                                & Jam Pinjam</label>
                            <input type="datetime-local" name="tgl_pinjam" required
                                class="w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm font-bold text-slate-700 p-3">
                        </div>
                        <div>
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Rencana
                                Kembali (Tanggal & Jam)</label>
                            <input type="datetime-local" name="tgl_kembali" required
                                class="w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm font-bold text-slate-700 p-3">
                        </div>
                    </div>
                    <div class="bg-amber-50 border border-amber-100 p-4 rounded-2xl">
                        <div class="flex gap-3">
                            <i class="fa-solid fa-circle-info text-amber-500 mt-0.5"></i>
                        </div>
                    </div>
                </div>
                  <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl transition-all shadow-lg shadow-indigo-100 flex items-center justify-center gap-3">
            KONFIRMASI PINJAM ALAT
            <i class="fa-solid fa-paper-plane text-sm"></i>
        </button>
        </div>

      
        </form>
        </div>
    </main>

</body>

</html>
