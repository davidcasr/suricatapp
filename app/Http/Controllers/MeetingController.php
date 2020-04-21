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

        if (!empty($keyword)) {
            $meetings = $this->meetingRepository
            ->makeModel()
            ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
            ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->orWhere('meetings.name', 'LIKE', '%$keyword%')
            ->select('meetings.*')
            ->distinct()
            ->paginate(config('global.per_page'));
        }else{
            $meetings = $this->meetingRepository
            ->makeModel()
            ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
            ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->select('meetings.*')
            ->distinct()
            ->paginate(config('global.per_page'));
        }

        return view('meetings.index', compact('meetings'));
    }

    /**
     * Show the form for creating a new Meeting.
     *
     * @return Response
     */
    public function create()
    {
        $communities = Community::communities(Auth::id())->pluck('name','id');
        $assistants = Person::peoplePerCommunity(Auth::id())->pluck('fullName','id');

        return view('meetings.create', compact('communities', 'assistants'));
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

        if($request->assistants != null){
            foreach($request->assistants as $assistant){
                $meeting->assistants()->create([
                    'person_id' => $assistant
                ]);
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
        $meetings = $this->meetingRepository
            ->makeModel()
            ->qMeeting(Auth::id());

        if ($meetings > 0){
            $meeting = $this->meetingRepository->find($id);
            $assistants = Assistant::where('meeting_id', $id)
                    ->paginate(config('global.per_page'));

        }else{
            abort(401);
        }

        if (empty($meeting)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meetings', 1)]));

            return redirect(route('meetings.index'));
        }

        return view('meetings.show', compact('meeting', 'assistants'));
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
        $meetings = $this->meetingRepository
            ->makeModel()
            ->qMeeting(Auth::id());

        if ($meetings > 0){
            $meeting = $this->meetingRepository->find($id);
            $meeting->load('assistants');
        }else{
            abort(401);
        }

        $communities = Community::communities(Auth::id())->pluck('name','id');
        $assistants = Person::peoplePerCommunity(Auth::id())->pluck('fullName','id');

        if (empty($meeting)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meetings', 1)]));

            return redirect(route('meetings.index'));
        }

        return view('meetings.edit', compact('meeting', 'communities', 'assistants'));
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
        $meetings = $this->meetingRepository
            ->makeModel()
            ->qMeeting(Auth::id());

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

        if($request->assistants != null){
            foreach($request->assistants as $assistant){               
                $meeting->assistants()->create([
                    'person_id' => $assistant
                ]);
            }   
        }else{
            $assistants = Assistant::where('meeting_id', $id)->delete();  
        }

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
        $meetings = $this->meetingRepository
            ->makeModel()
            ->qMeeting(Auth::id());

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
