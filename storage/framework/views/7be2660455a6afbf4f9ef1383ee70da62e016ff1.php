<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e($title); ?></div>
					<form action="<?php echo e(route('update-password')); ?>" method="POST">
						<?php echo csrf_field(); ?>
						<div class="card-body">
							<?php if(session('status')): ?>
								<div class="alert alert-success" role="alert">
									<?php echo e(session('status')); ?>

								</div>
							<?php elseif(session('error')): ?>
								<div class="alert alert-danger" role="alert">
									<?php echo e(session('error')); ?>

								</div>
							<?php endif; ?>

							<div class="mb-3">
								<label for="oldPasswordInput" class="form-label">Old Password</label>
								<input name="old_password" type="password" class="form-control <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="oldPasswordInput"
									placeholder="Old Password">
								<?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<span class="text-danger"><?php echo e($message); ?></span>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
							<div class="mb-3">
								<label for="newPasswordInput" class="form-label">New Password</label>
								<input name="new_password" type="password" class="form-control <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="newPasswordInput"
									placeholder="New Password">
								<?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<span class="text-danger"><?php echo e($message); ?></span>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>
							<div class="mb-3">
								<label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
								<input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
									placeholder="Confirm New Password">
							</div>

						</div>

						<div class="card-footer">
							<button class="btn btn-success">Submit</button>
						</div>

					</form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/change-password.blade.php ENDPATH**/ ?>