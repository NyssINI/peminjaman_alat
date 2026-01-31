

<?php $__env->startSection('content'); ?>
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
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 text-xs text-slate-500 whitespace-nowrap">
                        <?php echo e($log->created_at->format('d/m/Y H:i')); ?>

                        <div class="text-[10px] text-slate-400"><?php echo e($log->created_at->diffForHumans()); ?></div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-slate-700"><?php echo e($log->user->name ?? 'Sistem'); ?></span>
                            <span class="text-[10px] text-indigo-500 font-medium uppercase tracking-tighter"><?php echo e($log->peran); ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <?php
                            $color = match(strtolower($log->aksi)) {
                                'login' => 'bg-emerald-100 text-emerald-700',
                                'tambah alat', 'tambah kategori' => 'bg-blue-100 text-blue-700',
                                'hapus' => 'bg-rose-100 text-rose-700',
                                'pinjam' => 'bg-amber-100 text-amber-700',
                                default => 'bg-slate-100 text-slate-700'
                            };
                        ?>
                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase <?php echo e($color); ?>">
                            <?php echo e($log->aksi); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 italic">
                        "<?php echo e($log->deskripsi); ?>"
                    </td>
                    <td class="px-6 py-4 text-xs font-mono text-slate-400">
                        <?php echo e($log->alamat_ip); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                        Belum ada rekaman aktivitas.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <?php echo e($logs->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\peminjaman_alat\resources\views/logaktivitas/index.blade.php ENDPATH**/ ?>