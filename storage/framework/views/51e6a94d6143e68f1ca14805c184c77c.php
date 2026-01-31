

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <div class="flex items-center gap-2 text-slate-500 text-sm mb-2">
        <a href="<?php echo e(route('alat.index')); ?>" class="hover:text-indigo-600 transition">Data Alat</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <span class="text-slate-800 font-medium">Tambah Alat Baru</span>
    </div>
    <h1 class="text-2xl font-bold text-slate-800">Tambah Alat</h1>
    <p class="text-sm text-slate-500 italic">Daftarkan peralatan atau inventaris baru ke dalam sistem.</p>
</div>

<div class="max-w-2xl">
    <?php if($errors->any()): ?>
        <div class="mb-5 flex gap-3 p-4 text-sm text-red-600 bg-red-50 rounded-xl border border-red-100 shadow-sm">
            <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
            <div>
                <span class="font-bold">Gagal simpan:</span>
                <ul class="mt-1 list-disc list-inside text-xs">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-8">
            <form method="POST" action="<?php echo e(route('alat.store')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kode Alat</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            </div>
                            <input name="kode_alat" type="text" value="<?php echo e(old('kode_alat')); ?>"
                                placeholder="Masukkan Kode Alat" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Alat</label>
                        <input name="nama_alat" type="text" value="<?php echo e(old('nama_alat')); ?>"
                            placeholder="Masukkan Nama Alat" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                        <select name="kategori_id" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none text-sm appearance-none">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id); ?>" <?php echo e(old('kategori_id') == $k->id ? 'selected' : ''); ?>>
                                    <?php echo e($k->nama_kategori); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Stok</label>
                        <input name="stok" type="number" value="<?php echo e(old('stok', 0)); ?>" placeholder="0" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kondisi Fisik</label>
                        <select name="kondisi" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                            <option value="Baik" <?php echo e(old('kondisi') == 'Baik' ? 'selected' : ''); ?>>Baik</option>
                            <option value="Rusak" <?php echo e(old('kondisi') == 'Rusak' ? 'selected' : ''); ?>>Rusak</option>
                            <option value="Perbaikan" <?php echo e(old('kondisi') == 'Perbaikan' ? 'selected' : ''); ?>>Perbaikan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                        <select name="status" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                            <option value="Tersedia" <?php echo e(old('status') == 'Tersedia' ? 'selected' : ''); ?>>Tersedia</option>
                            <option value="Kosong" <?php echo e(old('status') == 'Kosong' ? 'selected' : ''); ?>>Kosong</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Alat</label>
                    <textarea name="deskripsi" rows="3" placeholder="Tambahkan deskripsi (opsional)"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none text-sm"><?php echo e(old('deskripsi')); ?></textarea>
                </div>

                <div class="pt-4 flex items-center gap-3">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl shadow-lg shadow-indigo-100 transition duration-200 font-semibold text-sm flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Alat
                    </button>
                    <a href="<?php echo e(route('alat.index')); ?>"
                        class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-2.5 rounded-xl transition duration-200 font-semibold text-sm text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\peminjaman_alat\resources\views/alat/create.blade.php ENDPATH**/ ?>