
<?php $__env->startSection('title', 'Audit Logs'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1F4E79"><i class="bi bi-journal-text me-2"></i>Audit Logs</h2>
    <span class="badge bg-primary fs-6"><?php echo e($logs->count()); ?> Entries</span>
</div>

<?php if($logs->isEmpty()): ?>
    <div class="alert alert-info">No activity recorded yet.</div>
<?php else: ?>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 small">
            <thead style="background:#1F4E79; color:white;">
                <tr>
                    <th class="p-3">Time</th>
                    <th class="p-3">User</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Action</th>
                    <th class="p-3">IP Address</th>
                    <th class="p-3">Outcome</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="p-3 text-muted"><?php echo e($log->created_at->format('d M Y, H:i:s')); ?></td>
                    <td class="p-3"><?php echo e($log->user_id ?? 'System'); ?></td>
                    <td class="p-3">
                        <span class="badge bg-<?php echo e($log->user_type === 'admin' ? 'danger' : 'primary'); ?>">
                            <?php echo e(ucfirst($log->user_type ?? 'system')); ?>

                        </span>
                    </td>
                    <td class="p-3"><?php echo e($log->action); ?>

                        <?php if($log->notes): ?>
                            <div class="text-muted"><?php echo e($log->notes); ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="p-3 text-muted"><?php echo e($log->ip_address ?? '—'); ?></td>
                    <td class="p-3">
                        <span class="badge bg-<?php echo e($log->outcome === 'success' ? 'success' : 'danger'); ?>">
                            <?php echo e(ucfirst($log->outcome)); ?>

                        </span>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ndeda\Documents\online-voting-system\resources\views/admin/audit-logs.blade.php ENDPATH**/ ?>