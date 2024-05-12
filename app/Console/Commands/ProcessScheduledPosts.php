<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CommandModule;
use App\Models\QuantumAcctMeta;
use Illuminate\Support\Facades\Auth;
use App\Helpers\TwitterHelper;
use PDOException;
use PDO;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
        try {
            // Connect to the database
            $pdo = new PDO('mysql:host=quantumapp.quantumsocial.io;dbname=quantum_app', 'quantumsocialio', '%T%2dN4s');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // Get the current datetime
            // $currentDateTime = now()->toDateTimeString();
            $currentDateTime = now()->format('Y-m-d H:i');
        
            // Fetch scheduled posts
            // $postsQuery = $pdo->prepare("SELECT * FROM posts WHERE sched_time <= :currentDateTime AND sched_method = 'schedule'");
            $postsQuery = $pdo->prepare("SELECT * FROM posts WHERE DATE_FORMAT(sched_time, '%Y-%m-%d %H:%i') = :currentDateTime");
            $postsQuery->bindParam(':currentDateTime', $currentDateTime, PDO::PARAM_STR);
            $postsQuery->execute();
            $scheduledPosts = $postsQuery->fetchAll(PDO::FETCH_ASSOC);

            if ($scheduledPosts) {
                \Log::info('ScheduledPosts retrieved' . json_encode($scheduledPosts));
            } else {
                \Log::error('ScheduledPosts not retrieved' . json_encode($scheduledPosts));
            }
        
            // Process scheduled posts
            foreach ($scheduledPosts as $post) {
               
                // Get Twitter meta
                $twitter_meta = $pdo->prepare("SELECT * FROM twitter_meta WHERE twitter_id = :twitter_id AND user_id = :user_id");
                $twitter_id = $post['twitter_id'];
                $user_id = $post['user_id'];
                $twitter_meta->bindParam(':twitter_id', $twitter_id, PDO::PARAM_STR);
                $twitter_meta->bindParam(':user_id', $user_id, PDO::PARAM_STR);
                $twitter_meta->execute();
                $userTwitterMeta = $twitter_meta->fetchAll(PDO::FETCH_ASSOC);
        
        
                $updateQuery = $pdo->prepare("UPDATE posts SET sched_method = 'send-now' WHERE id = :id AND DATE_FORMAT(sched_time, '%Y-%m-%d %H:%i') = :currentDateTime");
                $updateQuery->bindParam(':id', $post['id'], PDO::PARAM_INT);
                $updateQuery->bindParam(':currentDateTime', $currentDateTime, PDO::PARAM_STR);
                $success = $updateQuery->execute();

                \Log::info('Something went wrong: ' . json_encode($updateQuery));
        
                // If the post was successfully updated, post to Twitter
                if ($success) {

                    // Tweet the post
                    foreach ($userTwitterMeta as $twit) {
                        $postTweet = TwitterHelper::tweet2twitter($twit, ['text' => urldecode($post['post_description'])], "https://api.twitter.com/2/tweets");
                        \Log::info('Tweet result: ' . $postTweet);
                    }
                } else {
                    \Log::info('Something went wrong: ' . json_encode($post));
                }
        
            }
        
            \Log::info('Scheduled task completed successfully.');
        
      
        } catch (\Exception $e) {
            \Log::error('An error occurred: ' . $e->getMessage());
        }
        
    }
}
