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
use App\Charts\AssistantsPerMeeting;
use App\User;
use Bouncer;

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
        if(Bouncer::is(Auth::user())->a('admin') || Bouncer::is(Auth::user())->a('supervisor')){
            // Statistics In Line
            $statisticsInLine = $this->statisticsInLine();

            // Graphics
            $peoplePerMonth = $this->peoplePerMonth();
            $meetingsPerMonth = $this->meetingsPerMonth();
            $assitantsPerMonth = $this->assitantsPerMonth(); 
            $assistantsPerMeeting = $this->assistantsPerMeeting(); 
        }elseif(Bouncer::is(Auth::user())->a('group_leader')){
            // Statistics In Line
            $statisticsInLine = null;

            // Graphics
            $peoplePerMonth = null;
            $meetingsPerMonth = null;
            $assitantsPerMonth = $this->assitantsPerMonth(); 
            $assistantsPerMeeting = $this->assistantsPerMeeting();
        }
         

        return view('dashboard.index', 
            compact('statisticsInLine','peoplePerMonth', 'meetingsPerMonth', 'assitantsPerMonth', 'assistantsPerMeeting'
            ));
    }

    public function statisticsInLine(){
        $communities = Community::join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $this->user_review())
            ->get()
            ->count();
        
        $people = Person::join('community_people','community_people.person_id', '=','people.id')
            ->join('communities', 'community_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $this->user_review())
            ->distinct()
            ->select('people.*')
            ->get()
            ->count();

        $groups = Group::join('community_groups','community_groups.group_id', '=','groups.id')
            ->join('communities', 'community_groups.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $this->user_review())
            ->get()
            ->count();
            
        $meetings = Meeting::join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
            ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', $this->user_review())
            ->get()
            ->count();

        return compact('communities', 'people', 'groups', 'meetings');
    }

    public function peoplePerMonth(){
        $queryPeoplePerMonth = Person::select(DB::raw('MONTH(people.created_at) as id_month'),
                                DB::raw('MONTHNAME(people.created_at) as month'), 
                                DB::raw('COUNT(DISTINCT people.id) as n'))
                                ->join('community_people','community_people.person_id', '=','people.id')
                                ->join('communities', 'community_people.community_id', '=', 'communities.id')
                                ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                ->where('community_users.user_id', $this->user_review())
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
        $peoplePerMonth->height(300);
        $peoplePerMonth->dataset('Personas incluidas por mes', 'line', $nPeoplePerMonth)
            ->color('rgba(0, 176, 155, 0.8)')
            ->backgroundcolor('rgba(0, 176, 155, 0.8)');

        return $peoplePerMonth;
    }

    public function meetingsPerMonth(){
        $queryMeetingsPerMonth = Meeting::select(DB::raw('MONTH(meetings.created_at) as id_meeting'),
                                DB::raw('MONTHNAME(meetings.created_at) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                                ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                                ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                ->where('community_users.user_id', $this->user_review())
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
        $meetingsPerMonth->height(300);
        $meetingsPerMonth->dataset('Reuniones por mes', 'line', $nMeetingsPerMonth)
            ->color('rgba(246, 211, 101, 0.8)')
            ->backgroundcolor('rgba(246, 211, 101, 0.8)');

        return $meetingsPerMonth;
    }

    public function assitantsPerMonth(){

        if(Bouncer::is(Auth::user())->a('group_leader')){
            $queryAssitantsPerMonth = Assistant::select(DB::raw('MONTH(meetings.date) as id_assistant'),
                                DB::raw('MONTHNAME(meetings.date) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->where('assistants.confirmation', '=', 1)
                                ->where('meetings.user_id', $this->user_review())
                                ->whereYear('meetings.date', Carbon::now()->format('Y'))                      
                                ->groupBy('id_assistant', 'month')->get();

            $queryNoAssitantsPerMonth = Assistant::select(DB::raw('MONTH(meetings.date) as id_assistant'),
                                DB::raw('MONTHNAME(meetings.date) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->where('assistants.confirmation', '=', 0)
                                ->where('meetings.user_id', $this->user_review())
                                ->whereYear('meetings.date', Carbon::now()->format('Y'))                      
                                ->groupBy('id_assistant', 'month')->get();

            $queryNewAssitantsPerMonth = Assistant::select(DB::raw('MONTH(meetings.date) as id_assistant'),
                                DB::raw('MONTHNAME(meetings.date) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->where('assistants.new_assistant', '=', 1)
                                ->where('meetings.user_id', $this->user_review())
                                ->whereYear('meetings.date', Carbon::now()->format('Y'))                      
                                ->groupBy('id_assistant', 'month')->get();
        }else{
            $queryAssitantsPerMonth = Assistant::select(DB::raw('MONTH(meetings.date) as id_assistant'),
                                DB::raw('MONTHNAME(meetings.date) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                                ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                                ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                ->where('assistants.confirmation', '=', 1)
                                ->where('community_users.user_id', $this->user_review())
                                ->whereYear('meetings.date', Carbon::now()->format('Y'))                      
                                ->groupBy('id_assistant', 'month')->get();

            $queryNoAssitantsPerMonth = Assistant::select(DB::raw('MONTH(meetings.date) as id_assistant'),
                                DB::raw('MONTHNAME(meetings.date) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                                ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                                ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                ->where('assistants.confirmation', '=', 0)
                                ->where('community_users.user_id', $this->user_review())
                                ->whereYear('meetings.date', Carbon::now()->format('Y'))                      
                                ->groupBy('id_assistant', 'month')->get();

            $queryNewAssitantsPerMonth = Assistant::select(DB::raw('MONTH(meetings.date) as id_assistant'),
                                DB::raw('MONTHNAME(meetings.date) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                                ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                                ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                ->where('assistants.new_assistant', '=', 1)
                                ->where('community_users.user_id', $this->user_review())
                                ->whereYear('meetings.date', Carbon::now()->format('Y'))                      
                                ->groupBy('id_assistant', 'month')->get();
        }        

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

        if(!$queryNewAssitantsPerMonth->isEmpty()){
            foreach ($queryNewAssitantsPerMonth as $query) {
                $nNewAssitantsPerMonth[] = $query->n;
                $monthNewAssitantsPerMonth[] = $query->month;
            }
        }else{
            $nNewAssitantsPerMonth[] = "";
            $monthNewAssitantsPerMonth[] = "";
        }
        
        $assitantsPerMonth = new AssitantsPerMonth;
        $assitantsPerMonth->labels($monthAssitantsPerMonth);
        $assitantsPerMonth->height(300);
        $assitantsPerMonth->dataset('Asistentes', 'bar', $nAssitantsPerMonth)
            ->color('rgba(30, 60, 114, 0.8)')
            ->backgroundcolor('rgba(30, 60, 114, 0.8)');
        $assitantsPerMonth->dataset('No Asistentes', 'bar', $nNoAssitantsPerMonth)
            ->color('rgba(255, 8, 68, 0.8)')
            ->backgroundcolor('rgba(255, 8, 68, 0.8)');
        $assitantsPerMonth->dataset('Nuevos Asistentes', 'bar', $nNewAssitantsPerMonth)
            ->color('rgba(246, 211, 101, 1)')
            ->backgroundcolor('rgba(246, 211, 101, 1)');

        return $assitantsPerMonth;
    }

    public function assistantsPerMeeting(){

        if(Bouncer::is(Auth::user())->a('group_leader')){
            $queryAssitantsPerMeeting = Assistant::select('meetings.id', 
                                    'meetings.name',
                                    DB::raw('COUNT(*) as n'))
                                    ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                    ->where('assistants.confirmation', '=', 1)
                                    ->where('meetings.user_id', $this->user_review())
                                    ->whereMonth('meetings.date', Carbon::now()->format('m'))                      
                                    ->groupBy('id', 'name')->get();

            $queryNoAssitantsPerMeeting = Assistant::select('meetings.id', 
                                    'meetings.name',
                                    DB::raw('COUNT(*) as n'))
                                    ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                    ->where('assistants.confirmation', '=', 0)
                                    ->where('meetings.user_id', $this->user_review())
                                    ->whereMonth('meetings.date', Carbon::now()->format('m'))                      
                                    ->groupBy('id', 'name')->get();

            $queryNewAssitantsPerMeeting = Assistant::select('meetings.id', 
                                    'meetings.name',
                                    DB::raw('COUNT(*) as n'))
                                    ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                    ->where('assistants.new_assistant', '=', 1)
                                    ->where('meetings.user_id', $this->user_review())
                                    ->whereMonth('meetings.date', Carbon::now()->format('m'))                      
                                    ->groupBy('id', 'name')->get();
        }else{

            $queryAssitantsPerMeeting = Assistant::select('meetings.id', 
                                    'meetings.name',
                                    DB::raw('COUNT(*) as n'))
                                    ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                    ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                                    ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                                    ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                    ->where('assistants.confirmation', '=', 1)
                                    ->where('community_users.user_id', $this->user_review())
                                    ->whereMonth('meetings.date', Carbon::now()->format('m'))                      
                                    ->groupBy('id', 'name')->get();

            $queryNoAssitantsPerMeeting = Assistant::select('meetings.id', 
                                    'meetings.name',
                                    DB::raw('COUNT(*) as n'))
                                    ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                    ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                                    ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                                    ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                    ->where('assistants.confirmation', '=', 0)
                                    ->where('community_users.user_id', $this->user_review())
                                    ->whereMonth('meetings.date', Carbon::now()->format('m'))                      
                                    ->groupBy('id', 'name')->get();

            $queryNewAssitantsPerMeeting = Assistant::select('meetings.id', 
                                    'meetings.name',
                                    DB::raw('COUNT(*) as n'))
                                    ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                    ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                                    ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                                    ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                                    ->where('assistants.new_assistant', '=', 1)
                                    ->where('community_users.user_id', $this->user_review())
                                    ->whereMonth('meetings.date', Carbon::now()->format('m'))                      
                                    ->groupBy('id', 'name')->get();
        }

        if(!$queryAssitantsPerMeeting->isEmpty()){
            foreach ($queryAssitantsPerMeeting as $query) {
                $meetingNameAssistantsPerMonth[] = $query->name;
                $nAssitantsPerMeeting[] = $query->n;
            }
        }else{
            $meetingNameAssistantsPerMonth[] = "";
            $nAssitantsPerMeeting[] = "";
        }

        if(!$queryNoAssitantsPerMeeting->isEmpty()){
            foreach ($queryNoAssitantsPerMeeting as $query) {
                $meetingNameNoAssitantsPerMonth[] = $query->name;
                $nNoAssitantsPerMeeting[] = $query->n;
            }
        }else{
            $meetingNameNoAssitantsPerMonth[] = "";
            $nNoAssitantsPerMeeting[] = "";
        }

        if(!$queryNewAssitantsPerMeeting->isEmpty()){
            foreach ($queryNewAssitantsPerMeeting as $query) {
                $meetingNameNewAssitantsPerMonth[] = $query->name;
                $nNewAssitantsPerMeeting[] = $query->n;
            }
        }else{
            $meetingNamePerNewAssitantsMonth[] = "";
            $nNewAssitantsPerMeeting[] = "";
        }

        $assistantsPerMeeting = new AssistantsPerMeeting;
        $assistantsPerMeeting->labels($meetingNameAssistantsPerMonth);
        $assistantsPerMeeting->height(300);
        $assistantsPerMeeting->dataset('Asistentes', 'bar', $nAssitantsPerMeeting)
            ->color('rgba(30, 60, 114, 0.8)')
            ->backgroundcolor('rgba(30, 60, 114, 0.8)');
        $assistantsPerMeeting->dataset('No Asistentes', 'bar', $nNoAssitantsPerMeeting)
            ->color('rgba(255, 8, 68, 0.8)')
            ->backgroundcolor('rgba(255, 8, 68, 0.8)');
        $assistantsPerMeeting->dataset('Nuevos Asistentes', 'bar', $nNewAssitantsPerMeeting)
            ->color('rgba(246, 211, 101, 1)')
            ->backgroundcolor('rgba(246, 211, 101, 1)');

        return $assistantsPerMeeting;
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
