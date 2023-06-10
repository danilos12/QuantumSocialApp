<?php

namespace App\Http\Controllers;

use App\Helpers\TwitterHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Schedule;
use App\Models\CommandModule;
use App\Models\TwitterSettingsMeta;
use App\Models\TwitterToken;
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
			dd(1);
			return redirect('/schedule');
		} else {
			dd(12);
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

			if ($request->action === "edit") {
				$update = Schedule::find($postSlot['id']);

				if (isset($postSlot['make-promo'])) {
					foreach ($postSlot['make-promo'] as $promo) {
						$update->user_id = Auth::id();
						$update->slot_day = $postSlot['days-selector'];
						$update->hour = $postSlot['hour-selector'];
						$update->minute_at = ($postSlot['minute-selector'] === null) ? '00' : $postSlot['minute-selector'];
						$update->ampm = $postSlot['am-pm-selector'];
						$update->post_type = $promo;
					}
				} else {
					// foreach ($request->make_promo as $promo) {
						$update->user_id = Auth::id();
						$update->slot_day = $postSlot['days-selector'];
						$update->hour = $postSlot['hour-selector'];
						$update->minute_at = ($postSlot['minute-selector'] === null) ? '00' : $postSlot['minute-selector'];
						$update->ampm = $postSlot['am-pm-selector'];
						$update->post_type = 'regular-tweets';
					// }
				}
				// dd($update);

				$update->save();

				// Return the JSON response
				return response()->json(['status' => '200', 'message' => 'Schedule has been updated.', 'info' => $update]);

			} else {				
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
				
				// $datetime = $captureDate->format('Y-m-d H:i:s');
	
				$insertData = [
					'user_id' => Auth::id(),
					'slot_day' => $postSlot['days-selector'],
					'hour' => $postSlot['hour-selector'],
					'minute_at' => ($postSlot['minute-selector'] === null) ? '00' : $postSlot['minute-selector'],
					'ampm' => $postSlot['am-pm-selector'],				
				];
	
				if (isset($postSlot['make-promo'])) {
					$categories = $postSlot['make-promo'];
					foreach ($categories as $category) {
						$insertData['post_type'] = $category;
						$saved = Schedule::create($insertData);
					}
				} else {
					$insertData['post_type'] = 'regular-tweets';
					$saved = Schedule::create($insertData);
				}
	
				if ($saved) {
					// Return success response
					return response()->json(['status' => '200', 'message' => 'Schedule has been created.', 'info' => $saved]);
				}
			}

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
	
	public function editPost(Request $request, $id) {
		$post_id = str_replace('edit-modal-', '', $request->id);
		$queuePosts = CommandModule::where('id', $post_id)->first();

		$countTweet =  CommandModule::where('post_type_code', $queuePosts->post_type_code)->count();

		if ($countTweet > 1) {
			$queuePosts['tweet_storm'] = $countTweet;
		} else {
			$queuePosts['tweet_storm'] = 1;
		}		
		
		// Return the view with the retrieved data
		$html = view('modals.edit-commandmodule')->render();
		return response()->json(['status' => 201, 'data' => $queuePosts, 'html' => $html]);
	}
	
	public function deletePost(Request $request) {
		$post_id = str_replace('delete-', '', $request->id);
		$queueDelete = CommandModule::where('id', $post_id)->update(['deleted' => 1]);		

		// Redirect back to the previous page or any desired location
		return response()->json(['success' => true, 'data' => $queueDelete]);
	}
	
	public function sortPostbyType(Request $request) {
		$sort = null;

		if ($request->type !== "all" ) {
			$type = $request->type . '-tweets';
			$sort = CommandModule::where(['twitter_id' => $request->id, 'post_type' => $type, 'deleted' => 0])->orderBy('sched_time', 'ASC')->get();
		} else {
			$sort = CommandModule::where(['twitter_id' => $request->id, 'deleted' => 0])->orderBy('sched_time', 'ASC')->get();
		}

		// Redirect back to the previous page or any desired location
		return response()->json(['success' => true, 'data' => $sort]);
	}	

	public function switchFromQueue($switch, $id) {		
		try {
			$k = ($switch === 'active') ? 1 : 0;
			
			//update first the switch
			TwitterToken::where('twitter_id', $id)->where('active', 1)->update(['queue_switch' => $k]);
			
			$sort = DB::table('cmd_module')
				// ->join('twitter_meta', 'cmd_module.twitter_id', '=', 'twitter_meta.twitter_id')
				// ->join('ut_acct_mngt', 'qts_tweetmeta.twitter_id', '=', 'ut_acct_mngt.twitter_id')
				->select('*')
				->where('twitter_id', $id)
				->where('post_type', '!=', 'evergreen-tweets')
				->where('post_type', '!=', 'promos-tweets')
				->where('post_type', '!=', 'tweet-storm-tweets')
				->where('active', '=', ($switch === 'active') ? 1: 0)
				->where('sched_time', '>', TwitterHelper::now(Auth::id()))
				->get();

			return response()->json(['status' => 200, 'data' => $sort]);
		} catch (Exception $e) {
			Log::error('Error creating data: ' . $e->getMessage());
			return response()->json(['status' => '409', 'error' => 'Switched data']);
		}
	}

	public function getScheduledSlots (Request $request) {
		try {
			// get all the shedule that is under user_id
			$slot = Schedule::where('user_id', Auth::id())->get();
			
			return response()->json(['status' => 200, 'message' => 'Get schedule', 'data' => $slot]);
		} catch (Exception $e) {
			Log::error('Error creating data: ' . $e->getMessage());
			return response()->json(['status' => '409', 'error' => 'Switched data']);
		}

	}
	
	public function sortPostbyMonth(Request $request) {		
		$convertDate = str_replace('-', ' ', $request->month);

		$date = intval(Carbon::createFromFormat('F Y', $convertDate)->format('m'));
		
		// $sort = CommandModule::where(['twitter_id' => $request->id, 'sched_time' => $date, 'deleted' => 0])->orderBy('sched_time', 'ASC')->get();
		$sort = DB::table('cmd_module')
				->select('*')
				->where('twitter_id', $request->id)
				->where('post_type', '!=', 'evergreen-tweets')
				->where('post_type', '!=', 'promos-tweets')
				->where('post_type', '!=', 'tweet-storm-tweets')
				->whereMonth('sched_time', '=', $date)
				->get();				

		// Redirect back to the previous page or any desired location
		return response()->json(['success' => true, 'data' => $sort]);
	}	

	public function getMonth() {
		// get the scheduleld months in database 
		$getMonth = DB::table('cmd_module')
			->select(DB::raw('DISTINCT DATE_FORMAT(sched_time, "%M %Y") AS month'))
			->where('post_type', '!=', 'evergreen-tweets')
			->where('post_type', '!=', 'promos-tweets')
			->where('post_type', '!=', 'tweet-storm-tweets')
			->pluck('month')
			->toArray();
		
		return response()->json(['success' => true, 'data' => $getMonth]);
	}

	public function schedule_action(Request $request, $id) {
		try {
			$slot_id = explode('-', $id);
			$originalDay = Schedule::find($slot_id[1]); // Assuming the original data is on a Sunday at 10 AM
	
			switch ($slot_id[0]) {
				case 'clone':
	
					if ($originalDay) {
						$daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
	
						foreach ($daysOfWeek as $day) {
							if ($day !== $originalDay->day) {
								$newData = $originalDay->replicate();
					
								// Modify the 'day' column to the current day of the week
								$newData->slot_day = strtolower($day);
					
								// Push the replicated data to the new variable
								$newData->save();
							}
						}
	
						return response()->json(['status' => 200, 'action' => $slot_id[0], 'message' => 'Data is cloned successfully!']);
						
					} else {
						// Data entry not found
						throw new \Exception('Data not found');
					}
	
					break;
				
				case 'edit':
					
					if ($originalDay) {
						
					}
					break;
				
				case 'delete':
					$originalDay = Schedule::find($slot_id[1]);

					if ($originalDay) {
						$originalDay->delete();

						return response()->json(['status' => 200, 'action' => $slot_id[0], 'message' => 'Data is deleted successfully!']);
					} else {
						// Data entry not found
						throw new \Exception('Data not found');
					}
					break;
							
			}
		}  catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '409', 'error' => $trace, 'message' => $message]);
        }
	}	
	
}
