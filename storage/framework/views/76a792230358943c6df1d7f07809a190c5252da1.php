<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : redirect()->route('memberhome'));
?>

<?php if(is_string($layout)): ?>
    
<?php else: ?>
    <?php echo e($layout->send()); ?>

<?php endif; ?>



<?php $__env->startSection('content'); ?>

<div class="page-outer scheduler-outer">
	<div class="page-inner scheduler-inner">

		<div class="page-head-n-sort">
			<div class="head-left-wrap">
				<span class="profile-heading">
				Slot Scheduler</span>
			</div>  <!-- END .head-left-wrap -->
		</div>  <!-- END .page-head-n-sort -->

		<div id="errorMessage" class="alert alert-danger" style="display: none;">
			<!-- Error message content goes here -->
			This is an error message.
		</div>

		<div class="slot-board-outer">
			<div class="slot-board-inner">

				<!-- BEGIN Row #1 (Days) -->
				<div class="slot-row slot-row-1">

				<div class="slot-cell title-cell null-cell time-cell">
					<div class="slot-cell-inner">

					</div>
				</div>  <!-- END .slot-cell -->
				<?php
					$Ndays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
				?>

				<?php for($i = 0; $i < count($Ndays); $i++): ?>
					<div class="slot-cell title-cell">
					<div class="slot-cell-inner colday" data-col="day-<?php echo e($i+1); ?>" data-text=<?php echo e(strtolower($Ndays[$i])); ?>>
						<?php echo e($Ndays[$i]); ?>

					</div>
					</div>  <!-- END .slot-cell -->
				<?php endfor; ?>

				</div>  <!-- END .slot-row -->
				<!-- END Column #1 (Dates) -->

				<!-- BEGIN Row #2 (12am) -->
				<?php for($hour = 0; $hour < 24; $hour++): ?>
				<div class="slot-row slot-row-2">
					<div class="slot-cell title-cell time-cell">
						<div class="slot-cell-inner" >
							<?php echo e($hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour)); ?> <?php echo e($hour === 0 ? 'AM' : (($hour >= 12) ? 'PM' : 'AM')); ?>

						</div>
					</div>

					<?php for($i = 1; $i <=7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell slot-cards" data-fulltime="<?php echo e($hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour)); ?> <?php echo e($hour === 0 ? 'AM' : (($hour >= 12) ? 'PM' : 'AM')); ?>" data-day="<?php echo e($days[$i]); ?>" data-time="<?php echo e($hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour)); ?>" data-ampm="<?php echo e($hour === 0 ? 'AM' : (($hour >= 12) ? 'PM' : 'AM')); ?>">
							<div class="c"></div>
							<div class="slot-cell-inner empty-slot" data-col="<?php echo e($i); ?>" data-row="<?php echo e($hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour)); ?>" data-fulltime="<?php echo e($hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour)); ?> <?php echo e($hour === 0 ? 'AM' : (($hour >= 12) ? 'PM' : 'AM')); ?>" data-day="<?php echo e($days[$i]); ?>" data-time="<?php echo e($hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour)); ?>" data-ampm="<?php echo e($hour === 0 ? 'AM' : (($hour >= 12) ? 'PM' : 'AM')); ?>">
								<img src="<?php echo e(asset('public')); ?>/ui-images/icons/pg-plus.svg" />
							</div>
						</div>  <!-- END .slot-cell -->
					<?php endfor; ?>
				</div>  <!-- END .slot-row -->
				<!-- END Row #2 (12am) -->
				<?php endfor; ?>


			</div>  <!-- END .slot-board-inner -->
		</div>  <!-- END .slot-board-outer -->



	</div>  <!-- END .scheduler-inner -->
</div>  <!-- END .scheduler-outer -->

<style>
	.scheduled-slot {
		justify-content: space-between;
	}
	.scheduled-slot-item > span {
		margin: 0.50em;
	}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type='text/javascript' src="<?php echo e(asset('public/js/schedule.js')); ?>"></script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/schedule.blade.php ENDPATH**/ ?>