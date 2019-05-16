    <?php if($strMessage =Session::get('success') ): ?>
        <div class="alert alert-success">
            <p><?php echo e($strMessage); ?></p>
        </div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <div id="app">
        <div class="container" >
            <div class="container" >
            <div class="row">
                <div class="col-md-3">
                    <resources></resources>
                </div>
            </div>

                <div class="container" >
                <div class="col-md-9">
                    <resources-index></resources-index>
                </div>
                </div>
            </div>
        </div>
    </div>
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>


<?php echo $__env->make('parent', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>