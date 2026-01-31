@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6 text-slate-800">
        <div>
            <h1 class="text-2xl font-bold">Data User</h1>
            <p class="text-sm text-slate-500 italic">Daftar semua Admin dan yang terdaftar di sistem.</p>
        </div>
        <a href="{{ route('users.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-200 transition duration-200 flex items-center gap-2 font-semibold">
            <i class="fa-solid fa-plus"></i>
            Tambah User
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @foreach ($users as $u)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 text-xs font-bold">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                                {{ $u->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $u->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($u->role == 'admin')
                                <span
                                    class="px-3 py-1 rounded-full bg-rose-100 text-rose-600 text-[11px] font-bold border border-rose-200">
                                    <i class="fa-solid fa-shield-halved mr-1"></i> ADMIN
                                </span>
                            @elseif($u->role == 'petugas')
                                <span
                                    class="px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-[11px] font-bold border border-blue-200">
                                    <i class="fa-solid fa-user-tie mr-1"></i> PETUGAS
                                </span>
                            @elseif($u->role == 'peminjam')
                                <span
                                    class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-600 text-[11px] font-bold border border-emerald-200">
                                    <i class="fa-solid fa-user mr-1"></i> SISWA
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex justify-center gap-3">
                                @if ($u->role !== 'peminjam')
                                    <a href="{{ route('users.edit', $u->id) }}"
                                        class="bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-lg hover:bg-indigo-600 hover:text-white transition duration-200 shadow-sm">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                @endif

                                <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-50 text-red-500 px-3 py-1.5 rounded-lg hover:bg-red-500 hover:text-white transition duration-200 shadow-sm"
                                        onclick="return confirm('Hapus user {{ $u->name }}?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
