

<?php $__env->startSection('content'); ?>
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
                    <?php echo e($kategoriEdit ? 'Edit Kategori' : 'Tambah Kategori'); ?>

                </h3>
                
                <form action="<?php echo e($kategoriEdit ? route('kategori.update', $kategoriEdit->id) : route('kategori.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php if($kategoriEdit): ?>
                        <?php echo method_field('PUT'); ?>
                    <?php endif; ?>

                    <div class="mb-4">
                        <input type="text" name="nama_kategori"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition-all <?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Masukkan kategori alat" 
                            value="<?php echo e(old('nama_kategori', $kategoriEdit->nama_kategori ?? '')); ?>">
                        <?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-xs mt-1"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex flex-col gap-2">
                        <button type="submit"
                            class="w-full <?php echo e($kategoriEdit ? 'bg-amber-500 hover:bg-amber-600' : 'bg-indigo-600 hover:bg-indigo-700'); ?> text-white font-bold py-2.5 rounded-xl transition shadow-lg shadow-indigo-100">
                            <i class="fa-solid <?php echo e($kategoriEdit ? 'fa-pen-to-square' : 'fa-save'); ?> mr-2"></i>
                            <?php echo e($kategoriEdit ? 'Update Kategori' : 'Simpan Kategori'); ?>

                        </button>
                        
                        <?php if($kategoriEdit): ?>
                            <a href="<?php echo e(route('kategori.index')); ?>" class="w-full text-center bg-slate-100 text-slate-600 py-2.5 rounded-xl hover:bg-slate-200 transition text-sm font-semibold">
                                Batal
                            </a>
                        <?php endif; ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-slate-50/50 transition-colors <?php echo e($kategoriEdit && $kategoriEdit->id == $k->id ? 'bg-indigo-50/50' : ''); ?>">
                                <td class="p-4 text-sm text-slate-500"><?php echo e($loop->iteration); ?></td>
                                <td class="p-4 font-semibold text-slate-700">
                                    <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-xs">
                                        <?php echo e($k->nama_kategori); ?>

                                    </span>
                                </td>
                                <td class="p-4 flex justify-center gap-2">
                                    <a href="<?php echo e(route('kategori.edit', $k->id)); ?>"
                                        class="p-2 text-amber-500 hover:bg-amber-50 rounded-lg transition-all">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="<?php echo e(route('kategori.destroy', $k->id)); ?>" method="POST"
                                        onsubmit="return confirm('Hapus kategori ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\peminjaman_alat\resources\views/kategori/index.blade.php ENDPATH**/ ?>