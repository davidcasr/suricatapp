<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Repositories\MeetingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Community;
use App\Models\Person;
use App\Models\Assistant;
use App\Models\Group;
use App\Models\CommunityPeople;
use App\User;

class MeetingController extends AppBaseController
{
    /** @var  MeetingRepository */
    private $meetingRepository;

    public function __construct(MeetingRepository $meetingRepo)
    {
        $this->meetingRepository = $meetingRepo;
    }

    /**
     * Display a listing of the Meeting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        
        if(Auth::user()->isAn('group_leader')){
            $meetings = $this->meetingRepository
                ->makeModel()
                ->where('meetings.user_id', Auth::user()->id);
        }else{
            $meetings = $this->meetingRepository
                ->makeModel()
                ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
                ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
                ->join('community_users', 'community_users.community_id', '=', 'communities.id');

            if (!empty($keyword)) {
                $meetings = $meetings->where('community_users.user_id', Auth::user()->id)
                ->orWhere('meetings.name', 'LIKE', '%$keyword%');        
            }else{
                $meetings = $meetings->where('community_users.user_id', Auth::user()->id);
            }
        }        

        $meetings = $meetings->select('meetings.*')
            ->distinct()
            ->paginate(config('global.per_page'));

        return view('meetings.index', compact('meetings'));
    }

    /**
     * Show the form for creating a new Meeting.
     *
     * @return Response
     */
    public function create()
    {
        $user = User::findOrfail(Auth::id());        
        
        if(is_null($user->parent_id))
        {
            $user_id = Auth::id(); 
        }else{
            $user_id = $user->parent_id;
        }  

        $communities = Community::communities($user_id)->pluck('name','id');
        $people = Person::peoplePerCommunity($user_id)->pluck('fullName','id');
        $groups = Group::groupsByUser($user_id)->pluck('name', 'id');

        return view('meetings.create', compact('communities', 'people', 'groups'));
    }

    /**
     * Store a newly created Meeting in storage.
     *
     * @param CreateMeetingRequest $request
     *
     * @return Response
     */
    public function store(CreateMeetingRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $meeting = $this->meetingRepository->create($input);
        $meeting->communities()->attach($request->communities);
        $meeting->people()->attach($request->people);
        $meeting->groups()->attach($request->groups);

        if(isset($request->groups)){
            foreach($request->communities as $community){
               foreach($request->groups as $id){
                    $community_people = CommunityPeople::where('community_id', $community)
                        ->where('group_id', $id)->get()->pluck('person_id');
                    $meeting->people()->attach($community_people);
                } 
            }
        }

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.meetings', 1)]));

        return redirect(route('meetings.index'));
    }

    /**
     * Display the specified Meeting.
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

        $meetings = $this->meetingRepository
            ->makeModel()
            ->qMeeting($user_id);

        if ($meetings > 0){
            $meeting = $this->meetingRepository->find($id);
            $assistants = Assistant::where('meeting_id', $id)
                    ->join('people', 'assistants.person_id', '=', 'people.id')
                    ->select(['assistants.id', 'assistants.meeting_id', 'assistants.person_id', 'assistants.confirmation', 'people.first_name', 'people.last_name', 'people.email', 'people.phone'])
                    ->paginate(config('global.per_page'));

            $statistics_assitants = Assistant::where('meeting_id', $id)
                    ->where('confirmation', 1)
                    ->count();        
            $statistics_new_assitants = Assistant::where('meeting_id', $id)
                    ->where('new_assistant', 1)
                    ->count();
            $statistics_no_assitants = Assistant::where('meeting_id', $id)
                    ->where('confirmation', 0)
                    ->count();

        }else{
            abort(401);
        }

        if (empty($meeting)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meetings', 1)]));

            return redirect(route('meetings.index'));
        }

        return view('meetings.show', compact('meeting', 'assistants', 'statistics_assitants', 'statistics_new_assitants', 'statistics_no_assitants'));
    }

    /**
     * Show the form for editing the specified Meeting.
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

        $meetings = $this->meetingRepository
            ->makeModel()
            ->qMeeting($user_id);

        if ($meetings > 0){
            $meeting = $this->meetingRepository->find($id);
        }else{
            abort(401);
        }

        $communities = Community::communities($user_id)->pluck('name','id');
        $people = Person::peoplePerCommunity($user_id)->pluck('fullName','id');
        $groups = Group::groupsByUser($user_id)->pluck('name', 'id');

        if (empty($meeting)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meetings', 1)]));

            return redirect(route('meetings.index'));
        }

        return view('meetings.edit', compact('meeting', 'communities', 'people', 'groups'));
    }

    /**
     * Update the specified Meeting in storage.
     *
     * @param int $id
     * @param UpdateMeetingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMeetingRequest $request)
    {
        $user = User::findOrfail(Auth::id());        
        
        if(is_null($user->parent_id))
        {
            $user_id = Auth::id(); 
        }else{
            $user_id = $user->parent_id;
        }  

        $meetings = $this->meetingRepository
            ->makeModel()
            ->qMeeting($user_id);

        if ($meetings > 0){
            $meeting = $this->meetingRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($meeting)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meetings', 1)]));

            return redirect(route('meetings.index'));
        }

        $meeting = $this->meetingRepository->update($request->all(), $id);

        $meeting->communities()->detach($request->communities);
        $meeting->people()->detach($request->people);
        $meeting->groups()->detach($request->groups);

        $meeting->communities()->attach($request->communities);
        $meeting->people()->attach($request->people);
        $meeting->groups()->attach($request->groups);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.meetings', 1)]));

        return redirect(route('meetings.index'));
    }

    /**
     * Remove the specified Meeting from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail(Auth::id());        
        
        if(is_null($user->parent_id))
        {
            $user_id = Auth::id(); 
        }else{
            $user_id = $user->parent_id;
        } 

        $meetings = $this->meetingRepository
            ->makeModel()
            ->qMeeting($user_id);

        if ($meetings > 0){
            $meeting = $this->meetingRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($meeting)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meetings', 1)]));

            return redirect(route('meetings.index'));
        }

        $this->meetingRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.meetings', 1)]));

        return redirect(route('meetings.index'));
    }
}
