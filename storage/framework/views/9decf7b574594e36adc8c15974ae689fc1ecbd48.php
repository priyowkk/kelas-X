

<?php $__env->startSection('admincontent'); ?>
    <div>
        <h1>Pelanggan</h1>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Telp</th>
                    <th>Status</th>
                </tr>
            </thead>
            <?php
                $no=1;
            ?>
            <tbody>
                <?php $__currentLoopData = $pelanggans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pelanggan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($pelanggan->pelanggan); ?></td>
                        <td><?php echo e($pelanggan->alamat); ?></td>
                        <td><?php echo e($pelanggan->email); ?></td>
                        <td><?php echo e($pelanggan->telp); ?></td>
                        <?php
                            if ( $pelanggan->aktif ==0) {
                                $aktif='<a href="'.url('admin/pelanggan/'.$pelanggan->idpelanggan).'">BANNED</a>';
                            } else {
                                $aktif='<a href="'.url('admin/pelanggan/'.$pelanggan->idpelanggan).'">AKTIF</a>';
                            }
                            
                        ?>
                        <td><?php echo $aktif; ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-2">
        <?php echo e($pelanggans->withQueryString()->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-restosmk\resources\views/backend/pelanggan/select.blade.php ENDPATH**/ ?>