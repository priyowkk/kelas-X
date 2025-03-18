

<?php $__env->startSection('admincontent'); ?>
    <div>
        <h1>Order</h1>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Tgl</th>
                    <th>total</th>
                    <th>bayar</th>
                    <th>kembali</th>
                    <th>status</th>
                </tr>
            </thead>
            <?php
                $no=1;
            ?>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><a href="<?php echo e(url('admin/order/'.$order->idorder.'/edit')); ?>"><?php echo e($order->pelanggan); ?></a></td>
                        <td><?php echo e($order->tglorder); ?></td>
                        <td><?php echo e($order->total); ?></td>
                        <td><?php echo e($order->bayar); ?></td>
                        <td><?php echo e($order->kembali); ?></td>
                        <?php
                            $status='LUNAS';
                            if ($order->status==0) {
                                $status='<a href="'.url('admin/order/'.$order->idorder).'">BAYAR</a>';
                            }
                        ?>
                        <td><?php echo $status; ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-2">
        <?php echo e($orders->withQueryString()->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-restosmk\resources\views/backend/order/select.blade.php ENDPATH**/ ?>