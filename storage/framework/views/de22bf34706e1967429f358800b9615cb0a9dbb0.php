

<?php $__env->startSection('content'); ?>
    
<div class="row">
    <div class="col-6">
        <form action="<?php echo e(url('/postregister')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="mt-2">
                <label class="form-label" for="">Pelanggan</label>
                <input class="form-control" value="<?php echo e(old('pelanggan')); ?>" type="text" name="pelanggan">
                <span class="text-danger">
                    <?php $__errorArgs = ['pelanggan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <?php echo e($message); ?>

                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </span>
            </div>
            <div class="mt-2">
                <label  class="form-label" for="">Alamat</label>
                <input class="form-control" value="<?php echo e(old('alamat')); ?>" type="text" name="alamat">
                <span class="text-danger">
                    <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <?php echo e($message); ?>

                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </span>
            </div>
            <div class="mt-2">
                <label  class="form-label" for="">Telp</label>
                <input class="form-control" value="<?php echo e(old('telp')); ?>" type="text" name="telp">
                <span class="text-danger">
                    <?php $__errorArgs = ['telp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <?php echo e($message); ?>

                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </span> 
            </div>
            <div class="mt-2">
                <label  class="form-label col-4" for="">Jenis Kelamin
                <select class="form-select" name="jeniskelamin" id="">
                    <option value="L" >Laki</option>
                    <option value="P" >Perempuan</option>
                    <option value="non" selected>Non Binary</option>
                </select>
            </div>
            <div class="mt-2">
                <label  class="form-label" for="">Email</label>
                <input class="form-control" value="<?php echo e(old('email')); ?>" type="email" name="email">
                <span class="text-danger">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <?php echo e($message); ?>

                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </span>
            </div>
            <div class="mt-2">
                <label  class="form-label" for="">Password</label>
                <input class="form-control" type="password" name="password">
                <span class="text-danger">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <?php echo e($message); ?>

                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </span>
            </div>
            <div class="mt-4">
            <button class="btn btn-primary" type="submit">Register</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-restosmk\resources\views/register.blade.php ENDPATH**/ ?>