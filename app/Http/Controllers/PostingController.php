<?php

namespace App\Http\Controllers;

use App\Helpers\TwitterHelper;
use App\Helpers\MembershipHelper;
use App\Models\Bulk_meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Schedule;
use App\Models\CommandModule;
use App\Models\Bulk_post;
use App\Models\TwitterToken;
use App\Models\Day;
use App\Models\QuantumAcctMeta;
use App\Models\Twitter;
use App\Models\User;
use Exception;
use App\Http\Controllers\CommandmoduleController;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

class PostingController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
      protected $defaultid;
    public function __construct()
    {
		if (Auth::guard('web')->check()) {
            $this->middleware('auth');

        }
        if(Auth::guard('member')->check()) {

            $this->middleware('member-access');


        }
        if(!Session::has('user_id') || !Session::has('user_email')) {

            $this->middleware('auth');


        }
    }
	protected function setDefaultId()
    {
        if (Auth::guard('web')->check()) {
            return $this->defaultid = Auth::id();
        }
        if (Auth::guard('member')->check()) {
            return $this->defaultid = MembershipHelper::membercurrent();
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // public function index()
    // {
	// 	$title = 'Queue';
    //     return view('queue')->with('title', $title);
    // }

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

		$userId = $this->setDefaultId();

		$my_schedule = DB::table('schedule')->select('*')->where('user_id', '=', $userId)->orderBy('minute_at', 'asc')->get();

		// return view('schedule', compact('title', 'days', 'my_schedule', 'hasRegularTweetsInQueue'));

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
			$userId = $this->setDefaultId();
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
						$update->user_id = $this->setDefaultId();
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
				return response()->json(['status' => 200, 'message' => 'Schedule has been updated.', 'info' => $update]);

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
					'user_id' => $this->setDefaultId(),
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
					return response()->json(['status' => 200, 'message' => 'Schedule has been created.', 'info' => $saved]);
				}
			}

		} catch (Exception $e) {
			return response()->json(['status' => 500, 'error' => 'Failed to create data:' . $e->getMessage()]);
		}
	}

	public function tweet_stormer()
    {
		$title = 'Tweet Stormer page';
		$hasRegularTweetsInQueue = CommandModule::where('sched_method', 'add-queue')
		->where('post_type', 'regular-tweets')
		->exists();
		return view('posting', ['title' => $title, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);
        // return view('posting')->with('title', $title);
    }

	public function bulk_queue() {
		$title = 'Bulk Queue';

		$checkRole = MembershipHelper::tier($this->setDefaultId());
        
        // check if subscription is active
        if ($checkRole->status !== 1 && $checkRole->trial_counter < 1) {
			$message = 'Your account is inactive. Please update your payment to continue using the features.';
			return view('bulk-queue', compact('message', 'title'));
            // return response()->json(['status' => 500, 'stat' => 'warning', 'message' => 'Your account is inactive. Please update your payment to continue using the features.']);
        }

		if ($checkRole->basic_bulk_uploader !== 1) {
			// $userId = Auth::id(); //To check current user loggedin User ID dria
			// $hasRegularTweetsInQueue = CommandModule::where('user_id', $userId)
			// ->where('sched_method', 'add-queue')
			// ->where('post_type', 'regular-tweets')
			// ->exists();

			$modalContent = view('modals.upgrade')->render();
			return view('bulk-queue', compact('modalContent', 'title'));
		} 

		return view('bulk-queue')->with('title', $title);

		// Return a response indicating that the limitation has been reached
		// return response()->json(['status' => 403, 'message' => 'Post count limit reached.', 'html' => $html]);
	}

	public function bulk_uploader()
    {
		$checkRole = MembershipHelper::tier($this->setDefaultId());
		$title = 'Bulk Uploader';
		$hasRegularTweetsInQueue = CommandModule::where('sched_method', 'add-queue')
		->where('post_type', 'regular-tweets')
		->exists();

		if ($checkRole->status !== 1 && $checkRole->trial_counter < 1) {
			$message = 'Your account is inactive. Please update your payment to continue using the features.';
			return view('bulk-queue', compact('message', 'title'));
            // return response()->json(['status' => 500, 'stat' => 'warning', 'message' => 'Your account is inactive. Please update your payment to continue using the features.']);
        }

		if ($checkRole->basic_bulk_uploader !== 1) {
			$modalContent = view('modals.upgrade')->render();
			return view('bulk-queue', compact('modalContent', 'title'));
		} 
	
		return view('bulk', ['title' => $title, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);
		
    }

	public function editPost(Request $request, $id) {
		$post_id = str_replace('edit-modal-', '', $request->id);
		try {
			$queuePosts = CommandModule::find($post_id);

			// query to get all post with post_type_code
			$getPosts = CommandModule::where('post_type_code', $queuePosts->post_type_code)->get();

			// Return the view with the retrieved data
			$html = view('modals.edit-commandmodule')->render();
			return response()->json(['status' => 200, 'data' => $getPosts ,'html' => $html]);
		} catch (Exception $e) {
			return response()->json(['status' => 500, 'stat' => 'danger', 'message' => 'Error updating the post']);
		}

		// if ($request->isMethod('get')) {
		// } else {
		// 	try {
		// 		$postData = $request->all();
		// 		$posts = CommandModule::find($id);
		// 		$posts->update([
		// 			'post_type' => $postData['post_type_tweets'],
		// 			'tweetlink' => $postData['retweet-link-input'] ?? null,
		// 			'rt_time' => $postData['num-custom-cm'] ?? null,
		// 			'rt_frame' => $postData['time-custom-cm'] ?? null,
		// 			'rt_ite' => $postData['iterations-custom-cm'] ?? null,
		// 			'promo_id' => $postData['promo-tweets-cmp'] ?? null,
		// 			'post_type_code' => rand(10000, 99999),
		// 			'sched_method' => $postData['scheduling-options'],
		// 			// 'sched_time' => Carbon::now()
		// 		]);

		// 		foreach ($postData['textarea'] as $textarea) {
		// 			$posts->post_description = $textarea;
		// 		};

		// 		// // Save the changes
		// 		$posts->save();

		// 		// // Return a success response
		// 		return response()->json(['status' => 200, 'message' => 'Data updated successfully']);

		// 	} catch (Exception $e) {
		// 		$trace = $e->getTrace();
		// 		$message = $e->getMessage();
		// 		// Handle the error
		// 		// Log or display the error message along with file and line number
		// 		return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
		// 	}
		// }
	}

	public function editBulk(Request $request, $id) {

		if ($request->isMethod('get')) {
			try {
				$queuePosts = Bulk_post::find($id);

				// Return the view with the retrieved data
				$html = view('modals.edit-bulk')->render();
				return response()->json(['status' => 200, 'data' => $queuePosts ,'html' => $html]);
			} catch (Exception $e) {
				return response()->json(['status' => 500, 'stat' => 'danger', 'message' => 'Error updating the post']);
			}
		} else {
			try {
				$postData = $request->all();
				$id = explode('-', $id);
				$posts = Bulk_post::find($id[2]);

				// Parse the date using Carbon
				$date = Carbon::createFromFormat('Y M. d g:i A', $postData['bulkpost_date'] . " ". $postData['ct-hour'] . ":" .  $postData['ct-min'] . " " . $postData['ct-format']);

				$posts->update([
					"post_type" => "regular-tweets",
					"post_description" => $postData['bulkpost_description'],
					"sched_time" => $date,
					"image_url" => (isset($postData['bulkimage_url']) && $postData['bulkimage_url'] !== null) ? $postData['bulkimage_url'] : "",
					"link_url" => (isset($postData['bulklink_url'])  && $postData['bulklink_url'] !== null) ? $postData['bulklink_url'] : ""
				]);

				// // Save the changes
				$posts->save();


				$message = "Bulk post is updated succesfully. ";

				// check the link_url if already existing
				if ($posts->save()) {
					$findMeta = Bulk_meta::where('link_url', $posts['link_url'])->first();

					if (!$findMeta) {
						// The record does not exist, so scrape the meta tags
						$metaTags =  (new CommandmoduleController)->scrapeMetaTags($postData['bulklink_url']);

						$metaData = [
							'meta_title' => $metaTags['og:title'],
							'meta_description' => $metaTags['og:description'],
							'meta_image' => $metaTags['og:image'],
							'link_url' => $postData['bulklink_url'],
						];

						// Create a new record in the database
						Bulk_meta::create($metaData);

						$message .= "New meta added in existing post";
					} else {
						$message .= "Meta is already saved before";
					}

					// Return a success response
					return response()->json(['status' => 200, 'message' => $message]);
				}	else {
					return response()->json(['status' => 500, 'message' => 'Something went wrong on saving']);
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

	public function deletePost($id) {
		try {
			$explode = explode('-', $id);

			if ($explode[0] === 'deleteBulk') {
				$queueDelete = Bulk_post::findOrFail($explode[1]);
			} else {
				// Find the data record by its ID
				$queueDelete = CommandModule::findOrFail($explode[1]);
			}

			// Delete the data
			$queueDelete->delete();

			// Success response
			return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Post deleted successfully']);
		} catch (\Exception $e) {
			$trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '500', 'error' => $trace, 'message' => $message]);
		}
	}

	public function duplicatePost($id) {
        try {
			$explode = explode('-', $id);

			if ($explode[0] === 'duplicateBulk') {
				$queueDuplicate = Bulk_post::findOrFail($explode[1]);
				$newRow = $queueDuplicate->replicate();
			} else {
				// Find the data record by its ID
				// $queueDuplicate = CommandModule::findOrFail($explode[1]);
				$queueDuplicate = CommandModule::whereNotIn('post_type', ['evergreen', 'promos', 'tweetstorms'])->findOrFail($explode[1]);
				$newRow = $queueDuplicate->replicate();
				$newRow->post_type_code = rand(10000, 99999);
			}


			// Optionally, you can modify any specific values before saving the new row
			$newRow->post_description = $queueDuplicate->post_description . ' - Copy';
			$newRow->save();

            // Redirect or return a response
            return response()->json(['status' => 200, 'message' => 'Post duplicated successfully!']);

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '500', 'error' => $trace, 'message' => $message]);
        }
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

	public function switchFromQueue(Request $request, $switch, $id) {
		try {
			//update first the switch
			QuantumAcctMeta::where('user_id', $this->setDefaultId())->update([$request->input('method') . '_switch' => ($switch === 'active' ? 1 : 0)]);

			switch ($request->method) {
				case "queue" :
					$const = CommandModule::where('twitter_id', $id)
						->where('sched_time', '>=', TwitterHelper::now($this->setDefaultId()))
						->update(['active' => ($switch === 'active' ? 1 : 0)]);
					break;
				case "promo" :
					$const = CommandModule::where('twitter_id', $id)
						->where('post_type', 'promos-tweets')
						->update(['active' => ($switch === 'active' ? 1 : 0)]);
						break;
				case "evergreen" :
					$const = CommandModule::where('twitter_id', $id)
						->where('post_type', 'evergreen-tweets')
						->update(['active' => ($switch === 'active' ? 1 : 0)]);

				// case "bulk-queue" :
				// 	$const = Bulk_post::where('twitter_id', $id)
						// ->where('post_type', 'evergreen-tweets')
				// 		->update(['active' => ($switch === 'active' ? 1 : 0)]);
					break;
			}

			return response()->json(['status' => 200, 'data' => $const]);
		} catch (Exception $e) {
			Log::error('Error creating data: ' . $e->getMessage());
			return response()->json(['status' => '500', 'error' => 'Error to activate/inactive the post']);
		}
	}

	public function getScheduledSlots (Request $request) {
		try {
			// get all the shedule that is under user_id
			$slot = Schedule::where('user_id', $this->setDefaultId())->get();

			return response()->json(['status' => 200, 'message' => 'Get schedule', 'data' => $slot]);
		} catch (Exception $e) {
			Log::error('Error creating data: ' . $e->getMessage());
			return response()->json(['status' => '500', 'error' => 'Switched data']);
		}

	}

	public function retrieveSpecialPost($id) {

        try {
			$findPostwithPostType = CommandModule::findOrFail($id);

			return response()->json(['status' => 200, 'data' => $findPostwithPostType]);
        } catch (Exception $e) {

        }

    }

	public function sortPostbyMonth(Request $request) {
		$convertDate = str_replace('-', ' ', $request->month);

		$date = intval(Carbon::createFromFormat('F Y', $convertDate)->format('m'));

		// $sort = CommandModule::where(['twitter_id' => $request->id, 'sched_time' => $date, 'deleted' => 0])->orderBy('sched_time', 'ASC')->get();
		$sort = DB::table('posts')
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

	public function editPostData(Request $request, $id) {
		// dd($request);
		try {
			$postData = $request->all();
			$posts = CommandModule::find($id);
			$posts->update([
				'post_type' => $postData['post_type_tweets'],
                'tweetlink' => $postData['retweet-link-input'] ?? null,
                'rt_time' => $postData['num-custom-cm'] ?? null,
                'rt_frame' => $postData['time-custom-cm'] ?? null,
                'rt_ite' => $postData['iterations-custom-cm'] ?? null,
                'promo_id' => $postData['promo-tweets-cmp'] ?? null,
                'post_type_code' => rand(10000, 99999),
				'sched_method' => $postData['scheduling-options'],
				// 'sched_time' => Carbon::now()
			]);

			foreach ($postData['textarea'] as $textarea) {
                $posts->post_description = $textarea;
			};

			// // Save the changes
			$posts->save();

			// // Return a success response
			return response()->json(['status' => 200, 'message' => 'Data updated successfully']);

		} catch (Exception $e) {
			$trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
		}
	}

	// public function editBulkPost(Request $request, $id) {
	// 	try {
	// 		$postData = $request->all();
	// 		$id = explode('-', $id);
	// 		$posts = Bulk_post::find($id[2]);

	// 		// Parse the date using Carbon
	// 		$date = Carbon::createFromFormat('Y M. d g:i A', $postData['bulkpost_date'] . " ". $postData['ct-hour'] . ":" .  $postData['ct-min'] . " " . $postData['ct-format']);

	// 		$posts->update([
	// 			"post_type" => "regular-tweets",
	// 			"post_description" => $postData['bulkpost_description'],
	// 			"sched_time" => $date,
	// 			"link_url" => isset($postData['bulklink_url']) ? $postData['bulklink_url'] : "",
	// 			"image_url" => isset($postData['bulkimage_url']) ? $postData['bulkimage_url'] : ""
	// 		]);

	// 		// // Save the changes
	// 		$posts->save();

	// 		// check the link_url if already existing
	// 		if (isset($postData['bulklink_url'])) {
	// 			$findMeta = Bulk_meta::where('link_url', $postData['bulklink_url'])->first();

	// 			if (!$findMeta) {
	// 				// The record does not exist, so scrape the meta tags
	// 				$metaTags =  (new CommandmoduleController)->scrapeMetaTags($postData['bulklink_url']);

	// 				$metaData = [
	// 					'meta_title' => $metaTags['og:title'],
	// 					'meta_description' => $metaTags['og:description'],
	// 					'meta_image' => $metaTags['og:image'],
	// 					'link_url' => $postData['bulklink_url'],
	// 				];

	// 				// Create a new record in the database
	// 				Bulk_meta::create($metaData);
	// 			}
	// 		}

	// 		// // // Return a success response
	// 		return response()->json(['status' => 200, 'message' => 'Data updated successfully']);

	// 	} catch (Exception $e) {
	// 		$trace = $e->getTrace();
    //         $message = $e->getMessage();
    //         // Handle the error
    //         // Log or display the error message along with file and line number
    //         return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
	// 	}
	// }

	public function getMonth() {
		// get the scheduleld months in database
		$getMonth = DB::table('posts')
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
			// $slot_id = explode('-', $id);
			$originalDay = Schedule::find($request->slot_id); // Assuming the original data is on a Sunday at 10 AM

			switch ($id) {
				case 'clone':

					if ($originalDay) {
						$daysOfWeek = Day::all();
						$newData = [];

						foreach ($daysOfWeek as $day) {
							if ($day['day'] !== $originalDay->slot_day) {
								$newData = $originalDay->replicate();

								// Modify the 'day' column to the current day of the week
								$newData->slot_day = $day['day'];

								// Push the replicated data to the new variable
								$newData->save();
							}
						}

						return response()->json(['status' => 200, 'action' => $id, 'message' => 'Data is cloned successfully!']);

					} else {
						// Data entry not found
						throw new \Exception('Data not found');
					}

					break;


				case 'delete':
					$originalDay = Schedule::find($request->slot_id);

					if ($originalDay) {
						$originalDay->delete();

						return response()->json(['status' => 200, 'action' => $id, 'message' => 'Data is deleted successfully!']);
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
            return response()->json(['status' => '500', 'error' => $trace, 'message' => $message]);
        }
	}


}
