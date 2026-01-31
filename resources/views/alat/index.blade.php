@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6 text-slate-800">
        <div>
            <h1 class="text-2xl font-bold">Data Alat</h1>
            <p class="text-sm text-slate-500 italic">Daftar inventaris peralatan dan perlengkapan sistem.</p>
        </div>
        <a href="{{ route('alat.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-200 transition duration-200 flex items-center gap-2 font-semibold">
            <i class="fa-solid fa-plus"></i>
            Tambah Alat
        </a>
    </div>

    @if (session('success'))
        <div
            class="mb-5 flex items-center gap-3 p-4 text-sm text-emerald-600 bg-emerald-50 rounded-xl border border-emerald-100">
            <i class="fa-solid fa-circle-check"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kode</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Alat</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kondisi</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($alat as $item)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                            {{ $item->kode_alat }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                            {{ $item->nama_alat }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                            {{ $item->kategori->nama_kategori }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 font-semibold">
                            {{ $item->stok }} <span class="text-[10px] text-slate-400">Unit</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($item->kondisi == 'Baik')
                                <span
                                    class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-600 text-[11px] font-bold border border-emerald-200 uppercase">
                                    Baik
                                </span>
                            @elseif($item->kondisi == 'Rusak')
                                <span
                                    class="px-3 py-1 rounded-full bg-rose-100 text-rose-600 text-[11px] font-bold border border-rose-200 uppercase">
                                    Rusak
                                </span>
                            @else
                                <span
                                    class="px-3 py-1 rounded-full bg-amber-100 text-amber-600 text-[11px] font-bold border border-amber-200 uppercase">
                                    Perbaikan
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($item->status == 'Tersedia')
                                <span class="flex items-center gap-1.5 text-[11px] font-bold text-emerald-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    TERSEDIA
                                </span>
                            @else
                                <span class="flex items-center gap-1.5 text-[11px] font-bold text-slate-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                    KOSONG
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('alat.edit', $item->id) }}"
                                    class="bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-lg hover:bg-indigo-600 hover:text-white transition duration-200 shadow-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('alat.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-50 text-red-500 px-3 py-1.5 rounded-lg hover:bg-red-500 hover:text-white transition duration-200 shadow-sm"
                                        onclick="return confirm('Hapus alat {{ $item->nama_alat }}?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-slate-500 italic">
                            Belum ada data alat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
