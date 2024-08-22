<?php $__env->startSection('content'); ?>


<div class="login-outer">
    <div class="login-inner">

        <div class="logo-center">
            <img src="<?php echo e(asset('public/')); ?>/ui-images/logo/QuantumLogo-horiz-white-app@2x.png" class="image-placeholder" width="300" />
        </div>
        <div class="logo-center resetpasstext">
            RESET YOUR PASSWORD
        </div>

        <form method="POST" action="<?php echo e(route('password.email')); ?>">
            <?php echo csrf_field(); ?>
           
            <div class="row mb-3" syle="margin-top: 10em">

                <div class="col-md-6">
                    <input id="email" placeholder="Email" type="email" class="form-control <?php $__errorArgs = ['email'];
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
                      
            <div class="row mb-3">

                <div class="col-md-12" style="text-align: center">                
                    <button type="submit" class="btn btn-primary passwordlink">
                        <?php echo e(__('Send Password Reset Link')); ?>

                    </button>
                </div>           
                <div class="col-md-12 m1em" style="text-align: center">
                    <?php if(Route::has('login')): ?>
                    <a class="btn btn-link p-0 backtologin" href="<?php echo e(route('login')); ?>">
                        <?php echo e(__('Back to login')); ?>

                    </a>
                <?php endif; ?>
                </div>
            </div>
        </form>
        <div class="form p-135">
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<style>
    .content-outer {
        justify-content: center;
    }
    
.login-outer {

    justify-content: center;
    display: flex;
    margin-bottom: 20em;

}

.p-135 {
    padding: 1em;
}

.login-inner form {

    display: flex;
    flex-direction: column;
    width: 100%;
    align-items: center;
    margin-top: 3em

}

.login-heading {
        text-align: center;
    color: white;
}

.login-inner {
    padding: 3.5em;
    width: 613px;
height: 416px;
flex-shrink: 0;
border-radius: 25px;
background: rgba(143, 116, 188, 0.40);
}



.login-inner .form-control {
	width: 338px;
height: 41px;
flex-shrink: 0;
border-radius: 5px;
background: #FFF;
}

.login-inner .form-control::placeholder {
    color: #929292;
    font-size: 14px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.content-outer { 
    justify-item: center;
    margin-left: 0!important;
    /* text-color: #ffffff */
}

.banner-outer {
    display: none!important;
}

.logo-center {
    display:flex;
    justify-content: center;
}

.d-flex {
    display: flex;
}

.justify-space-between {
    justify-content: space-between
}

.justify-center {
    justify-content: center
}

.p-0 {
    padding: 0!important;
}

.p_05 {
    padding: 0.5em 0;
}

.btn-link {
    align-items: center;
    display: flex;
    padding: 12px 0;
}

.m1em {
    margin-top: 1em
}

.backtologin {
    color: #43EBF1!important;
    text-align: center;
    font-size: 14px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.register {
    width: 338px;
    height: 41px;
    flex-shrink: 0;
    font-family: Montserrat;
}

.resetpasstext {
    color: #FFF;
    text-align: center;
    font-size: 16px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    text-transform: uppercase;
    margin-top: 2em
}


.passwordlink {
    display: flex;
    width: 338px;
    height: 41px;
    justify-content: center;
    align-items: center;
    flex-shrink: 0;
    margin-top: 1.5em;
    color: #FFF;
    text-align: center;
    font-size: 14px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}
</style>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/main/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>