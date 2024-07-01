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
    protected $signature = 'subscription:update';

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

            // Connect to the database
            $pdo = env("APP_URL") == 'http://app.quantumsocial.local' ? new PDO('mysql:host=localhost;dbname=quantum_app', 'root', ''): new PDO('mysql:host=quantumapp.quantumsocial.io;dbname=quantum_app', 'quantumsocialio', '%T%2dN4s');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // // Prepare the SQL statement to get posts
            $users = $pdo->prepare("SELECT * FROM users");
            $users->execute();

            // Fetch all users results
            $users = $users->fetchAll(PDO::FETCH_ASSOC);
            $result = [];

            if ($users) {
                Log::info('Users retrieved: ' . json_encode($users));
            } else {
                Log::error('User not retrieved');
            }

             // Track user IDs for which the API has been called
            // $processedUserIds = [];

            // Process each user
            foreach ($users as $user) {
                // Log the user
                Log::info('Processing user: ' . json_encode($user));

                // Get user meta using the user ID
                $userMetaQuery = $pdo->prepare("SELECT * FROM users_meta WHERE user_id = :id");
                $userMetaQuery->bindParam(':id', $user['id'], PDO::PARAM_INT);
                $userMetaQuery->execute();
                $userMetas = $userMetaQuery->fetchAll(PDO::FETCH_ASSOC);

                // Process each user meta
                foreach ($userMetas as $userMeta) {
                    // Check if the API has already been called for this user ID
                    // Log the user meta
                    Log::info('Processing user meta: ' . json_encode($userMeta));

                    Log::info('subscription_id: ' . $userMeta['subscription_id']);

                    // Call the API

                    if($userMeta['subscription_id'] != 4){

                        $apiResult = env("APP_URL") == 'http://app.quantumsocial.local'? MembershipHelper::apiGetCurl('http://quantumsocial.local/wp-json/plan/membership/subscription/?wp_user_id=' . $userMeta['wp_user_id']):MembershipHelper::apiGetCurl('https://quantumsocial.io/wp-json/plan/membership/subscription/?wp_user_id=' . $userMeta['wp_user_id']);



                    // Get the HTTP status code of the API response
                    $httpStatusCode = $apiResult['httpStatusCode'];

                    // Check if the API call was successful
                    if ($httpStatusCode === 200) {
                        // API call was successful
                        Log::info('API request successful. HTTP status code: ' . $httpStatusCode);
                        Log::info('API response: ' . json_encode($apiResult['response']));

                        $jsonStart = strpos($apiResult['response'], '{');
                        $jsonData = substr($apiResult['response'], $jsonStart);
                        $parsedData = json_decode($jsonData, true);


                        $status = config('wp.status_labels');

                        if ($parsedData['n'] === 'valid') {
                            $now = strtotime(date("Y/m/d"));
                            $your_date = strtotime($parsedData['info']['trial_date']);
                            $datediff = $your_date - $now;
                            $days_diff = floor($datediff / (60 * 60 * 24));
                            $days_diff = max(0, $days_diff);
                            $updateResult = QuantumAcctMeta::where('user_id', $user['id'])->update([
                                'trial_counter' => $days_diff,
                                'status' => $status[$parsedData['wc_status']],
                            ]);

                            // $result .= 'Status valid, table is updated. ID: ' . $user['id'] . PHP_EOL;
                            $result[] = [
                                'id' => $userMeta['id'],
                                'message' =>  'Has entry for user ID: ' . $userMeta['id'] . PHP_EOL,
                                'updated' => ($updateResult !== false && $updateResult > 0) ? true : false
                            ];
                        }

                            // Process $apiResult
                    } else {
                        // API call failed
                        Log::error('API request failed. HTTP status code: ' . $httpStatusCode);

                        $updateResult = QuantumAcctMeta::where('user_id', $user['id'])->update([
                            'trial_counter' => 0,
                            'status' => 4,
                        ]);

                        $result[] = [
                            'status' => 'invalid',
                            'message' => 'Status invalid, subscription for user ID: ' . $user['id'] . PHP_EOL
                        ];
                    }

                }else{
                    Log::info('subscription_id_skipped: ' . $userMeta['subscription_id']);
                }
                }
            }

            Log::info('Scheduled task completed successfully.');

        } catch (\Exception $e) {

            Log::error('An error occurred: ' . $e->getMessage());
        }
    }
}
