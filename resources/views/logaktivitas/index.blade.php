@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-sm border border-slate-100">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Log Aktivitas Sistem</h2>
        <span class="text-xs text-slate-400 italic">Menampilkan aktivitas pengguna</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Waktu</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Pengguna</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Aksi</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Detail Aktivitas</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Alamat IP</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($logs as $log)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 text-xs text-slate-500 whitespace-nowrap">
                        {{ $log->created_at->format('d/m/Y H:i') }}
                        <div class="text-[10px] text-slate-400">{{ $log->created_at->diffForHumans() }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-slate-700">{{ $log->user->name ?? 'Sistem' }}</span>
                            <span class="text-[10px] text-indigo-500 font-medium uppercase tracking-tighter">{{ $log->peran }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $color = match(strtolower($log->aksi)) {
                                'login' => 'bg-emerald-100 text-emerald-700',
                                'tambah alat', 'tambah kategori' => 'bg-blue-100 text-blue-700',
                                'hapus' => 'bg-rose-100 text-rose-700',
                                'pinjam' => 'bg-amber-100 text-amber-700',
                                default => 'bg-slate-100 text-slate-700'
                            };
                        @endphp
                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $color }}">
                            {{ $log->aksi }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 italic">
                        "{{ $log->deskripsi }}"
                    </td>
                    <td class="px-6 py-4 text-xs font-mono text-slate-400">
                        {{ $log->alamat_ip }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                        Belum ada rekaman aktivitas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $logs->links() }}
    </div>
</div>
@endsection