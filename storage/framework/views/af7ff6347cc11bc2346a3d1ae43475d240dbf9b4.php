<?php $__env->startSection('content'); ?>
<div class="login-outer">
<div class="login-inner">

	<h1><?php echo e(__('Quantum Social Login')); ?> </h1>

 <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="row mb-3">
                           
                            <div class="col-md-6">
                                <input placeholder="Email Address" id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-3" style="margin-bottom: 10px;margin-top: 10px;">
                           
                            <div class="col-md-6">
                                <input placeholder="<?php echo e(__('Password')); ?>" id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">

                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="remember">
                                        <?php echo e(__('Remember Me')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
							 <div class="row mb-3">
                           
                            <div class="col-md-6">
							      <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Connect')); ?>

                                </button>
							</div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <?php if(Route::has('password.request')): ?>
                                    <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                        <?php echo e(__('Forgot Your Password?')); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
</div>
</div>

<style>

.login-outer {

    justify-content: center;
    display: flex;

}

.login-inner form {

    display: flex;
    flex-direction: column;
    width: 100%;

}



.login-inner input[type="email"], .login-inner input[type="password"] {
	padding-top: 10px;
	padding-left: 10px;
	padding-bottom: 10px;
	padding-right: 0px;
    margin-bottom: .75em;
    border-radius: 5px;
    font-size: .9em;
    border: none;
    color: #8843db;
	width: 100%;

}

.login-inner button {
	padding: 10px;
    background: #8843db;
    color: #fff;
	margin-bottom: .75em;
    border-radius: 5px;
    font-size: .9em;
    border: none;;
	width: 100%;
}

</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/auth/login.blade.php ENDPATH**/ ?>