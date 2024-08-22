<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;
use Exception;
use PDOException;
use Illuminate\Support\Facades\Http;
class WP
{
    public static function decrypted_user_id_v1($data)
    {
        $decrypted = substr($data, 27, -13);
        $user_id = (int)$decrypted - 215;
        return $user_id;
    }

    public static function wp_user_id()
    {
        $user_id = null;
        if (Auth::guard('web')->check()) {
            $user_id = Auth::id();
        } elseif (Auth::guard('member')->check()) {
            $user_id = MembershipHelper::membercurrent();
        }

        if (!$user_id) {
            // Handle the case where the user is not authenticated
            throw new Exception("User is not authenticated.");
        }

        $wp_id = DB::table('users_meta')
            ->where('user_id', $user_id)
            ->value('wp_user_id');

        if (!$wp_id) {
            // Handle the case where wp_user_id is not found
            throw new Exception("wp_user_id not found for user_id: {$user_id}");
        }

        $decrypted = self::decrypted_user_id_v1($wp_id);
        return $decrypted;
    }

    public static function wp_status_and_wp_trialperiod()
    {
        $dbConnection = WP::external_db_connection();



        $table_prefix = 'wp_ftvis8_';

        try {
            
            $wp_user_id = self::wp_user_id();
  
        } catch (Exception $e) {
            // Handle the exception, e.g., log it and return a default value or null
            // Log::error($e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage()];
        }

        $getpost_id = $dbConnection->prepare("SELECT post_id FROM {$table_prefix}postmeta WHERE meta_key = '_customer_user' AND meta_value = :user_id ORDER BY meta_id DESC LIMIT 1");
        $getpost_id->bindParam('user_id', $wp_user_id, PDO::PARAM_INT);
        $getpost_id->execute();
        $post_id = $getpost_id->fetchAll(PDO::FETCH_ASSOC);

        if (empty($post_id)) {
            // Handle the case where no post_id is found
            return ['status' => 'error', 'message' => 'No post_id found for the given wp_user_id'];
        }

        $checkstatus = $dbConnection->prepare("SELECT post_status FROM {$table_prefix}posts WHERE ID = :p_id");
        $checkstatus->bindParam('p_id', $post_id[0]['post_id'], PDO::PARAM_INT);
        $checkstatus->execute();
        $getstatus = $checkstatus->fetchAll(PDO::FETCH_OBJ);
    
        if (empty($getstatus)) {
            // Handle the case where no post status is found
            return ['status' => 'error', 'message' => 'No post status found for the given post_id'];
        }
   
        $items = [];
        $items['status'] = $getstatus[0]->post_status;
       
        return $items;
    }
    public static function external_wp_rest_api($wp_user_id){
        $localUrl = 'http://app.quantumsocial.local';
        $stagingUrl = 'https://stg.app.quantumsocial.io';
        $liveUrl = 'https://app.quantumsocial.io';
        $appUrl = env('APP_URL');
        $currentRestApi = null;

        switch ($appUrl) {
            case $localUrl:
                $currentRestApi = Http::get('http://quantumsocial.local/wp-json/plan/membership/subscription?wp_user_id='. urlencode(base64_decode($wp_user_id)));
                break;
            case $stagingUrl:
                $currentRestApi = Http::get('https://stg.wp.quantumsocial.io/wp-json/plan/membership/subscription?wp_user_id='. urlencode(base64_decode($wp_user_id)));
                break;
            case $liveUrl:
                $currentRestApi = Http::get('https://billing.quantumsocial.io/wp-json/plan/membership/subscription?wp_user_id='. urlencode(base64_decode($wp_user_id)));
                break;
            default:
                throw new \Exception('Environment URL does not match any known environments.');
        }
        
        return $currentRestApi->json();
    }
    public static function external_db_connection()
    {
        $localUrl = 'http://app.quantumsocial.local';
        $stagingUrl = 'https://stg.app.quantumsocial.io';
        $liveUrl = 'https://app.quantumsocial.io';

        $appUrl = env('APP_URL');
        \Log::info('Environment details' . json_encode($appUrl));

        $hosts = null;
        $currentDb = null;
        $users = null;
        $password = null;

        switch ($appUrl) {
            case $localUrl:
                $hosts = '127.0.0.1';
                $users = 'root';
                $password = '';
                $currentDb = 'quantum_wp';
                break;
            case $stagingUrl:
                $hosts = 'quantumapp.quantumsocial.io';
                $users = 'quantumsocialio';
                $password = '%77*99hH3';
                $currentDb = 'quantum_wp_stg';
                break;
            case $liveUrl:
                $hosts = 'quantumapp.quantumsocial.io';
                $users = 'quantumsocialio';
                $password = '%77*99hH3';
                $currentDb = 'quantum_billing';
                break;
            default:
                throw new \Exception('Environment URL does not match any known environments.');
        }

        $charset = 'utf8mb4';
        $dsn = "mysql:host=$hosts;dbname=$currentDb;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $maxRetries = 3;
        $retryDelay = 100; // milliseconds

        for ($attempt = 0; $attempt < $maxRetries; $attempt++) {
            try {
                return new PDO($dsn, $users, $password, $options);
            } catch (\PDOException $e) {
                if ($attempt === $maxRetries - 1) {
                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
                }
                usleep($retryDelay * 1000); // Delay in microseconds
                $retryDelay *= 2; // Exponential backoff
            }
        }
    }


