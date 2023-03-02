<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function getTweets($twitterId) {

        $headers = array(
            "Authorization: Bearer " . env('TWITTER_BEARER_TOKEN')
        );

        $data = "tweet.fields=created_at,author_id,public_metrics,text,attachments";
        $url = "https://api.twitter.com/2/users/" . $twitterId . "/tweets" ;
        $request = $this->curlGetHttpRequest($url, $headers, $data);

        if ($request->data) {

            // $obj = [];

            // get images of the tweet 
            foreach($request as $k => $v) {
                foreach($v as $info) {
                                        
                    if (isset($info->attachments->media_keys)) {

                        //call cURL request for API        
                        $data = "expansions=attachments.media_keys&media.fields=url";                
                        $getAttachment = $this->curlGetHttpRequest("https://api.twitter.com/2/tweets/" . $info->id, array("Authorization: Bearer " . env('TWITTER_BEARER_TOKEN')), $data);

                        $getAttachmentURL = $getAttachment->includes->media;                                               
                        foreach($getAttachmentURL as $media) {
                            $newObject = $media->url;
                            
                            
                            $info->image = $newObject;
                        }
                        
                        
                    } 
                }
                
            }
            // dd($request);
            return $request;

            // exit;
        } else {
            return response()->json("message", "Tweets are not pulled");
        }

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
