
<?php $__env->startSection('admincontent'); ?>
<div>
    <h2>Update Data</h2>
</div>
<div class="row">
    <div class="col-6">
        <form action="<?php echo e(url('admin/postmenu/'.$menu->idmenu)); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <select class="form-select" name="idkategori">
                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if($kategori->idkategori==$menu->idkategori): echo 'selected'; endif; ?> value="<?php echo e($kategori->idkategori); ?>"><?php echo e($kategori->kategori); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <div>
                <label class="form-label" for="">Menu</label>
                <input class="form-control" type="text" value="<?php echo e($menu->menu); ?>" name="menu">
                <span class="text-danger"><?php $__errorArgs = ['menu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
            </div>
            <div>
                <label class="form-label" for="">deskripsi</label>
                <input class="form-control" type="text" value="<?php echo e($menu->deskripsi); ?>" name="deskripsi">
                <span class="text-danger"><?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
            </div>
            <div>
                <label class="form-label" for="">Harga</label>
                <input class="form-control" type="number" value="<?php echo e($menu->harga); ?>" name="harga">
                <span class="text-danger"><?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
            </div>
            <div>
                <label class="form-label" for="">Menu</label>
                <input class="form-control" type="file" value="<?php echo e($menu->gambar); ?>" name="gambar">
                <span class="text-danger"><?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
            </div>
            <div>
                <button class="btn btn-primary mt-2" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-restosmk\resources\views/backend/menu/update.blade.php ENDPATH**/ ?>