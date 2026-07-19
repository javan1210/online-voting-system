
<?php $__env->startSection('title', 'Manage Voters'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1F4E79"><i class="bi bi-people me-2"></i>Registered Voters</h2>
    <span class="badge bg-primary fs-6"><?php echo e($voters->count()); ?> Total</span>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if($voters->isEmpty()): ?>
    <div class="alert alert-info">No voters registered yet.</div>
<?php else: ?>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background:#1F4E79; color:white;">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Full Name</th>
                    <th class="p-3">National ID</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Registered</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $voters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $voter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="p-3"><?php echo e($i + 1); ?></td>
                    <td class="p-3 fw-semibold"><?php echo e($voter->full_name); ?></td>
                    <td class="p-3"><?php echo e($voter->national_id); ?></td>
                    <td class="p-3"><?php echo e($voter->email); ?></td>
                    <td class="p-3"><?php echo e($voter->phone); ?></td>
                    <td class="p-3">
                        <?php if($voter->is_verified): ?>
                            <span class="badge bg-success">Verified</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Unverified</span>
                        <?php endif; ?>
                        <?php if($voter->locked_until && now()->lt($voter->locked_until)): ?>
                            <span class="badge bg-danger">Locked</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-3 small text-muted"><?php echo e($voter->created_at->format('d M Y')); ?></td>
                    <td class="p-3">
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="<?php echo e(route('admin.voters.edit', $voter)); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.voters.toggleVerify', $voter)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm btn-outline-<?php echo e($voter->is_verified ? 'warning' : 'success'); ?>">
                                    <i class="bi bi-<?php echo e($voter->is_verified ? 'x-circle' : 'check-circle'); ?>"></i>
                                </button>
                            </form>
                            <form method="POST" action="<?php echo e(route('admin.voters.destroy', $voter)); ?>" class="d-inline"
                                  onsubmit="return confirm('Delete this voter? This cannot be undone.')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<div class="mt-3">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ndeda\Documents\online-voting-system\resources\views/admin/voters/index.blade.php ENDPATH**/ ?>