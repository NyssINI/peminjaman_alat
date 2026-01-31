<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Alat - Peminjam</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#f8fafc] text-slate-800 font-sans antialiased">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-indigo-600 p-2 rounded-xl">
                    <i class="fa-solid fa-toolbox text-white text-lg"></i>
                </div>
                <span class="font-black text-xl tracking-tight text-slate-800">Pinjam<span
                        class="text-indigo-600">Alat</span></span>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden md:flex flex-col items-end mr-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Peminjam</span>
                    <span class="text-sm font-bold text-slate-700">{{ auth()->user()->name }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="group flex items-center gap-2 bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 px-4 py-2 rounded-xl text-xs font-bold transition-all duration-300">
                        <span>LOGOUT</span>
                        <i class="fa-solid fa-sign-out group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="mb-12">
            <h2 class="text-lg font-black text-slate-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-circle-dot text-indigo-500"></i>
                Status Pinjam
            </h2>

            @forelse($pinjamanAktif as $aktif)
                @php
                    $isPending = $aktif->status == 'pending';
                    $isTelat = !$isPending && \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($aktif->tgl_kembali));
                @endphp

                <div
                    class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm mb-3 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-xl flex items-center justify-center {{ $isTelat ? 'bg-rose-100 text-rose-600' : ($isPending ? 'bg-amber-100 text-amber-600' : 'bg-indigo-100 text-indigo-600') }}">
                            <i class="fa-solid {{ $isPending ? 'fa-clock' : 'fa-toolbox' }}"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800 text-sm">{{ $aktif->alat->nama_alat }}</h3>
                            <p class="text-[11px] font-medium text-slate-500">
                                @if ($isPending)
                                    Menunggu verifikasi petugas
                                @else
                                    Batas: {{ \Carbon\Carbon::parse($aktif->tgl_kembali)->format('H:i') }}
                                    {!! $isTelat ? '<span class="text-rose-500 font-bold ml-1">(Terlambat!)</span>' : '' !!}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span
                            class="text-[10px] uppercase font-black tracking-widest {{ $isTelat ? 'text-rose-600' : ($isPending ? 'text-amber-500' : 'text-indigo-600') }}">
                            {{ $isPending ? 'Pending' : ($isTelat ? 'Denda' : 'Dipinjam') }}
                        </span>
                    </div>
                </div>
            @empty
                <div
                    class="text-center py-6 border-2 border-dashed border-slate-200 rounded-2xl text-slate-400 text-xs italic">
                    Belum ada peminjaman aktif
                </div>
            @endforelse
        </div>

        <hr class="border-slate-200 mb-12">

        <div class="mb-12">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Daftar Alat</h1>
            <p class="text-slate-500 mt-1 mb-8 font-medium">Alat yang tersedia dan siap Anda gunakan.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($alats as $item)
                    <div
                        class="group bg-white border border-slate-200 shadow-sm flex flex-col rounded-3xl overflow-hidden hover:shadow-xl transition-all">
                        <div class="p-5">
                            <span
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $item->kode_alat }}</span>
                            <h3 class="font-black text-lg text-slate-800 mt-1">{{ $item->nama_alat }}</h3>
                            <p class="text-sm text-slate-500 mt-2 line-clamp-2">{{ $item->spesifikasi }}</p>

                            <a href="{{ route('peminjam.create', ['alat_id' => $item->id]) }}"
                                class="mt-5 flex items-center justify-center gap-2 w-full bg-slate-900 hover:bg-indigo-600 text-white text-xs font-bold py-3.5 rounded-2xl transition-all">
                                PINJAM SEKARANG
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-[32px] p-12 text-center">
                        <p class="text-slate-400 italic">Maaf, saat ini tidak ada alat yang tersedia untuk dipinjam.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <hr class="border-slate-200 mb-12">

        <div>
            <h2 class="text-xl font-black text-slate-800 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-history text-slate-400"></i>
                Riwayat Peminjaman
            </h2>
            <div class="bg-white border border-slate-200 rounded-[32px] overflow-hidden shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase">Alat</th>
                            <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase text-center">Waktu
                                Pinjam</th>
                            <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase text-center">Batas
                                Kembali</th>
                            <th
                                class="px-6 py-4 text-[11px] font-black text-indigo-600 uppercase text-center bg-indigo-50/30">
                                Real Time Kembali</th>
                            <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase text-right">Denda</th>
                            <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase text-right">Status
                                Akhir</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($riwayatSelesai as $history)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-700 text-sm">
                                    {{ $history->alat->nama_alat }}
                                </td>

                                <td class="px-6 py-4 text-center text-xs text-slate-500">
                                    {{ \Carbon\Carbon::parse($history->tgl_pinjam)->setTimezone('Asia/Makassar')->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 text-center text-xs text-slate-500">
                                    {{ \Carbon\Carbon::parse($history->tgl_kembali)->setTimezone('Asia/Makassar')->format('d M Y, H:i') }}
                                </td>       
                                <td class="px-6 py-4 text-center text-xs font-bold bg-indigo-50/10">
                                    @if ($history->status == 'ditolak')
                                        <span class="text-slate-300">-</span>
                                    @elseif($history->tgl_kembali_asli)
                                        <span class="text-indigo-600">
                                            {{ \Carbon\Carbon::parse($history->tgl_kembali_asli)->setTimezone('Asia/Makassar')->format('d M Y, H:i') }}
                                        </span>
                                    @else
                                        <span class="text-slate-300 italic">-</span>
                                    @endif
                                </td>
                                <td
                                    class="px-6 py-4 text-right text-xs font-bold {{ $history->denda > 0 ? 'text-rose-600' : 'text-slate-400' }}">
                                    {{ $history->denda > 0 ? 'Rp ' . number_format($history->denda) : '-' }}
                                </td>

                                <td class="px-6 py-4 text-right">
                                    @if ($history->status == 'ditolak')
                                        <span
                                            class="px-3 py-1 bg-rose-50 text-rose-500 text-[10px] font-black rounded-lg border border-rose-100 uppercase tracking-widest italic">
                                            Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-lg border border-emerald-100 uppercase tracking-widest">
                                            Selesai
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-400 italic text-sm">Belum ada
                                    riwayat peminjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '<span class="text-slate-800">Berhasil</span>',
                html: '<span class="text-slate-500 font-medium">{{ session('success') }}</span>',
                confirmButtonColor: '#4f46e5',
                confirmButtonText: 'Selesai',
                customClass: {
                    popup: 'rounded-[24px]',
                    confirmButton: 'rounded-xl px-6 py-2.5 text-sm font-bold'
                }
            })
        </script>
    @endif

</body>
</html>
