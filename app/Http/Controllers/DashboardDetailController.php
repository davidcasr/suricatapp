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
                    ->join('group_meetings', 'meetings.id', '=', 'group_meetings.meeting_id')
                    ->join('groups', 'groups.id', '=', 'group_meetings.group_id')
                    ->where('groups.user_id', Auth::id())
                    ->whereYear('meetings.created_at', Carbon::now()->format('Y'))
                    ->select('assistants.*')
                    ->get();
        }else{
            $data = Assistant::join('meetings','meetings.id', '=','assistants.meeting_id')
                    ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                    ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                    ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                    ->where('community_users.user_id', $this->user_review())
                    ->whereYear('meetings.created_at', Carbon::now()->format('Y'))
                    ->select('assistants.*')
                    ->get();
        }
    	

    	return $data;
    }

    public function assistantsPerMeeting(){
        if(Bouncer::is(Auth::user())->a('group_leader')){
            $data = Assistant::join('meetings','meetings.id', '=','assistants.meeting_id')
                    ->join('group_meetings', 'meetings.id', '=', 'group_meetings.meeting_id')
                    ->join('groups', 'groups.id', '=', 'group_meetings.group_id')
                    ->where('groups.user_id', Auth::id())
                    ->whereYear('meetings.created_at', Carbon::now()->format('m'))
                    ->select('assistants.*')
                    ->get();
        }else{
            $data = Assistant::join('meetings','meetings.id', '=','assistants.meeting_id')
                    ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                    ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                    ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                    ->where('community_users.user_id', $this->user_review())
                    ->whereMonth('meetings.created_at', Carbon::now()->format('m'))
                    ->select('assistants.*')
                    ->get();
        }
    	    	
    	return $data;
    }

    public function user_review(){

        $user = User::findOrfail(Auth::id());        
        
        if(is_null($user->parent_id))
        {
            $user_id = Auth::id(); 
        }else{
            $user_id = $user->parent_id;
        }  

        return $user_id;
    }
}
