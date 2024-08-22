


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($title); ?></title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code&family=Montserrat&display=swap" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type='text/javascript' src="<?php echo e(asset('public/js/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('public/css/core.css')); ?>">
</head>
<body class="darkmode">
    <canvas></canvas>
    <div class="interface-outer">
        <div class="interface-inner">
            <div class="banner-inner">

              <img src="<?php echo e(asset('public/')); ?>/ui-images/logo/light-mode-logo.svg" class="image-placeholder" height="100%" alt="Quantum Social Logo" id="app-logo" />

            </div>
            
                <div class="error-inner ">
                    <?php echo $__env->yieldContent('content'); ?>
                
                </div>

            
        </div>
    </div>


    <script type='text/javascript' src="<?php echo e(asset('public/js/quantum2.js')); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php /**PATH D:\XAAMP\htdocs\Quantum\resources\views/layouts/errorpage.blade.php ENDPATH**/ ?>