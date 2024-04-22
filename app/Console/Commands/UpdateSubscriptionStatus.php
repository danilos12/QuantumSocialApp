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
use App\Helpers\MembershipHelper;

class UpdateSubscriptionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:subscription-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Subscription Status';

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
            $userMeta = $pdo->prepare("SELECT * FROM users");
            $userMeta->execute();            
            
            // Fetch all post results
            $get = $userMeta->fetchAll(PDO::FETCH_ASSOC);
            $result = [];        
    
            foreach($get as $user) {
                
                // get twitter meta
                $user_meta = $pdo->prepare("SELECT * FROM users_meta where user_id= :id");
                $user_id = $user['id'];    
                $user_meta->bindParam(':id', $user_id, PDO::PARAM_STR);
                $user_meta->execute();
                $res = $user_meta->fetchAll(PDO::FETCH_ASSOC);      
                
                if (count($res) > 0) {
                    // $res is not empty
                    // Do something with $res
                    foreach ($res as $meta) {                                                
                        // Process $meta
                        $api = MembershipHelper::apiGetCurl('https://quantumsocial.io/wp-json/plan/membership/subscription/?wp_user_id=' . $meta['wp_user_id']);                
                        $jsonStart = strpos($api, '{');
                            
                        // Extract JSON data
                        $jsonData = substr($api, $jsonStart);
                        
                        // Parse JSON
                        $parsedData = json_decode($jsonData, true);
            
                        $status = config('wp.status_labels');
        
                        if ($parsedData['n'] === 'valid') {
                            $now = strtotime(date("Y/m/d"));
                            $your_date = strtotime($parsedData['info']['trial_date']);
                            $datediff = $your_date - $now;
                            $days_diff = floor($datediff / (60 * 60 * 24));
                            $updateResult = QuantumAcctMeta::where('user_id', $user['id'])->update([
                                'trial_counter' => $days_diff,
                                'status' => $status[$parsedData['wc_status']],
                            ]);
            
                            // $result .= 'Status valid, table is updated. ID: ' . $user['id'] . PHP_EOL;
                            $result[] = [
                                'id' => $meta['id'],
                                'message' =>  'Has entry for user ID: ' . $meta['id'] . PHP_EOL,
                                'updated' => ($updateResult !== false && $updateResult > 0) ? true : false
                            ];

                        } else {
                            // $now = strtotime(date("Y/m/d"));
                            // $your_date = strtotime($parsedData['info']['trial_date']);
                            // $datediff = $your_date - $now;
                            // $days_diff = floor($datediff / (60 * 60 * 24));
                            // QuantumAcctMeta::where('user_id', auth()->id())->update([
                            //     'trial_counter' => $days_diff,
                            //     'status' => $status[$parsedData['wc_status']],
                            // ]);

                            $result[] = [
                                'status' => $parsedData['n'],
                                'message' => 'Status invalid, subscription for user ID: ' . $user['id'] . PHP_EOL
                            ]; 
                        }                    
                    }
                } else {
                    // $res is empty
                    // Handle the case where there is no user meta
                    $result[] = 'No entry for user ID: ' . $user['id'] . PHP_EOL;
                }
        
            }
    
            print_r($result);
            // Print formatted result to console
            // $this->info($result);

            //  Log a message to indicate the task is running
            echo 'Scheduled task is running now.';                

        } catch (PDOException $e) {
            // echo "PDO MySQL connection failed: " . $e->getMessage();

            echo 'PDO MySQL connection failed: ' . $e->getMessage();
        }  
    }
}
