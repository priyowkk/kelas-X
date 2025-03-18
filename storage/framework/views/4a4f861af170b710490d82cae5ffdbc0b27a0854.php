

<?php $__env->startSection('admincontent'); ?>
    <div>
        <h1>Data User</h1>
    </div>
    <div>
        <a href="<?php echo e(url('admin/user/create')); ?>" class="btn btn-primary">Tambah Data</a>
        <?php if(session()->has('pesan')): ?>
            <p class="alert alert-danger"><?php echo e(session()->get('pesan')); ?></p>
        <?php endif; ?>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Ubah</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <?php
                $no=1;
            ?>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->level); ?></td>
                        <td><a href="<?php echo e(url('admin/user/'.$user->id.'/edit')); ?>">Ubah Password</a></td>
                        <td><a href="<?php echo e(url('admin/user/'.$user->id)); ?>">Hapus</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-restosmk\resources\views/backend/user/select.blade.php ENDPATH**/ ?>