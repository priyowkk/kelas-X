

<?php $__env->startSection('admincontent'); ?>
    <div>
        <h1>Kategori</h1>
    </div>
    <div>
        <a href="<?php echo e(url('admin/kategori/create')); ?>" class="btn btn-primary">Tambah Data</a>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Ubah</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <?php
                $no=1;
            ?>
            <tbody>
                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($kategori->kategori); ?></td>
                        <td><a href="<?php echo e(url('admin/kategori/'.$kategori->idkategori.'/edit')); ?>">Ubah</a></td>
                        <td><a href="<?php echo e(url('admin/kategori/'.$kategori->idkategori)); ?>">Hapus</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-restosmk\resources\views/backend/kategori/select.blade.php ENDPATH**/ ?>