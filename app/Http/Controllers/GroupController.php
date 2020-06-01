<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Repositories\GroupRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Community;
use App\Models\Group;
use App\Models\CommunityGroups;
use App\Models\Person;
use App\Models\Meeting;
use App\Models\Assistant;
use App\Charts\AssitantsPerMonth;
use App\Charts\AssistantsPerMeeting;
use App\User;
use Bouncer;

class GroupController extends AppBaseController
{
    /** @var  GroupRepository */
    private $groupRepository;

    public function __construct(GroupRepository $groupRepo)
    {
        $this->groupRepository = $groupRepo;
    }

    /**
     * Display a listing of the Group.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if(Bouncer::is(Auth::user())->a('admin') || Bouncer::is(Auth::user())->a('supervisor')){
            $button_create = true;

            if (!empty($keyword)) {
                $groups = $this->groupRepository
                ->makeModel()
                ->join('community_groups','community_groups.group_id', '=','groups.id')
                ->join('communities', 'community_groups.community_id', '=', 'communities.id')
                ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                ->where('community_users.user_id', Auth::user()->id)
                ->orWhere('groups.name', 'LIKE', '%$keyword%')
                ->select('groups.*')
                ->distinct()
                ->paginate(config('global.per_page'));
            }else{
                $groups = $this->groupRepository
                ->makeModel()
                ->join('community_groups','community_groups.group_id', '=','groups.id')
                ->join('communities', 'community_groups.community_id', '=', 'communities.id')
                ->join('community_users', 'community_users.community_id', '=', 'communities.id')
                ->where('community_users.user_id', Auth::user()->id)
                ->select('groups.*')
                ->distinct()
                ->paginate(config('global.per_page'));
            }
        }else{
            $button_create = false;

            if (!empty($keyword)) {
                $groups = $this->groupRepository
                ->makeModel()
                ->where('groups.user_id', Auth::user()->id)
                ->orWhere('groups.name', 'LIKE', '%$keyword%')
                ->select('groups.*')
                ->distinct()
                ->paginate(config('global.per_page'));
            }else{
                $groups = $this->groupRepository
                ->makeModel()
                ->where('groups.user_id', Auth::user()->id)
                ->select('groups.*')
                ->distinct()
                ->paginate(config('global.per_page'));
            }
        }

        return view('groups.index', compact('groups', 'button_create'));
    }

    /**
     * Show the form for creating a new Group.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $user = User::findOrfail(Auth::id());

        if(is_null($user->parent_id))
        {
            $user_parent = User::where('id', Auth::id());
            $users = User::where('parent_id', Auth::id())->union($user_parent)->get()->pluck('email', 'id');
        }else{
            $user_parent = User::where('id', $user->parent_id);
            $users = User::where('parent_id', $user->parent_id)->union($user_parent)->get()->pluck('email', 'id');
        }         

        if(!$request->subgroup){
            $communities = Community::communities(Auth::id())->pluck('name','id');
            $users = User::where('id', Auth::id())->get()->pluck('email', 'id');
            return view('groups.create', compact('communities', 'users'));
        }else{
            $subgroup = $request->subgroup;
            $levels = Group::where('id', $request->subgroup)->select('level')->get();
            $users = User::where('id', Auth::id())->get()->pluck('email', 'id');

            $communities = CommunityGroups::join('communities', 'community_groups.community_id', '=', 'communities.id')
                ->where('community_groups.group_id', $request->subgroup)
                ->pluck('communities.name','communities.id');

            return view('groups.create', compact('subgroup', 'levels', 'communities', 'users'));
        }     
    }

    /**
     * Store a newly created Group in storage.
     *
     * @param CreateGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateGroupRequest $request)
    {
        $input = $request->all();

        $group = $this->groupRepository->create($input);
        $group->communities()->attach($request->communities);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.groups', 1)]));

        return redirect(route('groups.index'));
    }

    /**
     * Display the specified Group.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrfail(Auth::id());        
        
        if(is_null($user->parent_id))
        {
            $user_id = Auth::id(); 
        }else{
            $user_id = $user->parent_id;
        } 

        $groups = $this->groupRepository
            ->makeModel()
            ->qGroup($user_id);

        if ($groups > 0){
            $group = $this->groupRepository->find($id);
            $people = Person::join('community_people', 'community_people.person_id', '=', 'people.id')
                    ->where('community_people.group_id', $id)
                    ->select('people.*')
                    ->paginate(config('global.per_page'));
            $meetings = Meeting::join('group_meetings', 'meetings.id', '=', 'group_meetings.meeting_id')
                    ->where('group_meetings.group_id' ,$id)
                    ->select('meetings.*')
                    ->paginate(config('global.per_page'));

            $assitantsPerMonthFilterGroup = $this->assitantsPerMonthFilterGroup($id); 
            $assistantsPerMeetingFilterGroup = $this->assistantsPerMeetingFilterGroup($id);
                    
        }else{
            abort(401);
        }

        if (empty($group)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.groups', 1)]));

            return redirect(route('groups.index'));
        }

        return view('groups.show', compact('group', 'people', 'meetings', 'assitantsPerMonthFilterGroup', 'assistantsPerMeetingFilterGroup'));
    }

    /**
     * Show the form for editing the specified Group.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrfail(Auth::id());        
        
        if(is_null($user->parent_id))
        {
            $user_id = Auth::id(); 
        }else{
            $user_id = $user->parent_id;
        } 

        $groups = $this->groupRepository
            ->makeModel()
            ->qGroup($user_id);

        if ($groups > 0){
            $group = $this->groupRepository->find($id);
        }else{
            abort(401);
        }

        $communities = Community::communities(Auth::id())->pluck('name','id');

        $user = User::findOrfail(Auth::id());

        if(is_null($user->parent_id))
        {
            $user_parent = User::where('id', Auth::id());
            $users = User::where('parent_id', Auth::id())->union($user_parent)->get()->pluck('email', 'id');
        }else{
            $user_parent = User::where('id', $user->parent_id);
            $users = User::where('parent_id', $user->parent_id)->union($user_parent)->get()->pluck('email', 'id');
        }  

        if (empty($group)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.groups', 1)]));

            return redirect(route('groups.index'));
        }

        return view('groups.edit', compact('group', 'communities', 'users'));
    }

    /**
     * Update the specified Group in storage.
     *
     * @param int $id
     * @param UpdateGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGroupRequest $request)
    {
        $user = User::findOrfail(Auth::id());        
        
        if(is_null($user->parent_id))
        {
            $user_id = Auth::id(); 
        }else{
            $user_id = $user->parent_id;
        } 

        $groups = $this->groupRepository
            ->makeModel()
            ->qGroup($user_id);

        if ($groups > 0){
            $group = $this->groupRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($group)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.groups', 1)]));

            return redirect(route('groups.index'));
        }

        $group = $this->groupRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.groups', 1)]));

        return redirect(route('groups.index'));
    }

    /**
     * Remove the specified Group from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $groups = $this->groupRepository
            ->makeModel()
            ->qGroup(Auth::id());

        if ($groups > 0){
            $group = $this->groupRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($group)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.groups', 1)]));

            return redirect(route('groups.index'));
        }

        $this->groupRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.groups', 1)]));

        return redirect(route('groups.index'));
    }

    public function assitantsPerMonthFilterGroup($idGroup){
        $queryAssitantsPerMonth = Assistant::select(DB::raw('MONTH(assistants.created_at) as id_assistant'),
                                DB::raw('MONTHNAME(assistants.created_at) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->join('group_meetings', 'meetings.id', '=', 'group_meetings.meeting_id')
                                ->where('assistants.confirmation', '=', 1)
                                ->where('group_meetings.group_id', $idGroup)
                                ->whereYear('meetings.created_at', Carbon::now()->format('Y'))                      
                                ->groupBy('id_assistant', 'month')->get();

        $queryNoAssitantsPerMonth = Assistant::select(DB::raw('MONTH(assistants.created_at) as id_assistant'),
                                DB::raw('MONTHNAME(assistants.created_at) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->join('group_meetings', 'meetings.id', '=', 'group_meetings.meeting_id')
                                ->where('assistants.confirmation', '=', 0)
                                ->where('group_meetings.group_id', $idGroup)
                                ->whereYear('meetings.created_at', Carbon::now()->format('Y'))                      
                                ->groupBy('id_assistant', 'month')->get();

        $queryNewAssitantsPerMonth = Assistant::select(DB::raw('MONTH(assistants.created_at) as id_assistant'),
                                DB::raw('MONTHNAME(assistants.created_at) as month'), 
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->join('group_meetings', 'meetings.id', '=', 'group_meetings.meeting_id')
                                ->where('assistants.new_assistant', '=', 1)
                                ->where('group_meetings.group_id', $idGroup)
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

    public function assistantsPerMeetingFilterGroup($idGroup){

        $queryAssitantsPerMeeting = Assistant::select('meetings.id', 
                                'meetings.name',
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->join('group_meetings', 'meetings.id', '=', 'group_meetings.meeting_id')
                                ->where('assistants.confirmation', '=', 1)
                                ->where('group_meetings.group_id', $idGroup)
                                ->whereMonth('meetings.created_at', Carbon::now()->format('m'))                      
                                ->groupBy('id', 'name')->get();

        $queryNoAssitantsPerMeeting = Assistant::select('meetings.id', 
                                'meetings.name',
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->join('group_meetings', 'meetings.id', '=', 'group_meetings.meeting_id')
                                ->where('assistants.confirmation', '=', 0)
                                ->where('group_meetings.group_id', $idGroup)
                                ->whereMonth('meetings.created_at', Carbon::now()->format('m'))                      
                                ->groupBy('id', 'name')->get();

        $queryNewAssitantsPerMeeting = Assistant::select('meetings.id', 
                                'meetings.name',
                                DB::raw('COUNT(*) as n'))
                                ->join('meetings','meetings.id', '=','assistants.meeting_id')
                                ->join('group_meetings', 'meetings.id', '=', 'group_meetings.meeting_id')
                                ->where('assistants.new_assistant', '=', 1)
                                ->where('group_meetings.group_id', $idGroup)
                                ->whereMonth('meetings.created_at', Carbon::now()->format('m'))                      
                                ->groupBy('id', 'name')->get();

        if(!$queryAssitantsPerMeeting->isEmpty()){
            foreach ($queryAssitantsPerMeeting as $query) {
                $meetingNamePerMonth[] = $query->name;
                $nAssitantsPerMeeting[] = $query->n;
            }
        }else{
            $meetingNamePerMonth[] = "";
            $nAssitantsPerMeeting[] = "";
        }

        if(!$queryNoAssitantsPerMeeting->isEmpty()){
            foreach ($queryNoAssitantsPerMeeting as $query) {
                $meetingNamePerMonth[] = $query->name;
                $nNoAssitantsPerMeeting[] = $query->n;
            }
        }else{
            $meetingNamePerMonth[] = "";
            $nNoAssitantsPerMeeting[] = "";
        }

        if(!$queryNewAssitantsPerMeeting->isEmpty()){
            foreach ($queryNewAssitantsPerMeeting as $query) {
                $meetingNamePerMonth[] = $query->name;
                $nNewAssitantsPerMeeting[] = $query->n;
            }
        }else{
            $meetingNamePerMonth[] = "";
            $nNewAssitantsPerMeeting[] = "";
        }

        $assistantsPerMeeting = new AssistantsPerMeeting;
        $assistantsPerMeeting->labels($meetingNamePerMonth);
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
}
