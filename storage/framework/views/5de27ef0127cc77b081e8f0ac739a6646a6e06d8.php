<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : null);
?>

<?php if($layout): ?>
    
<?php endif; ?>


<style>

    .content-inner {
        max-height: 100vh!important;
    }
</style>
<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="row justify-content-center">
        <div class="card">
            <!-- <div class="card-header"><?php echo e(('Dashboard')); ?></div>   -->

            <div class="card-body">
                <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
                
                <?php if(Session::has('twitterInfo')): ?>
                    <div class="alert alert-<?php echo e(Session::get('alert_type')); ?>" id="twitterInfoAlert">
                        <?php echo e(Session::get('twitterInfo')); ?>

                    </div>
                <?php endif; ?>
       

                <div class="first-row-container">
                    <div class="card75">
                        <div class="queued-single-post-wrapper queue-type-promo" status="active" queue-type="promo">
                            <div class="queued-single-post">
                            
                            <?php 
                             $tier = $plan->subscription_name;
                     
                             $specifictiers = $tier == 'astro' ? 'astral' : $tier; 
                            ?>
                            <img src="<?php echo e(asset('/public/ui-images/icons/tiers/' . $specifictiers . '.svg')); ?>" class="planet">

                            <div class="queued-single-start">
                                <span class="greeting">Hi,</span>
                                <span class="name"><?php echo e(isset($user) ? $user->email : 'Guest'); ?></span>
                            </div>  <!-- END .queue-single-start -->

                            <div class="queued-single-end">

                            </div>  <!-- END .queued-single-end -->

                            </div>  <!-- END .queued-single-post -->
                        </div>
                        <div class="card-below">
                            <div class="card-item-50">
                                <div class="a">
                                    

                                    <span class="actual">
                                        <?php echo e($plan->mo_post_credits === -1 ? '∞': $plan->mo_post_credits - $countPosts); ?>

                                    </span>

									<?php if( $plan ): ?>

									<?php else: ?>
									 <span class="total">Contact you administrator</span>
									<?php endif; ?>
                                </div>
                                <div class="b">
                                    Monthly post credits remaining
                                </div>
                            </div>
                            <div class="card-item-50">
                                <div class="a">
                                    <span class="actual"><?php echo e($plan->hashtag_group === -1?'∞': $plan->hashtag_group - $countHashtagGroups); ?></span>


                                    </span>
                                </div>
                                <div class="b">
                                    Hashtag <br> Groups Remaining
                                </div>
                            </div>
                        </div>
                        <div class="second-row-container">
                            <div class="card-item-25">
                                <div class="a card-col-a">
                                    <span class="actual"><?php echo e($plan->member_count - $countXaccts); ?></span>
                                </div>
                                <div class="b card-col-b">


                                    <span class="card-description2">X accounts Remaining </span>
                                </div>
                            </div>
                            <div class="card-item-25">
                                <div class="a card-col-a">
                                    <span class="actual"><?php echo e($plan->admin_count - $countAdmin); ?></span>
                                </div>
                                <div class="b card-col-b">


                                    <span class="card-description2">Admin Remaining </span>
                                </div>
                            </div>
                            <div class="card-item-25">
                                <div class="a card-col-a">
                                    <span class="actual"><?php echo e($plan->tm_count-$countTeamMembers); ?></span>
                                </div>
                                <div class="b card-col-b">


                                    <span class="card-description2">Team Members Remaining </span>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    <div class="card25 rounded-br w-full relative p-4">
                      
                            <div class="flex flex-col  items-center justify-center h-full rounded-br">
                         
                              <img src="<?php echo e(asset('/public/ui-images/icons/tiers/' . $specifictiers  .  '.svg')); ?>" class="planet-2" style="width: 133px; height: 145px">
                         
                          

                            <div class=" " style="display:flex;flex-direction: column;justify-content:center;align-items:center; width: 100%">
                               <span class="current-label">You are currently</span>
                            
							   	<?php if( !empty($plan) ): ?>

								  <span class="current-plan"><?php echo e(ucfirst($tier) == 'Astro' ?'Astral Lifetime': ucfirst($tier)); ?> </span>
								<?php else: ?>
								  <span class="current-plan">Contact your administrator </span>
								<?php endif; ?>


                                <?php echo e($hide = false); ?>

                                <?php if($hide): ?>
                               <span class="current-uplabel">need more features?</span>
                               <button id="upgrade-now" class="current-upgrade">Upgrade</button>
                                <?php endif; ?>
                            </div>  <!-- END .queue-single-start -->

                              <!-- END .queued-single-end -->
                                <div class="flex" >
                                    <div class="a card-col-a">
                                        <span class="actual"><?php echo e($countCredits); ?></span>
                                    </div>
                                    <div class="b card-col-b">
                                        <span class="card-description1">Trial Credits</span>
                                        <span class="card-description2">Remaining</span>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="a card-col-a">
                                        <span class="actual"><?php echo e($countTrial === -1 ? '∞' : $countTrial); ?></span>
                                    </div>
                                    <div class="b card-col-b">
                                        <span class="card-description1">days left in your</span>
                                        <span class="card-description2">Free Trial </span>
                                    </div>
                                </div>
                            </div>  <!-- END .queued-single-post -->
                      
        
               
                    </div>
                </div>
         
            
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<style>
.flex{
    display:flex;
}
.flex-col{
    flex-direction:column;
}
.items-center{
    align-items:center;
}
.justify-center{
    justify-content:center;
}
.h-full{
    height:100%;
}
.w-full{
    width:100%;
}
.relative{
    position:relative;
    overflow:hidden;
}
.p-4{
    padding:1rem;
}
.rounded-br{
    border-radius:25px;
}
.first-row-container,
.second-row-container, 
.third-row-container {
    display: flex;
 
        /* background-color: rgba(143, 116, 188, 0.1); */
}

