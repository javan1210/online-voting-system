
<?php $__env->startSection('title', 'Manage Candidates'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1F4E79"><i class="bi bi-person-badge me-2"></i>Candidates</h2>
    <a href="<?php echo e(route('admin.candidates.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add Candidate
    </a>
</div>
<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if($candidates->isEmpty()): ?>
    <div class="alert alert-info">No candidates yet. Add your first candidate!</div>
<?php else: ?>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background:#1F4E79; color:white;">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Full Name</th>
                    <th class="p-3">Party</th>
                    <th class="p-3">Position</th>
                    <th class="p-3">Election</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="p-3"><?php echo e($i + 1); ?></td>
                    <td class="p-3 fw-semibold"><?php echo e($candidate->full_name); ?></td>
                    <td class="p-3"><?php echo e($candidate->party ?? '—'); ?></td>
                    <td class="p-3"><?php echo e($candidate->position); ?></td>
                    <td class="p-3">
                        <span class="badge bg-primary"><?php echo e($candidate->election->title); ?></span>
                    </td>
                    <td class="p-3">
                        <a href="<?php echo e(route('admin.candidates.edit', $candidate)); ?>" class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.candidates.destroy', $candidate)); ?>" class="d-inline"
                              onsubmit="return confirm('Delete this candidate?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
                        </form>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ndeda\Documents\online-voting-system\resources\views/admin/candidates/index.blade.php ENDPATH**/ ?>