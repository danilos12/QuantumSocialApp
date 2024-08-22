<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : null);
?>

<?php if($layout): ?>
    
<?php endif; ?>

<?php $__env->startSection('content'); ?>

<div class="page-outer bulk-outer">
                <div class="page-inner bulk-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Bulk Uploader</span>
                    </div>  <!-- END .head-left-wrap -->
                  </div>  <!-- END .page-head-n-sort -->

                  <div id="errorContainer"></div>

                  <div class="bulk-flex-column">
                  

                  <div class="bulk-upload-section">
                    <span class="bulk-upload-title">Basic Upload: <span class="font-italic">(Please upload .csv file)</span>
                      <form id="uploadCsvForm" >
                        
                        <input type="file" accept=".csv" class="bulk-upload-file-selector" id="csvFileInput" />
                        
                        <input type="button" value="Schedule Your Posts" class="bulk-upload-submit" id="uploadCsv1"/>
                        
                    </form>

                    
                  </div>  <!-- END .bulk-upload-section -->
                 
                </div>               

                  <div class="uploader-tips">

                    <span class="uploader-tips-title">
                      How to format your CSV file:
                    </span>
                    <ul>
                      <li>The first row is the title for the columns </li>
                      <li>Only the first 10 row is uploaded.</li>
                      <li>Maximum post length is 280 characters <i>( <a href="https://developer.twitter.com/en/docs/counting-characters" target="new">see more</a> )</i>.</li>
                      <li>Use \b\b\b to make TweetStorm breakpoints <i>(threading)</i>.</li>
                      <li>To retweet, include only the full URL <i>(with https)</i> of the Post.</li>
                      <li>To quote a post, just add the full URL <i>(with https)</i> at the end of your comment.</li>
                      <li>Only links from Facebook is allowed, Instagram is still inprogress</li>
                      <li>To include an image, place the full image URL <i>(with https)</i> between sets of double asterisks, like: **https://domain.com/image.png**</li>
                    </ul>
                    <a href="<?php echo e(asset('public/')); ?>/files/quantum-upload-template.csv" target="new" class="download-bulk-template">Download Our CSV Template</a>

                  </div>  <!-- END .uploader-tips -->

                </div>  <!-- END .bulk-inner -->
              </div>  <!-- END .bulk-outer -->


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type='text/javascript' src="<?php echo e(asset('public/js/bulk.js')); ?>"></script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/bulk.blade.php ENDPATH**/ ?>