


<?php $__env->startSection('content'); ?>

<?php if(session('cart')): ?>

    <div>
        <div>
            <a class="btn btn-danger" href="<?php echo e(url('batal')); ?>">Batal</a>
        </div>
        <?php
            $no = 1;
            $total = 0;
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idmenu=>$menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($menu['menu']); ?></td>
                        <td><?php echo e($menu['harga']); ?></td>
                        <td>
                            <span><a href="<?php echo e(url('kurang/'.$menu['idmenu'])); ?>">[-]</a></span>
                            <?php echo e($menu['jumlah']); ?>

                            <span><a href="<?php echo e(url('tambah/'.$menu['idmenu'])); ?>">[+]</a></span>
                        </td>
                        <td><?php echo e($menu['jumlah'] * $menu['harga']); ?></td>
                        <td><a href="<?php echo e(url('hapus/'.$menu['idmenu'])); ?>">Hapus</a></td>
                    </tr>

                    <?php
                        $total = $total + ($menu['jumlah'] * $menu['harga']);
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td colspan="4">Total Pembayaran</td>
                    <td><?php echo e($total); ?></td>
                </tr>
            </tbody>
        </table>
        <div>
            <a class= "btn btn-success" href="<?php echo e(url('checkout')); ?>">Checkout</a>
        </div>
    </div>

<?php else: ?>
    <script>
        window.location.href = "/";
    </script>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-restosmk\resources\views/cart.blade.php ENDPATH**/ ?>