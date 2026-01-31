@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Kategori Alat</h2>
                <p class="text-slate-500 text-sm">Kelola kategori untuk pengelompokan alat</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 h-fit">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">
                    {{ $kategoriEdit ? 'Edit Kategori' : 'Tambah Kategori' }}
                </h3>
                
                <form action="{{ $kategoriEdit ? route('kategori.update', $kategoriEdit->id) : route('kategori.store') }}" method="POST">
                    @csrf
                    @if($kategoriEdit)
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <input type="text" name="nama_kategori"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition-all @error('nama_kategori') border-red-500 @enderror"
                            placeholder="Masukkan kategori alat" 
                            value="{{ old('nama_kategori', $kategoriEdit->nama_kategori ?? '') }}">
                        @error('nama_kategori')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <button type="submit"
                            class="w-full {{ $kategoriEdit ? 'bg-amber-500 hover:bg-amber-600' : 'bg-indigo-600 hover:bg-indigo-700' }} text-white font-bold py-2.5 rounded-xl transition shadow-lg shadow-indigo-100">
                            <i class="fa-solid {{ $kategoriEdit ? 'fa-pen-to-square' : 'fa-save' }} mr-2"></i>
                            {{ $kategoriEdit ? 'Update Kategori' : 'Simpan Kategori' }}
                        </button>
                        
                        @if($kategoriEdit)
                            <a href="{{ route('kategori.index') }}" class="w-full text-center bg-slate-100 text-slate-600 py-2.5 rounded-xl hover:bg-slate-200 transition text-sm font-semibold">
                                Batal
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="p-4 text-xs font-bold text-slate-500 uppercase">No</th>
                            <th class="p-4 text-xs font-bold text-slate-500 uppercase">Nama Kategori</th>
                            <th class="p-4 text-xs font-bold text-slate-500 uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($kategoris as $k)
                            <tr class="hover:bg-slate-50/50 transition-colors {{ $kategoriEdit && $kategoriEdit->id == $k->id ? 'bg-indigo-50/50' : '' }}">
                                <td class="p-4 text-sm text-slate-500">{{ $loop->iteration }}</td>
                                <td class="p-4 font-semibold text-slate-700">
                                    <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-xs">
                                        {{ $k->nama_kategori }}
                                    </span>
                                </td>
                                <td class="p-4 flex justify-center gap-2">
                                    <a href="{{ route('kategori.edit', $k->id) }}"
                                        class="p-2 text-amber-500 hover:bg-amber-50 rounded-lg transition-all">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('kategori.destroy', $k->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection