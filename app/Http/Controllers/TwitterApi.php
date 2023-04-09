<?php

namespace App\Http\Controllers;

use App\Models\Twitter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TwitterApi extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getTweets($twitterId)
    {
        try {
            $headers = array(
                "Authorization: Bearer " . env('TWITTER_BEARER_TOKEN')
            );          

            $data = "tweet.fields=created_at,author_id,public_metrics,text,attachments";
            $url = "https://api.twitter.com/2/users/" . $twitterId . "/tweets";
            $request = $this->curlGetHttpRequest($url, $headers, $data);

            if (!empty($request->data)) {
                // get images of the tweet 
                foreach ($request->data as $v) {
                    if (property_exists($v, "attachments")) {
                        // call cURL request for API        
                        $data = "expansions=attachments.media_keys&media.fields=url";
                        $getAttachment = $this->curlGetHttpRequest("https://api.twitter.com/2/tweets/" . $v->id, array("Authorization: Bearer " . env('TWITTER_BEARER_TOKEN')), $data);

                        if (property_exists($getAttachment, 'includes')) {
                            $getAttachmentURL = $getAttachment->includes->media;
                            foreach ($getAttachmentURL as $media) {
                                $newObject = $media->url;
                                $v->image = $newObject;
                            }
                        }
                    }
                }

                // return the modified data as a JSON response
                return response()->json([
                    'status' => 200,
                    'data' => $request->data,
                ]);
            } else {
                return response()->json([
                    'status' => 201,
                    'message' => 'Tweets not found',
                    'b' => env("TWITTER_BEARER_TOKEN")
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }


    public function switchedAccount(Request $request) {

        $title = "Profile";
        
        try {
            $twitterId = $request->input('twitter_id');


            // Update the selected Twitter account
            $updated = DB::table('ut_acct_mngt')
                ->where('user_id', Auth::id())
                ->update([
                    'selected' => DB::raw("CASE WHEN twitter_id = $twitterId THEN 1 ELSE 0 END")
                ]);
           

            // Check if update was successful
            if ($updated) {
                return response()->json(['success' => true, 'message' => 'Tweets are updated', 'get_tweets' => 'getTweets']);
            } else {
                return response()->json(['success' => false, 'message' => 'Tweets are not updated']);                
            }
              
        } catch (\Exception $e) {
            
            return response()->json([
                'message' => 'Error updating records: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function tweets($id) {
        $tweets = $this->getTweets($id);
        return $tweets;
    }

    public function removeTwitterAccount(Request $request)
    {

        $id = $request->input('twitter_id');
        $delete = Twitter::where('twitter_id', $id)->update(['deleted' => 1]);

        return response()->json(['success' => true, "deleted" => $delete, 'message' => 'Twitter account is now deleted']);
    }

    public function curlGetHttpRequest($url, $headers,  $data) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url . "?" . $data);            
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        $response = curl_exec($curl);      
        $info = curl_getinfo($curl);     

        curl_close($curl);   
        
        if ($info['http_code'] == 200) {
            $data = json_decode($response);
            return $data;
        } else {
            return curl_error($curl);
        }
        
    }
    

}
