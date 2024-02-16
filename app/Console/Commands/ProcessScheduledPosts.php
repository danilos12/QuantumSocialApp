<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CommandModule;
use App\Models\QuantumAcctMeta;
use Illuminate\Support\Facades\Auth;
use App\Helpers\TwitterHelper;


class ProcessScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:scheduled-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process scheduled posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {      
        // get timezone of user's tool;
        // $timezone = QuantumAcctMeta::where
        $user = app('auth')->user();


        $scheduledPosts = CommandModule::where('sched_time', now())->get();
        echo $scheduledPosts;
        
        
        foreach ($scheduledPosts as $scheduledPost) {
            $scheduledPost->rt_ite = 4 ;
            $scheduledPost->save(); // Save the updated record
            $this->info("Updated rt_ite for CommandModule ID {$scheduledPost->id}");
            // Perform your action here (e.g., post a tweet)
        }

        $this->info('working'. $user);
    }
}
// return 0;
