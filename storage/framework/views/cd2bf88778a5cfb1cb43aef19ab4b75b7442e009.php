

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-6">
            <form action="<?php echo e(url('/postlogin')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <?php if(Session::has('pesan')): ?>
                <div class="alert alert-danger">
                    <?php echo e(Session::get('pesan')); ?>

                </div>
                <?php endif; ?>
                <div>
                    <label class="form-label" for="">Email</label>
                    <input class="form-control" value="<?php echo e(old('email')); ?>" type="text" name="email">
                    <span class="text-danger"><?php $__errorArgs = ['email'];
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
                    <label class="form-label" for="">password</label>
                    <input class="form-control" type="password" name="password">
                    <span class="text-danger"><?php $__errorArgs = ['password'];
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
                    <button class="btn btn-primary mt-2" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-restosmk\resources\views/login.blade.php ENDPATH**/ ?>