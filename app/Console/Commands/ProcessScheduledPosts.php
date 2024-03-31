<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CommandModule;
use App\Models\QuantumAcctMeta;
use Illuminate\Support\Facades\Auth;
use App\Helpers\TwitterHelper;
use Illuminate\Support\Facades\DB;
use PDOException;
use PDO;
use Illuminate\Support\Facades\Config;

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

            if (env('local')) {
                $pdo = new PDO('mysql:host=127.0.0.1;dbname=quantum_app', 'root', '');             
            } else {
                $pdo = new PDO('mysql:host=quantumapp.quantumsocial.io;dbname=quantum_app', 'quantumsocialio', '');             
            }

            // Set PDO to throw exceptions on errors
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare the SQL statement to get posts
            $postsQuery = $pdo->prepare("SELECT * FROM posts WHERE post_type = :post_type");
            $post_type = 'regular-tweets';
            $postsQuery->bindParam(':post_type', $post_type, PDO::PARAM_STR);
            $postsQuery->execute();
            
            // Fetch all post results
            $scheduledPosts = $postsQuery->fetchAll(PDO::FETCH_ASSOC);

            // $result =[];
            // Process the results (if needed)
            foreach ($scheduledPosts as $post) {
                // get the timezone of user using user Id                                
                // $getTimezone = $pdo->prepare("SELECT * FROM users_meta where user_id= :id");

                // // Bind parameters (if needed)
                // $id = $post['user_id'];    
                // $getTimezone->bindParam(':id', $id, PDO::PARAM_STR);

                // // Execute the query
                // $getTimezone->execute();

                // // Fetch results for Timezone
                // $userTimezone = $getTimezone->fetchAll(PDO::FETCH_ASSOC);

                // // Set scheduler timezone dynamically
                // Config::set('app.timezone', $userTimezone['timezone'] ?? 'UTC');

                // Prepare the SQL statement to update the column in the posts table
                $updateQuery = $pdo->prepare("UPDATE posts SET rt_ite = :new_value + 1 WHERE user_id = :id AND post_type = :post_type");

                // Define the new value you want to set for the column
                $newValue = 1;
                $newValu = $post['user_id'];
                $pt = 'regular-tweets';

                // Bind parameters
                $updateQuery->bindParam(':new_value', $newValue, PDO::PARAM_STR);
                $updateQuery->bindParam(':post_type', $pt, PDO::PARAM_STR);
                $updateQuery->bindParam(':id', $newValu, PDO::PARAM_STR);

                // Execute the update query
                $updateQuery->execute();
                
                echo "Rte is updated <br>";
            }
            // echo 'Running now ' . NOW();
            // dd($result);
                       
        } catch (PDOException $e) {
            echo "PDO MySQL connection failed: " . $e->getMessage();
        }      
    }
}
