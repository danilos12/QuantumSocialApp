<?php
namespace App\Http\Controllers\MemberController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\MembershipHelper;

use Illuminate\Support\Facades\DB;

class MemberPosting
{
	public function slot_scheduler()
    {
		$title = 'Slot Scheduler';
		$days = array(1 => 'sunday', 2 => 'monday', 3 => 'tuesday', 4 => 'wednesday', 5 => 'thursday', 6 => 'friday', 7 => 'saturday');

		$userId = MembershipHelper::membercurrent();

		$my_schedule = DB::table('schedule')->select('*')->where('user_id', '=', $userId)->orderBy('minute_at', 'asc')->get();

		// return view('schedule', compact('title', 'days', 'my_schedule', 'hasRegularTweetsInQueue'));

        return view('schedule', compact('title', 'days', 'my_schedule'));

    }
}

