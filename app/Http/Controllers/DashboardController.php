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
use App\Charts\PeoplePerMonth;
use App\Charts\MeetingsPerMonth;
use App\Charts\AssitantsPerMonth;

class DashboardController extends Controller
{
    /**
     * Dashboard
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

    	$communities = Community::join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::id())
            ->get()
            ->count();
    	
    	$people = Person::join('community_people','community_people.person_id', '=','people.id')
            ->join('communities', 'community_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::id())
            ->distinct()
            ->select('people.*')
            ->get()
            ->count();

    	$groups = Group::join('community_groups','community_groups.group_id', '=','groups.id')
            ->join('communities', 'community_groups.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::id())
            ->get()
            ->count();
            
    	$meetings = Meeting::join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
            ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->get()
            ->count();

        // People

        $queryPeoplePerMonth = Person::select(DB::raw('MONTH(people.created_at) as id_month'),
                                DB::raw('MONTHNAME(people.created_at) as month'), 
                                DB::raw('COUNT(DISTINCT people.id) as n'))
                                ->join('community_people','community_people.person_id', '=','people.id')
                                ->join('communities', 'community_people.community_id', '=', 'communities.id')
                                ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                ->where('community_users.user_id', Auth::user()->id)
                                ->whereYear('people.created_at', Carbon::now()->format('Y')) 
                                ->groupBy('id_month', 'month')->get();

        if(!$queryPeoplePerMonth->isEmpty()){
            foreach ($queryPeoplePerMonth as $query) {
                $nPeoplePerMonth[] = $query->n;
                $monthPeoplePerMonth[] = $query->month;
            }
        }else{
            $nPeoplePerMonth[] = "";
            $monthPeoplePerMonth[] = "";
        }
        
        $peoplePerMonth = new PeoplePerMonth;
        $peoplePerMonth->labels($monthPeoplePerMonth);
        $peoplePerMonth->height(200);
        $peoplePerMonth->dataset('Personas por mes', 'line', $nPeoplePerMonth)
            ->color('rgba(0, 176, 155, 0.8)')
            ->backgroundcolor('rgba(0, 176, 155, 0.8)');

        // Meetings

        $queryMeetingsPerMonth = Meeting::select(DB::raw('MONTH(meetings.created_at) as id_meeting'),
                                DB::raw('MONTHNAME(meetings.created_at) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                                ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                                ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                ->where('community_users.user_id', Auth::user()->id)
                                ->whereYear('meetings.created_at', Carbon::now()->format('Y'))                         
                                ->groupBy('id_meeting', 'month')->get();

        if(!$queryMeetingsPerMonth->isEmpty()){
            foreach ($queryMeetingsPerMonth as $query) {
                $nMeetingsPerMonth[] = $query->n;
                $monthMeetingsPerMonth[] = $query->month;
            }
        }else{
            $nMeetingsPerMonth[] = "";
            $monthMeetingsPerMonth[] = "";
        }
        
        $meetingsPerMonth = new MeetingsPerMonth;
        $meetingsPerMonth->labels($monthMeetingsPerMonth);
        $meetingsPerMonth->height(200);
        $meetingsPerMonth->dataset('Reuniones por mes', 'line', $nMeetingsPerMonth)
            ->color('rgba(246, 211, 101, 0.8)')
            ->backgroundcolor('rgba(246, 211, 101, 0.8)');

        // Assitants

        $queryAssitantsPerMonth = Assistant::select(DB::raw('MONTH(assistants.created_at) as id_assistant'),
                                DB::raw('MONTHNAME(assistants.created_at) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                                ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                                ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                ->where('assistants.confirmation', '=', 1)
                                ->where('community_users.user_id', Auth::user()->id)
                                ->whereYear('meetings.created_at', Carbon::now()->format('Y'))                      
                                ->groupBy('id_assistant', 'month')->get();

        $queryNoAssitantsPerMonth = Assistant::select(DB::raw('MONTH(assistants.created_at) as id_assistant'),
                                DB::raw('MONTHNAME(assistants.created_at) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                                ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                                ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                ->where('assistants.confirmation', '=', 0)
                                ->where('community_users.user_id', Auth::user()->id)
                                ->whereYear('meetings.created_at', Carbon::now()->format('Y'))                      
                                ->groupBy('id_assistant', 'month')->get();

        if(!$queryAssitantsPerMonth->isEmpty()){
            foreach ($queryAssitantsPerMonth as $query) {
                $nAssitantsPerMonth[] = $query->n;
                $monthAssitantsPerMonth[] = $query->month;
            }
        }else{
            $nAssitantsPerMonth[] = "";
            $monthAssitantsPerMonth[] = "";
        }

        if(!$queryNoAssitantsPerMonth->isEmpty()){
            foreach ($queryNoAssitantsPerMonth as $query) {
                $nNoAssitantsPerMonth[] = $query->n;
                $monthNoAssitantsPerMonth[] = $query->month;
            }
        }else{
            $nNoAssitantsPerMonth[] = "";
            $monthNoAssitantsPerMonth[] = "";
        }
        
        $assitantsPerMonth = new AssitantsPerMonth;
        $assitantsPerMonth->labels($monthAssitantsPerMonth);
        $assitantsPerMonth->height(525);
        $assitantsPerMonth->dataset('Asistentes', 'line', $nAssitantsPerMonth)
            ->color('rgba(30, 60, 114, 0.8)')
            ->backgroundcolor('rgba(30, 60, 114, 0.8)');
        $assitantsPerMonth->dataset('No Asistentes', 'line', $nNoAssitantsPerMonth)
            ->color('rgba(255, 8, 68, 0.8)')
            ->backgroundcolor('rgba(255, 8, 68, 0.8)');

        return view('dashboard.index', 
            compact('communities', 'people', 'groups', 'meetings', 
                'peoplePerMonth', 'meetingsPerMonth', 'assitantsPerMonth'
            ));
    }
}
