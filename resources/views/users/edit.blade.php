@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-2 text-slate-500 text-sm mb-2">
            <a href="{{ route('users.index') }}" class="hover:text-indigo-600 transition">Data User</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-800 font-medium">Edit User</span>
        </div>
        <h1 class="text-2xl font-bold text-slate-800">Edit User</h1>
        <p class="text-sm text-slate-500">Perbarui informasi akun Admin atau Petugas</p>
    </div>

    <div class="max-w-2xl">
        @if ($errors->any())
            <div class="mb-5 flex gap-3 p-4 text-sm text-red-600 bg-red-50 rounded-xl border border-red-100">
                <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                <div>
                    <span class="font-bold">Gagal memperbarui:</span>
                    <ul class="mt-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-8">
                <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-user text-slate-400 text-sm"></i>
                            </div>
                            <input name="name" type="text" value="{{ old('name', $user->name) }}"
                                placeholder="Masukkan perubahan nama" required
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-envelope text-slate-400 text-sm"></i>
                            </div>
                            <input name="email" type="email" value="{{ old('email', $user->email) }}"
                                placeholder="Masukkan perubahan email" required
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Role Akses</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-shield-halved text-slate-400 text-sm"></i>
                            </div>
                            <select name="role" required
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm appearance-none">
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center gap-3">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl shadow-lg shadow-indigo-200 transition duration-200 font-semibold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-arrows-rotate"></i>
                            Perbarui User
                        </button>
                        <a href="{{ route('users.index') }}"
                            class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-2.5 rounded-xl transition duration-200 font-semibold text-sm">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection