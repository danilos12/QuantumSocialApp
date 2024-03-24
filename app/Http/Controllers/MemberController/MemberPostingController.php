<?php

namespace App\Http\Controllers\MemberController;

use Illuminate\Http\Request;
use App\Helpers\MembershipHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CommandModule;
class MemberPostingController extends Controller
{
    public function __construct()
    {
        $this->middleware('member-access');
    }

    public function bulk_uploader()
    {
        $checkRole = MembershipHelper::tier(Auth::id());
        $title = 'Bulk Uploader';
        $hasRegularTweetsInQueue = CommandModule::where('sched_method', 'add-queue')
            ->where('post_type', 'regular-tweets')
            ->exists();

        if ($checkRole->basic_bulk_uploader === 1) {
            return view('bulk', ['title' => $title, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);
        } else {
            $modalContent = view('modals.upgrade')->render();
            return view('bulk-queue', compact('modalContent', 'title'));
        }
    }
}
