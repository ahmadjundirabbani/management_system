<h2>Laporan Karyawan</h2>
<table border="1" width="100%" style="border-collapse: collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Gaji</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($k->Id); ?></td>
            <td><?php echo e($k->Nama); ?></td>
            <td><?php echo e(number_format($k->Gaji, 2)); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH C:\xampp\htdocs\management_system\resources\views/karyawan/pdf.blade.php ENDPATH**/ ?>