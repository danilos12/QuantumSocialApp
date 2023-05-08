<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Schedule;
use Exception;


use Carbon\Carbon;

class PostingController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$title = 'Queue';
        return view('queue')->with('title', $title);
    }
	
	 public function queue()
    {
		$title = 'Queue';
        return view('queue')->with('title', $title);
    }
	
	 public function drafts()
    {
		$title = 'Drafts page';
        return view('drafts')->with('title', $title);
    }
	
	 public function posted()
    {
		$title = 'Posted';   
        return view('posted')->with('title', $title);
    }
	
	public function slot_scheduler()
    {
		$title = 'Slot Scheduler';
		$days = array(1 => 'sunday', 2 => 'monday', 3 => 'tuesday', 4 => 'wednesday', 5 => 'thursday', 6 => 'friday', 7 => 'saturday');
		
		$userId = Auth::id();
		
		$my_schedule = DB::table('schedule')->select('*')->where('user_id', '=', $userId)->orderBy('minute_at', 'asc')->get();
		
        return view('schedule', compact('title', 'days', 'my_schedule'));
		
    }
	
	public function add_new_slot() {
		$r = $_REQUEST;

		// dd($r);
		   
		if(!isset($r['days-selector'])) {
			return redirect('/schedule');
		} else {
			$userId = Auth::id();
			$current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"

			$list = array();
			$list[] = 'regular_tweets';
			if( !empty($r['make-promo']) ) { $list[] = $r['make-promo']; };
			if( !empty($r['make-evergreen']) ) { $list[] = $r['make-evergreen']; };
			if( !empty($r['make-tweetstorm']) ) { $list[] = $r['make-tweetstorm']; };
	
			$custom_slot = $r['days-selector'].'-'.ltrim($r['hour-selector'], '0').'-'.$r['am-pm-selector'];
			
			$validator = DB::table('schedule')->insert([
			'user_id' => $userId, 
			'slot_day' => $custom_slot,
			'minute_at' => $r['minute-selector'], 
			'post_type' => serialize($list)
			]);
			
			if( $validator ) {
				return response()->json(['status'=>'success', 'message'=> 'Successfully Added', 'in' => $custom_slot, 'n'=>'valid']);
			} else {
				return response()->json(['status'=>'error', 'message'=> 'Unable to process', 'n'=>'valid']);
			}
			
		}
		
		
		//$validator = Validator::make($request->all(),$rules);
		
	}

	public function schedule_save(Request $request) {
		try {
			$postSlot = $request->all();
			$captureDate = null; 

			if ($postSlot['days-selector'] !== 'weekdays' || $postSlot['days-selector'] !== 'weekend' || $postSlot['days-selector'] !== 'everyday') {
				// Create the date string based on the user input
				$parsed = ucfirst($postSlot['days-selector']) . " " . $postSlot['hour-selector'] . ":" . $postSlot['minute-selector'] . " " . $postSlot['am-pm-selector'];
				$day = strtoupper($postSlot['days-selector']);
				$captureDate = Carbon::parse($parsed);
				
				// Get the current date
				$currentDate = Carbon::now();
				$isSameDay = $captureDate->isSameDay($currentDate);
				$isEarlierTime = $captureDate->lt($currentDate);

				if ($isSameDay && $isEarlierTime) {					
					$captureDate = Carbon::parse($parsed)->next($day);
					$captureDate->hour($postSlot['hour-selector'])->minute($postSlot['minute-selector'])->second(0);
				}		
				
			}
			
			$datetime = $captureDate->format('Y-m-d H:i:s');

			$insertData = [
				'user_id' => Auth::id(),
				'slot_day' => $postSlot['days-selector'],
				'hour' => $postSlot['hour-selector'],
				'minute_at' => ($postSlot['minute-selector'] === null) ? '00' : $postSlot['minute-selector'],
				'ampm' => $postSlot['am-pm-selector'],
				'post_type' => $postSlot['make-promo']
			];

			$saved = Schedule::create($insertData);

			// Return success response
			return response()->json(['status' => '201', 'message' => 'Data has been created.', 'info' => $saved]);
		} catch (Exception $e) {
			Log::error('Error creating data: ' . $e->getMessage());
			return response()->json(['status' => '409', 'error' => 'Failed to create data.']);
		}
	}
	
	public function tweet_stormer()
    {
		$title = 'Tweet Stormer page';
        return view('posting')->with('title', $title);
    }
	
	public function bulk_uploader()
    {
		$title = 'Bulk Uploader';
        return view('bulk')->with('title', $title);
    }
	
	
	
}
