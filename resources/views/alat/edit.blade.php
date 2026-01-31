@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-2 text-slate-500 text-sm mb-2">
            <a href="{{ route('alat.index') }}" class="hover:text-indigo-600 transition">Data Alat</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-800 font-medium">Edit Alat</span>
        </div>
        <h1 class="text-2xl font-bold text-slate-800">Edit Alat: {{ $alat->nama_alat }}</h1>
        <p class="text-sm text-slate-500 italic">Perbarui informasi detail atau ketersediaan stok alat.</p>
    </div>

    <div class="max-w-2xl">
        @if ($errors->any())
            <div class="mb-5 flex gap-3 p-4 text-sm text-red-600 bg-red-50 rounded-xl border border-red-100 shadow-sm">
                <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                <div>
                    <span class="font-bold">Gagal memperbarui:</span>
                    <ul class="mt-1 list-disc list-inside text-xs">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-8">
                <form method="POST" action="{{ route('alat.update', $alat->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Kode Alat</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                </div>
                                <input name="kode_alat" type="text" value="{{ old('kode_alat', $alat->kode_alat) }}"
                                    required
                                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Alat</label>
                            <input name="nama_alat" type="text" value="{{ old('nama_alat', $alat->nama_alat) }}" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                            <select name="kategori_id" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none text-sm appearance-none">
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id }}"
                                        {{ $alat->kategori_id == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Stok</label>
                            <input name="stok" type="number" value="{{ old('stok', $alat->stok) }}" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Kondisi Fisik</label>
                            <select name="kondisi" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                                <option value="Baik" {{ $alat->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak" {{ $alat->kondisi == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                                <option value="Perbaikan" {{ $alat->kondisi == 'Perbaikan' ? 'selected' : '' }}>Perbaikan
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Status Operasional</label>
                            <select name="status" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                                <option value="Tersedia" {{ $alat->status == 'Tersedia' ? 'selected' : '' }}>Tersedia
                                </option>
                                <option value="Kosong" {{ $alat->status == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                                </option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Alat</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none text-sm">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                    </div>

                    <div class="pt-4 flex items-center gap-3">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl shadow-lg shadow-indigo-100 transition duration-200 font-semibold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-arrows-rotate"></i>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('alat.index') }}"
                            class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-2.5 rounded-xl transition duration-200 font-semibold text-sm">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
