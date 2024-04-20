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
            if (env('APP_ENV') === "local") {
                $pdo = new PDO('mysql:host=127.0.0.1;dbname=quantum_app', 'root', '');             
            } else {
                $pdo = new PDO('mysql:host=quantumapp.quantumsocial.io;dbname=quantum_app', 'quantumsocialio', '%T%2dN4s');             
            }

            // // Set PDO to throw exceptions on errors
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // // Prepare the SQL statement to get posts
            $postsQuery = $pdo->prepare("SELECT * FROM posts");
            $postsQuery->execute();            
            
            // Fetch all post results
            $scheduledPosts = $postsQuery->fetchAll(PDO::FETCH_ASSOC);
            $result = [];
            
            // // Process the results (if needed)
            foreach ($scheduledPosts as $post) {
                // convert all the time of post to UTC
                $datetime = Carbon::parse($post['sched_time']);

                // Convert the datetime to UTC
                $utcDateTime = $datetime->utc();                

                // $postsQuery->bindParam(':sched_time', $time, PDO::PARAM_STR);
                // get the timezone of user using user Id                                
                // $getTimezone = $pdo->prepare("SELECT * FROM users_meta where user_id= :id");
                // $id = $post['user_id'];    
                // $getTimezone->bindParam(':id', $id, PDO::PARAM_STR);
                // $getTimezone->execute();
                // $userTimezone = $getTimezone->fetchAll(PDO::FETCH_ASSOC);

                $id = $post['user_id'];      
                $serverTime = NOW();   
                $ss = $serverTime->utc();       

                // get twitter meta
                $twitter_meta = $pdo->prepare("SELECT * FROM twitter_meta where twitter_id= :twitter_id");
                $twitter_id = $post['twitter_id'];    
                $twitter_meta->bindParam(':twitter_id', $twitter_id, PDO::PARAM_STR);
                $twitter_meta->execute();
                $userTwitterMeta = $twitter_meta->fetchAll(PDO::FETCH_ASSOC);                                                               

                // Prepare the SQL statement to update the column in the posts table to send-now
                $updateQuery = $pdo->prepare("UPDATE posts SET sched_method = :new_value WHERE user_id = :id");
                $sched_method = 'send-now';

                // Bind parameters
                $updateQuery->bindParam(':new_value', $sched_method, PDO::PARAM_STR);
                $updateQuery->bindParam(':id', $id, PDO::PARAM_STR);
                $updateQuery->execute();


                // Fetch the updated rows
                $selectQuery = $pdo->prepare("SELECT * FROM posts WHERE user_id = :id AND sched_method = :new_value AND sched_time = :sched_time");
                $selectQuery->bindParam(':id', $id, PDO::PARAM_STR);
                $selectQuery->bindParam(':new_value', $sched_method, PDO::PARAM_STR);
                $selectQuery->bindParam(':sched_time', $utcDateTime, PDO::PARAM_STR); // change this to server time
                $selectQuery->execute();
                $scheduledNowPosts = $selectQuery->fetchAll(PDO::FETCH_ASSOC);

                
                foreach ($scheduledNowPosts as $row) {
                    foreach($userTwitterMeta as $twit) {
                        $postTweet = TwitterHelper::tweet2twitter($twit, array('text' => urldecode($post['post_description'])), "https://api.twitter.com/2/tweets");
                        
                        echo $postTweet;
                    }
                }                                                       
            }         

            //  Log a message to indicate the task is running
            echo 'Scheduled task is running now.';
                       
        } catch (PDOException $e) {
            // echo "PDO MySQL connection failed: " . $e->getMessage();

            echo 'PDO MySQL connection failed: ' . $e->getMessage();
        }      
    }
}
