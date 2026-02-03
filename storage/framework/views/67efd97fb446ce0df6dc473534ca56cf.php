<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan</title>
</head>
<body>
    <center>
        <h2>LAPORAN PEMINJAMAN ALAT</h2>
    </center>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr bgcolor="#f2f2f2">
                <th>No</th>
                <th>Peminjam</th>
                <th>Nama Alat</th>
                <th>Tgl Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td align="center"><?php echo e($key + 1); ?></td>
                <td><?php echo e($item->nama_peminjam); ?></td>
                <td><?php echo e($item->alat->nama_alat ?? '-'); ?></td>
                <td align="center"><?php echo e(\Carbon\Carbon::parse($item->tgl_pinjam)->format('d/m/Y')); ?></td>
                <td align="center"><?php echo e(strtoupper($item->status)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" align="center">Tidak ada data peminjaman pada tanggal tersebut.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>window.onload = function() { window.print(); }</script>
</body>
</html><?php /**PATH D:\xampp\htdocs\peminjaman_alat\resources\views/cetaklaporan/index.blade.php ENDPATH**/ ?>