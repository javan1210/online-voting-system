
<?php $__env->startSection('title', 'Voter Login'); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4">
            <h3 class="text-center mb-4 fw-bold" style="color:#1F4E79">
                <i class="bi bi-box-arrow-in-right me-2"></i>Voter Login
            </h3>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><?php echo e($e); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('voter.login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">National ID</label>
                    <input type="text" name="national_id" class="form-control" value="<?php echo e(old('national_id')); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Login</button>
            </form>
            <p class="text-center mt-3">Not registered? <a href="<?php echo e(route('voter.register')); ?>">Register here</a></p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ndeda\Documents\online-voting-system\resources\views/auth/voter-login.blade.php ENDPATH**/ ?>