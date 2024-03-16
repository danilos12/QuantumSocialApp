<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\MembershipHelper;
use App\Models\Tag_groups;
class MemberCommandmodule extends Controller
{
    public function __constructor(){
        $this->middleware('member-access');
    }

    public function getTagGroups($id) {
        try {
            $userid;
            if(Auth::guard('member')->check()){
               $userid =  MembershipHelper::membercurrent();
            }elseif(Auth::guard('web')->check()){
                $userid = Auth::id();
            }

            $tagGroups = Tag_groups::where(['user_id' => $userid, 'twitter_id' => $id])->get();

            return response()->json([$tagGroups]);
        }  catch (Exception $e) {
            return response()->json(['status' => '400', 'message' => $e]);
        }
    }
}
