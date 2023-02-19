<?php $__env->startSection('content'); ?>

<div class="page-outer scheduler-outer">
                <div class="page-inner scheduler-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Slot Scheduler</span>
                    </div>  <!-- END .head-left-wrap -->
                  </div>  <!-- END .page-head-n-sort -->


                  <div class="slot-board-outer">
                    <div class="slot-board-inner">

                      <!-- BEGIN Row #1 (Days) -->
                      <div class="slot-row slot-row-1">

                        <div class="slot-cell title-cell null-cell time-cell">
                          <div class="slot-cell-inner">

                          </div>
                        </div>  <!-- END .slot-cell -->

                        <div class="slot-cell title-cell">
                          <div class="slot-cell-inner">
                            Sunday
                          </div>
                        </div>  <!-- END .slot-cell -->

                        <div class="slot-cell title-cell">
                          <div class="slot-cell-inner">
                            Monday
                          </div>
                        </div>  <!-- END .slot-cell -->

                        <div class="slot-cell title-cell">
                          <div class="slot-cell-inner">
                            Tuesday
                          </div>
                        </div>  <!-- END .slot-cell -->

                        <div class="slot-cell title-cell">
                          <div class="slot-cell-inner">
                            Wednesday
                          </div>
                        </div>  <!-- END .slot-cell -->

                        <div class="slot-cell title-cell">
                          <div class="slot-cell-inner">
                            Thursday
                          </div>
                        </div>  <!-- END .slot-cell -->

                        <div class="slot-cell title-cell">
                          <div class="slot-cell-inner">
                            Friday
                          </div>
                        </div>  <!-- END .slot-cell -->

                        <div class="slot-cell title-cell">
                          <div class="slot-cell-inner">
                            Saturday
                          </div>
                        </div>  <!-- END .slot-cell -->

                      </div>  <!-- END .slot-row -->
                      <!-- END Column #1 (Dates) -->


                      <!-- BEGIN Row #2 (12am) -->
                      <div class="slot-row slot-row-2">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            12am
                          </div>
                        </div> 
						 <!-- END .slot-cell -->
						<?php for($i = 1; $i <= 7; $i++): ?>
						<div  data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-12-am everyday-<?php echo e($days[$i]); ?>-12-am" id="<?php echo e($days[$i]); ?>-12-am">
                            <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-12-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">12:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  <?php break; ?>
								 <?php endif; ?>
								 <?php if('everyday-12-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">12:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-12-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">12:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-12-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">12:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">12:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-12-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>
                       <!-- END .slot-cell -->		

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #2 (12am) -->


                      <!-- BEGIN Row #3 (1am) -->
                      <div class="slot-row slot-row-3">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            1am
                          </div>
                        </div>  <!-- END .slot-cell -->

                         <!-- END .slot-cell -->
						<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-day="<?php echo e($days[$i]); ?>" data-hour="12" data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-1-am everyday-<?php echo e($days[$i]); ?>-1-am" id="<?php echo e($days[$i]); ?>-1-am">
                           <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-1-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">01:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-1-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">01:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-1-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">01:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-1-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">01:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">01:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-1-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>
                       <!-- END .slot-cell -->	

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #3 (1am) -->


                      <!-- BEGIN Row #4 (2am) -->
                      <div class="slot-row slot-row-4">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            2am
                          </div>
                        </div>  
							<!-- END .slot-cell -->
						<?php for($i = 1; $i <= 7; $i++): ?>
							
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-2-am everyday-<?php echo e($days[$i]); ?>-2-am" id="<?php echo e($days[$i]); ?>-2-am">
                         <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-2-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">02:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-2-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">02:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-2-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">02:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-2-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">02:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">12:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-2-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>
                       <!-- END .slot-cell -->	

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #4 (2am) -->


                      <!-- BEGIN Row #5 (3am) -->
                      <div class="slot-row slot-row-5">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            3am
                          </div>
                        </div>  
						<!-- END .slot-cell -->
						<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-3-am everyday-<?php echo e($days[$i]); ?>-3-am" id="<?php echo e($days[$i]); ?>-3-am">
                         <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-3-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">03:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-3-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">03:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-3-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">03:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-3-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">03:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">03:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-3-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #5 (3am) -->


                      <!-- BEGIN Row #6 (4am) -->
                      <div class="slot-row slot-row-6">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            4am
                          </div>
                        </div>  <!-- END .slot-cell -->

                        <!-- END .slot-cell -->
						<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-4-am everyday-<?php echo e($days[$i]); ?>-4-am" id="<?php echo e($days[$i]); ?>-4-am">
							<?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-4-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">04:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-4-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">04:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-4-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">04:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-4-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">04:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">04:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-4-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #6 (4am) -->


                      <!-- BEGIN Row #7 (5am) -->
                      <div class="slot-row slot-row-7">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            5am
                          </div>
                        </div>  <!-- END .slot-cell -->

						<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-5-am everyday-<?php echo e($days[$i]); ?>-5-am" id="<?php echo e($days[$i]); ?>-5-am">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-5-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">05:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-5-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">05:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-5-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">05:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-5-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">05:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">05:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-5-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #7 (5am) -->


                      <!-- BEGIN Row #8 (6am) -->
                      <div class="slot-row slot-row-8">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            6am
                          </div>
                        </div>  <!-- END .slot-cell -->
							<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-6-am everyday-<?php echo e($days[$i]); ?>-6-am" id="<?php echo e($days[$i]); ?>-6-am">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-6-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">06:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-6-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">06:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-6-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">06:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-6-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">06:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">06:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-6-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>
                      </div>  <!-- END .slot-row -->
                      <!-- END Row #8 (6am) -->


                      <!-- BEGIN Row #9 (7am) -->
                      <div class="slot-row slot-row-9">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            7am
                          </div>
                        </div>  <!-- END .slot-cell -->
						<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-7-am everyday-<?php echo e($days[$i]); ?>-7-am" id="<?php echo e($days[$i]); ?>-7-am">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-7-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">07:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-7-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">07:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-7-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 7; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">07:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-7-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">07:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">07:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-7-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #9 (7am) -->


                      <!-- BEGIN Row #10 (8am) -->
                      <div class="slot-row slot-row-10">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            8am
                          </div>
                        </div>  <!-- END .slot-cell -->
						<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-8-am everyday-<?php echo e($days[$i]); ?>-8-am" id="<?php echo e($days[$i]); ?>-8-am">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-8-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">08:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-8-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">08:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-8-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">08:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-8-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">08:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">08:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-8-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #10 (8am) -->


                      <!-- BEGIN Row #11 (9am) -->
                      <div class="slot-row slot-row-11">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            9am
                          </div>
                        </div>  <!-- END .slot-cell -->
						<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-9-am everyday-<?php echo e($days[$i]); ?>-9-am" id="<?php echo e($days[$i]); ?>-9-am">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-9-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">09:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-9-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">09:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-9-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">09:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-9-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">09:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">09:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-9-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #11 (9am) -->


                      <!-- BEGIN Row #12 (10am) -->
                      <div class="slot-row slot-row-12">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            10am
                          </div>
                        </div>  <!-- END .slot-cell -->
						<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-10-am everyday-<?php echo e($days[$i]); ?>-10-am" id="<?php echo e($days[$i]); ?>-10-am">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-10-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">10:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-10-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">10:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-10-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">10:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-10-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">10:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">10:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-10-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>
                       

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #12 (10am) -->


                      <!-- BEGIN Row #13 (11am) -->
                      <div class="slot-row slot-row-13">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            11am
                          </div>
                        </div>  <!-- END .slot-cell -->

                        <?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-11-am everyday-<?php echo e($days[$i]); ?>-11-am" id="<?php echo e($days[$i]); ?>-11-am">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-11-am' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">11:<?php echo e($myslot->minute_at); ?>am</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-11-am' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">11:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-11-am' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">11:<?php echo e($myslot->minute_at); ?>am</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-11-am' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">11:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">11:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-11-am">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #13 (11am) -->


                      <!-- BEGIN Row #14 (12pm) -->
                      <div class="slot-row slot-row-14">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            12pm
                          </div>
                        </div>  <!-- END .slot-cell -->
						<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-12-pm everyday-<?php echo e($days[$i]); ?>-12-pm" id="<?php echo e($days[$i]); ?>-12-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-12-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">12:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-12-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">12:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-12-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">12:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-12-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">12:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">12:<?php echo e($myslot->minute_at); ?>am</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-12-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div>  			
						
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #14 (12pm) -->


                      <!-- BEGIN Row #15 (1pm) -->
                      <div class="slot-row slot-row-15">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            1pm
                          </div>
                        </div>  <!-- END .slot-cell -->

                        <?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-1-pm everyday-<?php echo e($days[$i]); ?>-1-pm" id="<?php echo e($days[$i]); ?>-1-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-1-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">01:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								  <?php if('everyday-1-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">01:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-1-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">01:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-1-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">01:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">01:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-1-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div> 
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #15 (1pm) -->


                      <!-- BEGIN Row #16 (2pm) -->
                      <div class="slot-row slot-row-16">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            2pm
                          </div>
                        </div>  <!-- END .slot-cell -->
						<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-2-pm everyday-<?php echo e($days[$i]); ?>-2-pm" id="<?php echo e($days[$i]); ?>-2-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-2-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">02:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								   <?php if('everyday-2-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">02:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-2-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">02:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-2-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">02:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">02:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-2-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div> 
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #16 (2pm) -->


                      <!-- BEGIN Row #17 (3pm) -->
                      <div class="slot-row slot-row-17">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            3pm
                          </div>
                        </div>  <!-- END .slot-cell -->

                        <?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-3-pm everyday-<?php echo e($days[$i]); ?>-3-pm" id="<?php echo e($days[$i]); ?>-3-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-3-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">03:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								   <?php if('everyday-3-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">03:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-3-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">03:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-3-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">03:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">03:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-3-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div> 
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #17 (3pm) -->


                      <!-- BEGIN Row #18 (4pm) -->
                      <div class="slot-row slot-row-18">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            4pm
                          </div>
                        </div>  <!-- END .slot-cell -->

                         <?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-4-pm everyday-<?php echo e($days[$i]); ?>-4-pm" id="<?php echo e($days[$i]); ?>-4-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-4-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">04:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								   <?php if('everyday-4-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">04:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-4-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">04:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-4-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">04:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">04:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-4-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div> 
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #18 (4pm) -->


                      <!-- BEGIN Row #19 (5pm) -->
                      <div class="slot-row slot-row-19">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            5pm
                          </div>
                        </div>  <!-- END .slot-cell -->

                        <?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-5-pm everyday-<?php echo e($days[$i]); ?>-5-pm" id="<?php echo e($days[$i]); ?>-5-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-5-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">05:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								   <?php if('everyday-5-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">05:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-5-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">05:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-5-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">05:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">05:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-5-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div> 
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #19 (5pm) -->


                      <!-- BEGIN Row #20 (6pm) -->
                      <div class="slot-row slot-row-20">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            6pm
                          </div>
                        </div>  <!-- END .slot-cell -->
							<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-6-pm everyday-<?php echo e($days[$i]); ?>-6-pm" id="<?php echo e($days[$i]); ?>-6-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-6-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">06:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								   <?php if('everyday-6-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">06:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-6-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">06:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-6-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">06:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">06:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-6-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div> 
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #20 (6pm) -->


                      <!-- BEGIN Row #21 (7pm) -->
                      <div class="slot-row slot-row-21">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            7pm
                          </div>
                        </div>  <!-- END .slot-cell -->
						
						<?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-7-pm everyday-<?php echo e($days[$i]); ?>-7-pm" id="<?php echo e($days[$i]); ?>-7-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-7-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">07:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								   <?php if('everyday-7-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">07:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-7-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">07:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-7-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">07:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">01:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-7-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div> 
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #21 (7pm) -->


                      <!-- BEGIN Row #22 (8pm) -->
                      <div class="slot-row slot-row-22">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            8pm
                          </div>
                        </div>  <!-- END .slot-cell -->

                       <?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-8-pm everyday-<?php echo e($days[$i]); ?>-8-pm" id="<?php echo e($days[$i]); ?>-8-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-8-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">08:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								   <?php if('everyday-8-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">08:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-8-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">08:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-8-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">08:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">08:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-8-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div> 
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #22 (8pm) -->


                      <!-- BEGIN Row #23 (9pm) -->
                      <div class="slot-row slot-row-23">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            9pm
                          </div>
                        </div>  <!-- END .slot-cell -->
						 <?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-9-pm everyday-<?php echo e($days[$i]); ?>-9-pm" id="<?php echo e($days[$i]); ?>-9-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-9-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">09:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								   <?php if('everyday-9-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">09:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-9-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">09:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-9-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">09:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">09:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-9-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div> 
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #23 (9pm) -->


                      <!-- BEGIN Row #24 (10pm) -->
                      <div class="slot-row slot-row-24">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            10pm
                          </div>
                        </div>  <!-- END .slot-cell -->

                         <?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-10-pm everyday-<?php echo e($days[$i]); ?>-10-pm" id="<?php echo e($days[$i]); ?>-10-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-10-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">10:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								   <?php if('everyday-10-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">10:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-10-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">10:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-10-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">10:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">10:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-10-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div> 
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #24 (10pm) -->


                      <!-- BEGIN Row #25 (11pm) -->
                      <div class="slot-row slot-row-25">

                        <div class="slot-cell title-cell time-cell">
                          <div class="slot-cell-inner">
                            11pm
                          </div>
                        </div>  <!-- END .slot-cell -->

                       <?php for($i = 1; $i <= 7; $i++): ?>
						<div data-num="<?php echo e($i); ?>" class="slot-cell weekend-<?php echo e($days[$i]); ?>-11-pm everyday-<?php echo e($days[$i]); ?>-11-pm" id="<?php echo e($days[$i]); ?>-11-pm">
                          <?php $__currentLoopData = $my_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($days[$i].'-11-pm' == $myslot->slot_day): ?>
								 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
									<span class="slot-time">11:<?php echo e($myslot->minute_at); ?>pm</span>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
									<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
								  </div>
								  	<?php break; ?>
								 <?php endif; ?>
								   <?php if('everyday-11-pm' == $myslot->slot_day): ?>
								  <?php for($e = 1; $e <= 7; $e++): ?>
										<?php if($i == $e): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">11:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
									 <?php endif; ?>
								  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekdays-11-pm' == $myslot->slot_day): ?>
									  <?php for($wd = 2; $wd <= 6; $wd++): ?>	 
											<?php if($i == $wd): ?>
											<div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
											<span class="slot-time">11:<?php echo e($myslot->minute_at); ?>pm</span>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
											<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										  </div>
										   <?php endif; ?>
									  <?php endfor; ?>
								  <?php break; ?>
								 <?php endif; ?>
								  <?php if('weekend-11-pm' == $myslot->slot_day): ?>
									<?php if( $days[$i] == 'saturday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">11:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
									<?php if( $days[$i] == 'sunday' ): ?> 
									 <div class="slot-cell-inner scheduled-slot" id="scheduled-slot-<?php echo e($myslot->id); ?>">
										<span class="slot-time">11:<?php echo e($myslot->minute_at); ?>pm</span>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>" />
										<img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-scheduled-<?php echo e($myslot->id); ?>" data-id="<?php echo e($myslot->id); ?>"/>
									  </div>
									 <?php endif; ?>
								 
								  <?php break; ?>
								 <?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <div class="slot-cell-inner empty-slot" data-slot="<?php echo e($days[$i]); ?>-11-pm">
                            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plus.svg" />
                          </div>
                        </div> 
						<?php endfor; ?>

                      </div>  <!-- END .slot-row -->
                      <!-- END Row #25 (11pm) -->


                    </div>  <!-- END .slot-board-inner -->
                  </div>  <!-- END .slot-board-outer -->

                </div>  <!-- END .scheduler-inner -->
              </div>  <!-- END .scheduler-outer -->


<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/schedule.blade.php ENDPATH**/ ?>