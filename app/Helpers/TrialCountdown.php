<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
USE PDO;

class TrialCountdown
{


    public static function decrypted_user_id_v1( $data  ) {

		$decrypted  = substr($data, 27, -13);
		$user_id = $decrypted  - 215;
		return $user_id;
	}

    public static function wp_user_id(){
        $user_id = null;
        if(Auth::guard('web')->check()){
            $user_id = Auth::id();
        }
        else{
          $user_id = MembershipHelper::membercurrent();
        }
     
        $wp_id = DB::table('users_meta')
        ->where('user_id', "=", $user_id)
        ->value('wp_user_id');

        $decrypted = self::decrypted_user_id_v1($wp_id);

        return $decrypted;
    }



    public static function wp_status_and_wp_trialperiod(){
        $pdo = env("APP_URL") == 'http://app.quantumsocial.local' ? new PDO('mysql:host=localhost;dbname=quantum_wp', 'root', ''): new PDO('mysql:host=quantumapp.quantumsocial.io;dbname=quantum_wp', 'quantumsocialio', '%T%2dN4s');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $table_prefix='wp_ftvis8_';
    // getting post_id using wp_user_id

        $wp_user_id = self::wp_user_id();
    $getpost_id = $pdo->prepare("SELECT post_id FROM {$table_prefix}postmeta  WHERE meta_key = '_customer_user' AND meta_value = :user_id ORDER BY meta_id DESC LIMIT 1");
    $getpost_id->bindParam('user_id',$wp_user_id,PDO::PARAM_INT);
    $getpost_id->execute();
    // getting the status using post_id
    $post_id = $getpost_id->fetchAll(PDO::FETCH_ASSOC);
    $checkstatus = $pdo->prepare("SELECT post_status FROM {$table_prefix}posts WHERE ID = :p_id");
    $checkstatus->bindParam('p_id',$post_id[0]['post_id'],PDO::PARAM_INT);
    $checkstatus->execute();
    $getstatus = $checkstatus->fetchAll(PDO::FETCH_OBJ);

    // getting the trial schedule for interval computation






    $items = [];
    $items['status'] = $getstatus[0]->post_status;

    return $items;


    }


}
