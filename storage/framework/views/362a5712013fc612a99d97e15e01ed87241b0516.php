

<?php $__env->startSection('content'); ?>
<div class="logo-center">
    <img src="<?php echo e(asset('public/ui-images/logo/quantum-logo-white-lg.png')); ?>" class="image-placeholder" width="500" style="width: 434px; height: 98.957px; flex-shrink: 0;" />
</div>
<div class="login-outer" style="margin-top:4em">
    <div class="login-inner">

        <?php if(session()->has('login_error')): ?>

        <div class="alert alert-danger warning-sign"><?php echo e(session('login_error')); ?></div>
        <?php endif; ?>
        <form id="login-form" method="POST" action="<?php echo e(route('forauth')); ?>">

            <?php echo csrf_field(); ?>

            <div class="row mb-3">
                <div class="col-md-12">
                    <input placeholder="Email Address" id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12" style="margin-top: 1em">
                    <input placeholder="Password" id="password" type="password" class="form-control" name="password" autocomplete="current-password">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12 offset-md-4">
                    <div class="form-check p_05">
                        <div class="checkbox-wrapper">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-12">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btnlogin">
                        Connect
                    </button>
                </div>
            </div>

            <div class="d-flex justify-space-between m1em">
                <div class="p-2 flex flex-col items-start">
                    <?php if(Route::has('password.request')): ?>
                        <a class="btn btn-link p-0 forgotpass" href="<?php echo e(route('password.request')); ?>">
                            Forgot Your Password?
                        </a>
                    <?php endif; ?>
                    <a class="btn btn-link p-0 forgotpass" href="<?php echo e(env('APP_URL')); ?>/login">Login as Owner</a>
                </div>
                <div class="ml-auto p-2">
                    <?php if(Route::has('register')): ?>
                        <a class="btn btn-link p-0 signup" href="<?php echo e(route('register')); ?>">
                            Sign up
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    .items-start {
        align-items: flex-start;
    }
    .justify-start {
        justify-items: start;
    }
    .flex {
        display: flex;
    }
    .flex-col {
        flex-direction: column;
    }
    .login-outer {
        justify-content: center;
        display: flex;
    }
    .p-135 {
        padding: 1em 3.5em;
    }
    .login-inner form {
        display: flex;
        flex-direction: column;
        width: 100%;
    }
    .login-heading {
        text-align: center;
        color: white;
    }
    .login-inner {
        padding: 3.5em;
        border-radius: 25px;
        background: rgba(143, 116, 188, 0.40);
        width: 434px;
        height: auto;
        flex-shrink: 0;
    }
    .login-inner input[type="email"], .login-inner input[type="password"] {
        width: 338px;
        height: 41px;
        flex-shrink: 0;
        border-radius: 5px;
        background: #FFF;
    }
    .login-inner input::placeholder {
        color: #929292;
        font-size: 14px;
        font-family: Montserrat;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        font-family: 'Montserrat', sans-serif;
    }
    .login-inner button {
        width: 338px;
        height: 41px;
        flex-shrink: 0;
    }
    .form-check-input {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
    }
    .form-check-label {
        margin-top: 10px;
        color: #FFF;
        text-align: center;
        font-size: 14px;
        font-family: Montserrat;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
    .form-check-input {
        margin-right: 10px !important;
    }
    .checkbox-wrapper {
        display: flex;
        align-items: center;
    }
    .content-outer {
        justify-item: center;
        margin-left: 0;
    }
    .banner-outer {
        display: none;
    }
    .logo-center {
        display: flex;
        justify-content: center;
    }
    .d-flex {
        display: flex;
    }
    .justify-space-between {
        justify-content: space-between;
    }
    .p-0 {
        padding: 0;
    }
    .p_05 {
        padding: 0.5em 0;
    }
    .forgotpass {
        color: #FFF;
        text-align: center;
        font-size: 14px;
        font-family: Montserrat;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
    .signup {
        color: #43EBF1;
        text-align: center;
        font-size: 14px;
        font-family: Montserrat;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
    .btnlogin {
        color: #FFF;
        text-align: center;
        font-size: 14px;
        font-family: Montserrat;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
    .m1em {
        margin-top: 1em;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.membersdashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAAMP\htdocs\Quantum\resources\views/auth/memberlogin.blade.php ENDPATH**/ ?>