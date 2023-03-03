<?php

namespace App\Http\Controllers;

use App\Models\UT_AcctMngt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

        if ($request->meta->result_count > 0) {

            // $obj = [];

            // get images of the tweet 
            foreach($request->data as $k => $v) {
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
            return $request->data;

            // exit;
        } else {
            $message = array('status' => 201, 'message' => 'No tweets found.');

            return response()->json($message);
        }

    }

    public function switchedAccount($twitterId) {

        $title = "Profile";
        
        try {

            // update current Active twitter to disable
            $active = UT_AcctMngt::where(['selected' =>  1, 'user_id' => Auth::id()])->update(['selected' => 0]);

            // update the new selected
            $enabled = UT_AcctMngt::where('twitter_id' ,  $twitterId)->update(['selected' => 1]);

            // $disabled = UT_AcctMngt::where(['selected' =>  0, 'user_id' => Auth::id() ])->update(['selected' => 1])
    
            // $temp = $active['selected'];
            // $active->selected = $disabled['selected'];
            // $disabled->selected = $temp;

            // $active->save();
            // $disabled->save();

            // // DB::commit();

            if ($enabled && $active) {
                return redirect('profile')->with('title', $title)->with('alert', 'Tweets are updated')->with('alert_type', 'success');
            } else {
                return redirect('profile')->with('title', $title)->with('alert', 'Error in selecting')->with('alert_type', 'warning');
            }

        } catch (\Exception $e) {
            
            // return redirect('profile')->with('alert', 'Tweets are updated')->with('alert_type', 'success');
            return response()->json([
                'message' => 'Error updating records: ' . $e->getMessage(),
            ], 500);
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
