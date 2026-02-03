@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6 text-slate-800">
        <div>
            <h1 class="text-2xl font-bold italic tracking-tight">Persetujuan Peminjaman</h1>
            <p class="text-sm text-slate-500 italic font-medium">Kelola permintaan dan verifikasi status peminjaman alat.</p>
        </div>
        <a href="{{ route('cetaklaporan.index') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-200 transition duration-200 flex items-center gap-2 font-semibold text-sm">
            <i class="fa-solid fa-print"></i> Cetak Laporan
        </a>
    </div>

    @if (session('success'))
        <div
            class="mb-5 flex items-center gap-3 p-4 text-sm text-emerald-600 bg-emerald-50 rounded-xl border border-emerald-100">
            <i class="fa-solid fa-circle-check"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-[24px] shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Peminjam &
                        Alat</th>
                    <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Kode Alat
                    </th>
                    <th class="px-6 py-4 text-center text-xs font-black text-slate-500 uppercase tracking-widest">Waktu
                        Pinjam</th>
                    <th class="px-6 py-4 text-center text-xs font-black text-slate-500 uppercase tracking-widest">Batas
                        Kembali</th>
                    <th
                        class="px-6 py-4 text-center text-xs font-black text-indigo-600 uppercase tracking-widest bg-indigo-50/30">
                        Real Time Kembali</th>
                    <th class="px-6 py-4 text-center text-xs font-black text-slate-500 uppercase tracking-widest">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($datapeminjaman as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-slate-700">{{ $item->nama_peminjam }}</div>
                            <div class="text-[10px] text-indigo-500 font-black uppercase tracking-tighter">
                                {{ $item->alat->nama_alat }}</div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-slate-700">{{ $item->kode_alat }}</div>
                            <div class="text-[10px] text-indigo-500 font-black uppercase tracking-tighter">
                                {{ $item->alat->kode_alat }}</div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="text-xs font-bold text-slate-600 bg-slate-100 px-2 py-1 rounded-md">
                                {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('H:i') }}
                            </span>
                            <div class="text-[9px] text-slate-400 mt-1 font-bold">
                                {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}</div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span
                                class="text-xs font-bold text-rose-500 bg-rose-50 px-2 py-1 rounded-md border border-rose-100">
                                {{ \Carbon\Carbon::parse($item->tgl_kembali)->format('H:i') }}
                            </span>
                            <div class="text-[9px] text-slate-400 mt-1 font-bold">
                                {{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d M Y') }}</div>
                        </td>

                        <td class="px-6 py-4 text-center bg-indigo-50/10">
                            @if ($item->status == 'ditolak')
                                <span class="text-slate-300 text-lg font-bold">-</span>
                            @elseif ($item->tgl_kembali_asli)
                                <span class="text-xs font-black text-indigo-600">
                                    {{ \Carbon\Carbon::parse($item->tgl_kembali_asli)->format('H:i') }}
                                </span>
                                <div class="text-[9px] text-indigo-400 font-bold">
                                    {{ \Carbon\Carbon::parse($item->tgl_kembali_asli)->format('d M Y') }}</div>
                            @else
                                <span class="text-slate-300 text-[10px] font-bold uppercase italic">Menunggu...</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if ($item->status == 'pending')
                                <div class="flex justify-center gap-2">
                                    <form action="{{ route('petugas.update', $item->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="disetujui">
                                        <button type="submit"
                                            class="bg-emerald-500 text-white p-2 rounded-lg hover:bg-emerald-600 transition shadow-sm">
                                            <i class="fa-solid fa-check text-xs"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('petugas.update', $item->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit"
                                            class="bg-rose-500 text-white p-2 rounded-lg hover:bg-rose-600 transition shadow-sm">
                                            <i class="fa-solid fa-xmark text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            @elseif($item->status == 'disetujui')
                                <button type="button"
                                    onclick="bukaPopUpDenda('{{ $item->id }}', '{{ $item->nama_peminjam }}', '{{ \Carbon\Carbon::parse($item->tgl_kembali)->format('H:i') }}')"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black py-2.5 px-5 rounded-xl shadow-md transition-all uppercase tracking-widest">
                                    Proses Kembali
                                </button>
                                <form id="form-kembali-{{ $item->id }}"
                                    action="{{ route('petugas.update', $item->id) }}" method="POST" class="hidden">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="aksi" value="kembali">
                                    <input type="hidden" name="jam_petugas" id="jam-input-{{ $item->id }}">
                                    <input type="hidden" name="denda" id="denda-input-{{ $item->id }}">
                                </form>
                            @elseif($item->status == 'ditolak')
                                <span
                                    class="px-3 py-1 bg-rose-50 text-rose-500 text-[10px] font-black rounded-md border border-rose-100 uppercase italic">Ditolak</span>
                            @else
                                <div class="flex flex-col items-center">
                                    <span
                                        class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-black rounded-md border border-slate-200 uppercase">Selesai</span>
                                    @if ($item->denda > 0)
                                        <span class="text-[10px] text-rose-600 font-black mt-1">Denda: Rp
                                            {{ number_format($item->denda) }}</span>
                                    @endif
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function bukaPopUpDenda(id, nama, janji) {
            const sekarang = new Date();
            const jamTampil = sekarang.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            const jamData = sekarang.toLocaleString('sv-SE').replace(' ', 'T');

            Swal.fire({
                title: '<span class="text-slate-800">Verifikasi Pengembalian</span>',
                html: `
                <div class="text-left text-sm bg-slate-50 p-4 rounded-2xl border border-slate-100 mb-4 text-slate-600">
                    <div class="flex justify-between mb-1"><span>Peminjam:</span> <b class="text-slate-800">${nama}</b></div>
                    <div class="flex justify-between mb-1"><span>Janji Kembali:</span> <b class="text-rose-500">${janji} WITA</b></div>
                    <div class="flex justify-between"><span>Jam Sekarang:</span> <b class="text-indigo-600">${jamTampil} WITA</b></div>
                </div>
                <div class="text-left">
                    <label class="block text-xs font-black text-slate-400 uppercase mb-2 tracking-widest">Input Denda Bebas (Rp)</label>
                    <input type="number" id="input-denda-manual" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none font-bold text-slate-700" placeholder="Contoh: 5000" value="0">
                    <p class="text-[10px] text-slate-400 mt-2 font-medium italic">*Isi 0 jika siswa tepat waktu / tidak ada denda.</p>
                </div>
            `,
                showCancelButton: true,
                confirmButtonText: 'Konfirmasi Selesai',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#94a3b8',
                customClass: {
                    popup: 'rounded-[28px]',
                    confirmButton: 'rounded-xl px-6 py-2.5 text-sm font-bold uppercase',
                    cancelButton: 'rounded-xl px-6 py-2.5 text-sm font-bold uppercase'
                },
                preConfirm: () => {
                    const denda = document.getElementById('input-denda-manual').value;
                    if (denda === "") {
                        Swal.showValidationMessage(`Harap isi nominal denda (isi 0 jika tidak ada)`);
                    }
                    return denda;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('jam-input-' + id).value = jamData;
                    document.getElementById('denda-input-' + id).value = result.value;
                    document.getElementById('form-kembali-' + id).submit();
                }
            });
        }

        function pilihTanggalCetak() {
            Swal.fire({
                title: '<span class="text-slate-800">Filter Tanggal Laporan</span>',
                html: `
        <div class="text-left space-y-4">
            <p class="text-xs text-slate-500 mb-4">Pilih rentang tanggal peminjaman yang ingin dicetak.</p>
            <div>
                <label class="block text-xs font-black text-slate-400 uppercase mb-2">Dari Tanggal:</label>
                <input type="date" id="tgl_mulai" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none font-bold text-slate-700">
            </div>
            <div>
                <label class="block text-xs font-black text-slate-400 uppercase mb-2">Sampai Tanggal:</label>
                <input type="date" id="tgl_selesai" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none font-bold text-slate-700">
            </div>
        </div>`,
                showCancelButton: true,
                confirmButtonText: 'Proses Cetak',
                confirmButtonColor: '#4f46e5',
                preConfirm: () => {
                    const mulai = document.getElementById('tgl_mulai').value;
                    const selesai = document.getElementById('tgl_selesai').value;
                    if (!mulai || !selesai) {
                        Swal.showValidationMessage(`Kedua tanggal harus diisi!`);
                    }
                    return {
                        mulai,
                        selesai
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const url =
                        `{{ route('cetaklaporan.index') }}?start_date=${result.value.mulai}&end_date=${result.value.selesai}`;
                    window.open(url, '_blank');
                }
            });
        }
    </script>
@endsection
