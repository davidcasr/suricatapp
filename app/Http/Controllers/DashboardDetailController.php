<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Community;
use App\Models\Person;
use App\Models\Group;
use App\Models\Meeting;
use App\Models\Assistant;
use App\User;
use Bouncer;

class DashboardDetailController extends Controller
{
    public function index($title){
    	if($title == 'assitantsPerMonth'){
    		$data = $this->assitantsPerMonth();
    	}elseif($title == 'assistantsPerMeeting'){
    		$data = $this->assistantsPerMeeting();
    	}

    	return view('dashboard.detail', compact('data', 'title'));
    }

    public function assitantsPerMonth(){

        if(Bouncer::is(Auth::user())->a('group_leader')){
            $data = Assistant::join('meetings','meetings.id', '=','assistants.meeting_id')
                    ->whereNull('meetings.deleted_at')
                    ->where('meetings.user_id', $this->user_review())
                    ->whereYear('meetings.date', Carbon::now()->format('Y'))
                    ->select('assistants.*')
                    ->paginate(config('global.per_page'));
        }else{
            $data = Assistant::join('meetings','meetings.id', '=','assistants.meeting_id')
                    ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                    ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                    ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                    ->where('community_users.user_id', $this->user_review())
                    ->whereNull('meetings.deleted_at')
                    ->whereYear('meetings.date', Carbon::now()->format('Y'))
                    ->select('assistants.*')
                    ->paginate(config('global.per_page'));
        }
    	
    	return $data;
    }

    public function assistantsPerMeeting(){
        if(Bouncer::is(Auth::user())->a('group_leader')){
            $data = Assistant::join('meetings','meetings.id', '=','assistants.meeting_id')
                    ->whereNull('meetings.deleted_at')
                    ->where('meetings.user_id', $this->user_review())
                    ->whereMonth('meetings.date', Carbon::now()->format('m'))
                    ->select('assistants.*')
                    ->paginate(config('global.per_page'));
        }else{
            $data = Assistant::join('meetings','meetings.id', '=','assistants.meeting_id')
                    ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                    ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                    ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                    ->where('community_users.user_id', $this->user_review())
                    ->whereNull('meetings.deleted_at')
                    ->whereMonth('meetings.date', Carbon::now()->format('m'))
                    ->select('assistants.*')
                    ->paginate(config('global.per_page'));
        }
    	    	
    	return $data;
    }

    public function user_review(){

        $user = User::findOrfail(Auth::id());        
        
        if(is_null($user->parent_id))
        {
            $user_id = Auth::id(); 
        }else{
            if(Bouncer::is(Auth::user())->a('group_leader')){
                $user_id = Auth::id();
            }else{
                $user_id = $user->parent_id;
            }            
        }

        return $user_id;
    }
}
