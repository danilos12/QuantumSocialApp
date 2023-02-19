<?php $__env->startSection('content'); ?>

<?php if($title == 'Evergreen Tweets'): ?>
	
<h2><?php echo e($title); ?></h2>
<p>Carlo Ariel</p>
<?php endif; ?>

<?php if($title != 'Evergreen Tweets'): ?>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header"><?php echo e($title); ?></div>

					<div class="card-body">
						<?php if(session('status')): ?>
							<div class="alert alert-success" role="alert">
								<?php echo e(session('status')); ?>

							</div>
						<?php endif; ?>

						<?php echo e(__('You are logged in!')); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
		
<?php endif; ?>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/engagement.blade.php ENDPATH**/ ?>