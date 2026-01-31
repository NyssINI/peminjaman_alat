@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Data Peminjaman</h1>
            <p class="text-slate-500 mt-1 font-medium">Pantau seluruh transaksi peminjaman alat secara real-time.</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-[24px] p-6 mb-8 shadow-sm">
            <form action="{{ route('datapeminjaman.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Mulai
                        Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Sampai
                        Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                </div>

                <div class="w-40">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Status</label>
                    <select name="status"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui
                        </option>
                        <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>
                            Dikembalikan</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="bg-slate-900 hover:bg-indigo-600 text-white px-6 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2">
                        <i class="fa-solid fa-filter"></i> FILTER
                    </button>
                    <a href="{{ route('datapeminjaman.index') }}"
                        class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-2.5 rounded-xl font-bold text-xs transition-all">
                        RESET
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white border border-slate-200 rounded-[32px] overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase">Peminjam & Alat</th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase text-center">Waktu Pinjam</th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase text-center">Waktu Kembali</th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase text-center">Real Time Kembali
                        </th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase text-center">Status</th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($datapeminjaman as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 text-sm">{{ $item->user->name }}</div>
                                <div class="text-[11px] text-slate-500 font-medium italic">{{ $item->alat->nama_alat }}
                                    ({{ $item->alat->kode_alat }})
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center text-xs text-slate-500 font-medium">
                                {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 text-center text-xs text-slate-500 font-medium">
                                {{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 text-center text-xs text-slate-500 font-medium">
                                {{ \Carbon\Carbon::parse($item->tgl_asli)->format('d M Y, H:i') }}
                                <div class="flex flex-col items-center">
                                    @if ($item->denda > 0)
                                        <span class="text-[10px] text-rose-600 font-black mt-1">Denda: Rp
                                            {{ number_format($item->denda) }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $colors = [
                                        'pending' => 'bg-amber-50 text-amber-500 border-amber-100',
                                        'disetujui' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
                                        'dikembalikan' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                        'ditolak' => 'bg-rose-50 text-rose-500 border-rose-100',
                                    ];
                                    $class = $colors[$item->status] ?? 'bg-slate-50 text-slate-400';
                                @endphp
                                <span
                                    class="px-3 py-1 {{ $class }} text-[10px] font-black rounded-lg border uppercase tracking-widest">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button type="button"
                                        onclick="openModal({{ json_encode($item->load('user', 'alat')) }})"
                                        class="p-2.5 bg-slate-50 hover:bg-indigo-50 text-slate-400 hover:text-indigo-600 rounded-xl border border-slate-100 transition-all">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </button>
                                    <form action="{{ route('datapeminjaman.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus data ini secara permanen?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-2.5 bg-slate-50 hover:bg-rose-50 text-slate-400 hover:text-rose-600 rounded-xl border border-slate-100 transition-all">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="text-3xl mb-3 opacity-20"></i>
                                    <p>Data tidak ditemukan untuk kriteria tersebut.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="modalDetail" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="bg-white w-full max-w-md rounded-[32px] shadow-2xl p-8 overflow-hidden transform transition-all">
                <h3 class="text-xl font-black text-slate-800 mb-6">Detail Peminjaman</h3>
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between border-b pb-2"><span class="text-slate-400">Peminjam:</span>
                        <span id="m-user" class="font-bold"></span>
                    </div>
                    <div class="flex justify-between border-b pb-2"><span class="text-slate-400">Alat:</span>
                        <span id="m-alat" class="font-bold text-indigo-600"></span>
                    </div>
                    <div class="flex justify-between border-b pb-2"><span class="text-slate-400">Waktu Pinjam:</span>
                        <span id="m-pinjam" class="font-medium"></span>
                    </div>
                    <div class="flex justify-between border-b pb-2"><span class="text-slate-400">Batas Kembali:</span>
                        <span id="m-kembali" class="font-medium"></span>
                    </div>
                    <div class="flex justify-between border-b pb-2"><span class="text-slate-400">Real Time Kembali:</span>
                        <span id="m-kembali-asli" class="font-medium"></span>
                    </div>
                    <div class="flex justify-between border-b pb-2"><span class="text-slate-400">Denda:</span>
                        <span id="m-denda" class="font-black text-rose-600"></span>
                    </div>
                </div>
                <button onclick="closeModal()"
                    class="w-full mt-8 py-4 bg-slate-900 text-white rounded-2xl font-bold text-xs uppercase hover:bg-indigo-600 transition-all">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(data) {
            document.getElementById('m-user').innerText = data.user.name;
            document.getElementById('m-alat').innerText = data.alat.nama_alat;
            document.getElementById('m-pinjam').innerText = data.tgl_pinjam;
            document.getElementById('m-kembali').innerText = data.tgl_kembali;
            let realTime = data.tgl_asli || data.tgl_kembali_asli || '-';
            document.getElementById('m-kembali-asli').innerText = realTime;
            document.getElementById('m-denda').innerText = 'Rp ' + new Intl.NumberFormat().format(data.denda);
            document.getElementById('modalDetail').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modalDetail').classList.add('hidden');
        }
    </script>
@endsection
