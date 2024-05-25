<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\CommandModule;
use App\Models\QuantumAcctMeta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\User;
use Illuminate\Support\Facades\DB;

class SchedulePosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
         //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $getTimezones = QuantumAcctMeta::get();
        // echo $getTimezones;

        
        // Post and change status for Regular, Comment and Retweet
        $RegularPosts = CommandModule::where('post_type', 'regular-tweets')                    
                    ->where('sched_time', now())
                    ->get();                    
                    
        // Post and change status for Evergreen and Promos
        $CampaignPosts = CommandModule::where('post_type', 'regular-tweets')
                    ->where('active', 0)
                    ->where('sched_time', now())
                    ->get();


           
        foreach ($RegularPosts as $RegularPost) {

            // get the user ID 
            $timezone = QuantumAcctMeta::where('user_id', $RegularPost->user_id)->get();
            echo $timezone; 
            // if ($RegularPost->active === 0) {
            //     $RegularPost->sched_method = 'save-draft';
            // } else {
            //     $RegularPost->sched_method = 'send-now';
            // }           
            // $RegularPost->save(); // Save the updated record
            // echo "Posted tweet: " . $RegularPost->user_id;
            // Perform your action here (e.g., post a tweet)
        }


    }
}