.third-row-container {
 
     justify-content:center;
      margin: 14px;
}
.bg-red{
    background-color:red;
}
.bg-blue{
    background-color:blue;
}

.card-item-75 {
    display: flex;
    /* width: 740; */
    background: rgba(143, 116, 188, 0.4);
    margin: 2px;
    border-radius: 25px;
}

.card-below {
    display: flex;
    margin-bottom: 1em;
}
.card-item-50 {
    display: flex;
    height: 120px;
    width: 50%;
    /* background: #8F74BC; */
    background: rgba(143, 116, 188, 0.4);
    margin-right: 2em;
    border-radius: 25px;
}

.card-item-35 {
    display: flex;
    background-color: rgba(143, 116, 188, 0.1);
    margin: 2px;
    width: 50%
}

.a, .b {
    padding: 1em;
    display: flex;
    flex-direction: column;
}

.a {
    width: 40%;
    text-align: center;


}

.a span.actual {
    font-family: Montserrat;
    font-size: 48px;
    font-weight: bold;
    line-height: 1.2em;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;


}
.a span.total {
    font-family: Montserrat;
    font-size: 14px;
    text-transform: uppercase;
}

.b {
    font-family: Montserrat;
    font-size: 15px;
    text-transform: uppercase  ;
    display: flex;
    justify-content: center  ;
    width: 60%;
    padding: 1em;
}

span.metrics-text {
    position: absolute;
    left: 60px;
    top: 35%;
    font-family: Montserrat;
    font-size: 48px;
    font-weight: bold;
}

.card-item-25 {
    width: 100%;

    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    position: relative;
    padding: 1em;
    border-radius: 25px;
    background: rgba(143, 116, 188, 0.4);
    overflow: hidden;
    -webkit-line-clamp: 1;
    margin-right:2em;
}

.queued-single-post-wrapper {
    overflow: hidden!important;
}

.queued-single-post {
    flex-direction:column;
    border-radius: 20px!important;
    margin-right:2em;
    background: rgba(143, 116, 188, 0.4)!important;
    height: 100%;
    margin-bottom: 1em;
}

.queued-single-start span.greeting {
    font-size: 12px;
    font-family: Montserrat;
    text-transform: uppercase;
}

.queued-single-start span.name {
    font-size: 20px;
    font-weight: bold;
    font-family: Montserrat;
    margin-left: 1em
}

.card75 {
    display:flex;
    flex-direction:column;
    justify-content:center;
  flex: 0 0 75%; /* flex-grow: 0, flex-shrink: 0, flex-basis: 75% */
  margin: 2px;
}

.card25{
    display:flex;
    flex-direction:column;
background: rgba(143, 116, 188, 0.4);
  margin: 2px;
}

.container {
    height: 100vh!important
}

.card-col-a {
    width: 35%;
}

.card-col-b {
    width: 65%;
    padding-left: 1.5em
}
.card-description1 {
    font-size: 12px;
}
.card-description2 {
    font-size: 14px;
}

.planet {
    filter: white;
    position: absolute;
    top: -20px;
    left: -12px;
    width: 80;
    height: 87px;
    rotate: 25deg;
    opacity: 0.1;
    z-index: 51;
    rotate: 0deg;
}
.planet-2 {
    filter: white;
    position: absolute;
    top: 1px;
    left: 1px;

   
    opacity: 0.1;
    z-index: 51;
    rotate: 0deg;
}

.current-label {
    font-size: 10px;
    text-transform: uppercase;
    font-family: Montserrat;
}

.current-plan {
    font-size: 20px;
    font-weight: light;
    font-family: Montserrat;
    margin-bottom: 2em;
    color: #43EBF1;
}

.current-uplabel {
    text-transform: uppercase;
    font-family: Montserrat;
    font-size: 10px;
    margin-bottom: 1em;
}

.current-upgrade {
    background: rgba(67, 235, 241, 0.5);
    border: none;
    text-transform: uppercase;
    width: 100%;
    padding: 1em;
    font-family: Montserrat;
    font-size: 14px;
}
</style>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAAMP\htdocs\Quantum\resources\views/dashboard.blade.php ENDPATH**/ ?>