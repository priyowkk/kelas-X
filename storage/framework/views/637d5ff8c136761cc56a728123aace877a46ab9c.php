

<?php $__env->startSection('admincontent'); ?>
    <div>
        <h1>Order Detail</h1>
    </div>
        <form action="<?php echo e(url('admin/orderdetail/create')); ?>" method="get">
            <div class="row">
            <div class="col-4">
                <label class="form-label" for="">Tanggal Mulai</label>
                <input class="form-control" type="date" name="tglmulai">
            </div>
            <div class="col-4">
                <label class="form-label" for="">Tanggal Akhir</label>
                <input class="form-control" type="date" name="tglakhir">
            </div>
            <div class="col-4 mt-4">
                <button class="btn btn-primary mt-2" type="submit">Cari</button>
            </div>
        </div>
        </form>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <?php
                $no=1;
            ?>
            <tbody>
                <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($detail->tglorder); ?></td>
                        <td><?php echo e($detail->pelanggan); ?></td>
                        <td><?php echo e($detail->menu); ?></td>
                        <td><?php echo e($detail->harga); ?></td>
                        <td><?php echo e($detail->jumlah); ?></td>
                        <td><?php echo e($detail->total); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-2">
        <?php echo e($details->withQueryString()->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-restosmk\resources\views/backend/detail/select.blade.php ENDPATH**/ ?>