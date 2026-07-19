<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Online Voting System'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f0f4f8; }
        .navbar { background: linear-gradient(135deg, #1F4E79, #2E75B6); }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .btn-primary { background: #1F4E79; border-color: #1F4E79; }
        .btn-primary:hover { background: #2E75B6; border-color: #2E75B6; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark px-4 py-3">
        <a class="navbar-brand fw-bold fs-4" href="/"><i class="bi bi-check2-square me-2"></i>Online Voting System</a>
        <?php if(session('voter_id')): ?>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white"><i class="bi bi-person-circle me-1"></i><?php echo e(session('voter_name')); ?></span>
                <form method="POST" action="<?php echo e(route('voter.logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        <?php elseif(session('admin_id')): ?>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white"><i class="bi bi-shield-check me-1"></i><?php echo e(session('admin_name')); ?></span>
                <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        <?php endif; ?>
    </nav>
    <div class="container py-5">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\ndeda\Documents\online-voting-system\resources\views/layouts/app.blade.php ENDPATH**/ ?>