<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->user()->role == 'Admin' ? 'layouts.membersdashboard' : redirect()->route('memberhome'));
?>

<?php if(is_string($layout)): ?>
    
<?php else: ?>
    <?php echo e($layout->send()); ?>

<?php endif; ?>

<?php $__env->startSection('content'); ?>
<div class="page-outer tag-groups-outer">
                <div class="page-inner tag-groups-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Tag Groups</span>
                    </div>  <!-- END .head-left-wrap -->
                    <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/add-post.svg" class="ui-icon new-tag-group-icon" />
                  </div>  <!-- END .page-head-n-sort -->

                  <div class="new-tag-group-modal-wrap">
                    <div class="new-tag-group-modal frosted">
                      <div class="new-title-wrap">
                        <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/18-tag-groups.svg" class="ui-icon" />
                        <span>New Tag Group Name:</span>
                      </div>  <!-- END .new-title-wrap -->
                      <form id="addNewTagGrp">
                        <input type="text" class="group-title-input" placeholder="New Tag Group title here..." />
                        <input type="submit" class="group-title-submit" value="Add New Tag Group" />
                      </form>
                    </div>  <!-- END .new-tag-group -->
                  </div>  <!-- END .new-tag-group-modal-wrap -->

                  <div class="tag-groups-tool-outer">
                    <div class="tag-groups-tool-inner">

                        <div class="tag-groups-column-wrap">

                          <div class="tag-groups-column tag-groups-left-column">
                            <div class="tag-groups-left-column-inside" id="tag-groups-content">

                            </div>  <!-- END .tag-groups-left-column-inside -->
                          </div>  <!-- END .tag-groups-left-column -->
                          <div class="tag-groups-column tag-groups-right-column section-hide">
                            <div class="tag-group-display">

                                <div class="tagset-wrap">

                                  <div class="add-tag-to-tagset">
                                    <form id="addTagForm">
                                      <input type="text" id="addTagForm_tags" name="addTagForm_tags" placeholder="Add a new tag here and press enter..." />
                                    </form>
                                    <div class="tag-container"></div>    
                                    <button class="copyButton" >Copy Tag items</button>                                
                                  </div>  <!-- END .add-tag-to-tagset -->                                  

                                </div>  <!-- END .tagset-wrap -->

                            </div>  <!-- END .tag-group-display -->
                        </div>  <!-- END .tag-groups-right-column -->                       
                        
                        </div>  <!-- END .tag-groups-column-wrap -->

                    </div>  <!-- END .tag-groups-tool-inner -->
                  </div>  <!-- END .tag-groups-tool-outer -->

                </div>  <!-- END .profile-inner -->
              </div>  <!-- END .profile-outer -->
<?php $__env->stopSection(); ?>

<style>
  .add-tag-to-tagset div input {
    width: 100%;
    background: none;
    color: var(--body-text);
    font-size: 1.35em;
    letter-spacing: .025em;
    padding: 0.25em 0;
    border: none;
    border-bottom: 2px solid var(--frost-background);
    margin-bottom: 1em;
  } ,

  .xtag{
    pointer-events: none;
    background-color: #242424;
    color: white;
    padding: 6px;
    margin: 5px;
  }

  .section-hide {
    display: none!important;
  }

  .xtag {
    pointer-events: all;
    display: inline-block;
    content: 'x';
    height: 20px;
    width: 20px;
    margin-right: 6px;
    text-align: center;
    color: #ccc;
    background-color: #111;
    cursor: pointer;
  }

  .badge {
  display: inline-block;
  padding: 0.3em 0.5em;
  background-color: #17a2b8;
  color: #fff;
  border-radius: 0.25rem;
}

.badge i {
  margin-right: 0.5em;
  cursor: pointer;
}

.badge i:hover {
  color: red;
}

</style>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('public/js/tag-groups.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/tags-groups.blade.php ENDPATH**/ ?>