<?php $__env->startSection('content'); ?>

<div class="page-outer bulk-outer">
                <div class="page-inner bulk-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Bulk Uploader</span>
                    </div>  <!-- END .head-left-wrap -->
                  </div>  <!-- END .page-head-n-sort -->

                  <div class="bulk-upload-section">
                    <span class="bulk-upload-title">Upload your .csv file:
                    <form>
                      <input type="file" accept="csv" class="bulk-upload-file-selector" />
                      <span class="bulk-upload-promo-title">
                        Upload entire file as Promo posts <i>(optional)</i>:
                      </span>
                      <select class="promo-select">
                        <option value="null">Select a Promo Campaign...</option>
                        <option>All Promo Titles Here</option>
                      </select>
                      <input type="submit" value="Schedule Your Posts" class="bulk-upload-submit" />
                    </form>

                  </div>  <!-- END .bulk-upload-section -->

                  <div class="uploader-tips">

                    <span class="uploader-tips-title">
                      How to format your CSV file:
                    </span>
                    <ul>
                      <li>Each row is a post or TweetStorm.</li>
                      <li>Only the first row is uploaded.</li>
                      <li>Maximum tweet length is 280 characters <i>( <a href="https://developer.twitter.com/en/docs/counting-characters" target="new">see more</a> )</i>.</li>
                      <li>Use \b to make new lines.</li>
                      <li>Use \b\b to make double spaced lines.</li>
                      <li>Use \b\b\b to make TweetStorm breakpoints <i>(threading)</i>.</li>
                      <li>To retweet, include only the full URL <i>(with https)</i> of the tweet.</li>
                      <li>To quote a tweet, just add the full URL <i>(with https)</i> at the end of your comment.</li>
                      <li>To include an image, place the full image URL <i>(with https)</i> between sets of double asterisks, like: **https://domain.com/image.png**</li>
                    </ul>
                    <a href="<?php echo e(asset('public/')); ?>/files/quantum-upload-template.csv" target="new" class="download-bulk-template">Download Our CSV Template</a>

                  </div>  <!-- END .uploader-tips -->

                </div>  <!-- END .bulk-inner -->
              </div>  <!-- END .bulk-outer -->


<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/bulk.blade.php ENDPATH**/ ?>