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
use App\Charts\PeoplePerMonth;
use App\Charts\MeetingsPerMonth;

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
            ->get()
            ->count();

    	$groups = Group::join('community_groups','community_groups.group_id', '=','groups.id')
            ->join('communities', 'community_groups.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::id())
            ->get()
            ->count();
            
    	$meetings = '';

        $queryPeoplePerMonth = Person::select(DB::raw('MONTH(created_at) as id_month'),
                                DB::raw('MONTHNAME(created_at) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->whereYear('created_at', Carbon::now()->format('Y'))                            
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
        $peoplePerMonth->dataset('Personas por mes', 'line', $nPeoplePerMonth)
            ->color('rgba(0, 176, 155, 0.8)')
            ->backgroundcolor('rgba(0, 176, 155, 0.8)');

        $queryMeetingsPerMonth = Meeting::select(DB::raw('MONTH(created_at) as id_meeting'),
                                DB::raw('MONTHNAME(created_at) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->whereYear('created_at', Carbon::now()->format('Y'))                            
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
        $meetingsPerMonth->dataset('Reuniones por mes', 'line', $nMeetingsPerMonth)
            ->color('rgba(246, 211, 101, 0.8)')
            ->backgroundcolor('rgba(246, 211, 101, 0.8)');

        return view('dashboard.index', 
            compact('communities', 'people', 'groups', 'meetings', 
                'peoplePerMonth', 'meetingsPerMonth'
            ));
    }
}