    public static function getUserSubscription($email) {
        try {
            $dbConnection = WP::external_db_connection();
            $table_prefix = 'wp_ftvis8_';

            // Prepare a SELECT query
            $stmt = $dbConnection->prepare("SELECT * FROM {$table_prefix}users WHERE user_email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch the first row as an associative array
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            \Log::info('user details' . json_encode($user));

            if (!$user) {
                return null; // Return null if no user found
            }


            // SELECT post join with postmeta
            // $subscription = $dbConnection->prepare("SELECT post_status FROM {$table_prefix}posts JOIN {$table_prefix}postmeta WHERE meta_value= :id AND post_type = shop_subscription DESC LIMIT 1");
            // $subscription = $dbConnection->prepare("SELECT * FROM {$table_prefix}posts JOIN {$table_prefix}postmeta WHERE meta_value= :id AND post_type = 'shop_subscription' ORDER BY ID DESC");
            // $subscription->bindParam(':id', $user['ID'], PDO::PARAM_INT);
            // $subscription->execute();
            // \Log::info('fetch row subs' . json_encode($subscription));

            $postmetaQuery = $dbConnection->prepare("
                SELECT * 
                FROM {$table_prefix}postmeta 
                WHERE meta_value = :id
                ORDER BY meta_id DESC
                LIMIT 1
            ");
            $postmetaQuery->bindParam(':id', $user['ID'], PDO::PARAM_INT);
            $postmetaQuery->execute();
            $postmeta = $postmetaQuery->fetch(PDO::FETCH_ASSOC);
            \Log::info('meta ' . json_encode($postmeta));

            if ($postmeta) {
                $postQuery = $dbConnection->prepare("
                    SELECT * 
                    FROM {$table_prefix}posts 
                    WHERE ID = :post_id 
                    AND post_type = 'shop_subscription'
                    ORDER BY ID DESC
                    LIMIT 1
                ");
                $postQuery->bindParam(':post_id', $postmeta['post_id'], PDO::PARAM_INT);
                $postQuery->execute();
                $post = $postQuery->fetch(PDO::FETCH_ASSOC);
            }

            if ($postmeta && $post) {
                \Log::info('Fetched Postmeta: ' . json_encode($postmeta));
                \Log::info('Fetched Post: ' . json_encode($post));

                // Fetch the first row as an associative array
                // $subscription = $post->fetch(PDO::FETCH_ASSOC);
                return $post;
            } else {
                \Log::info('No data found for the given criteria.');
                return false;
            }
         
        } catch (PDOException $e) {
            // Log the error and return null
            error_log('Database query error: ' . $e->getMessage());
            return null;
        }
    }
}
