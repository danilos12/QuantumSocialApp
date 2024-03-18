<?php
namespace App\Http\Controllers\MemberController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\MembershipHelper;
use App\Models\Tag_groups;


class MemberGeneralSettings extends Controller
{
    public function __constructor(){
        $this->middleware('member-access');
    }


    public function saveSettings(Request $request) {

        $key = $request->input('meta_key');
        $value = $request->input('meta_value');
        $id = $request->input('id');


        try {
            $settings = null;
            switch ($id) {
                case "general-settings":
                    $userId = $request->input('user_id');
                    $settings = GeneralSettings::where('user_id', $userId)->update([$key => $value]);

                    $html = $this->renderTwitterAPiAccordion();

                    break;

                case "twitter-settings":
                    $twitterId = $request->input('twitter_id');
                    $settings = TwitterSettings::where('twitter_id' , $twitterId)->update([$key => $value]);

                    $html = TwitterSettings::where(['twitter_id' => $twitterId, $key => $value])->pluck($key)->first();
                    break;
            }

            if ($settings) {
                return response()->json(['status' => 200, 'stat' => 'success', 'html' => $html, 'message' => "Data has been updated"]);
            } else {
                return response()->json(['status' => 400, 'stat' => 'danger', 'message' => 'Failed to update your membership.']);
            }

        } catch(Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }

    }


    public function twitterApiCredentials(Request $request, $id) {
        try {
            $api = MasterTwitterApiCredentials::firstOrNew(['user_id' => MembershipHelper::membercurrent()]);

            if ($api->exists) {
                $api->user_id = MembershipHelper::membercurrent();
                $api->api_key = $request->input('api_key');
                $api->api_secret = $request->input('api_secret');
                $api->bearer_token = $request->input('bearer_token');
                $api->oauth_id = $request->input('oauth_id');
                $api->oauth_secret = $request->input('oauth_secret');
                $api->save();
                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Master API Credentials are succesfully updated']);
            } else {
                $api = new MasterTwitterApiCredentials($request->all());
                $api->user_id = MembershipHelper::membercurrent();
                $api->save();
                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Master API Credentials are successfully saved']);
            }

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }
    }

}