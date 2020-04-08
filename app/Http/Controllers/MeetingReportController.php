<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMeetingReportRequest;
use App\Http\Requests\UpdateMeetingReportRequest;
use App\Repositories\MeetingReportRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Meeting;

class MeetingReportController extends AppBaseController
{
    /** @var  MeetingReportRepository */
    private $meetingReportRepository;

    public function __construct(MeetingReportRepository $meetingReportRepo)
    {
        $this->meetingReportRepository = $meetingReportRepo;
    }

    /**
     * Display a listing of the MeetingReport.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $meetingReports = $this->meetingReportRepository
            ->makeModel()
            ->join('meetings','meeting_reports.meeting_id', '=','meetings.id')
            ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
            ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->join('people', 'assistants.person_id', '=','people.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->orWhere('people.email', 'LIKE', '%$keyword%')
            ->select('meeting_reports.*')
            ->paginate(config('global.per_page'));  
        }else{
            $meetingReports = $this->meetingReportRepository
            ->makeModel()
            ->join('meetings','meeting_reports.meeting_id', '=','meetings.id')
            ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
            ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->select('meeting_reports.*')
            ->paginate(config('global.per_page'));    
        }

        return view('meeting_reports.index', compact('meetingReports'));
    }

    /**
     * Show the form for creating a new MeetingReport.
     *
     * @return Response
     */
    public function create()
    {
        $meetings = Meeting::meetingsPerCommunity(Auth::id())->pluck('name', 'id');

        return view('meeting_reports.create', compact('meetings'));
    }

    /**
     * Store a newly created MeetingReport in storage.
     *
     * @param CreateMeetingReportRequest $request
     *
     * @return Response
     */
    public function store(CreateMeetingReportRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $meetingReport = $this->meetingReportRepository->create($input);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.meeting_reports', 1)]));

        return redirect(route('meetingReports.index'));
    }

    /**
     * Display the specified MeetingReport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $meeting_reports = $this->meetingReportRepository
            ->makeModel()
            ->qMeetingReport(Auth::id());

        if ($meeting_reports > 0){
            $meetingReport = $this->meetingReportRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($meetingReport)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meeting_reports', 1)]));

            return redirect(route('meetingReports.index'));
        }

        return view('meeting_reports.show')->with('meetingReport', $meetingReport);
    }

    /**
     * Show the form for editing the specified MeetingReport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $meeting_reports = $this->meetingReportRepository
            ->makeModel()
            ->qMeetingReport(Auth::id());

        if ($meeting_reports > 0){
            $meetingReport = $this->meetingReportRepository->find($id);
        }else{
            abort(401);
        }

        $meetings = Meeting::meetingsPerCommunity(Auth::id())->pluck('name', 'id');

        if (empty($meetingReport)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meeting_reports', 1)]));

            return redirect(route('meetingReports.index'));
        }

        return view('meeting_reports.edit', compact('meetingReport', 'meetings'));
    }

    /**
     * Update the specified MeetingReport in storage.
     *
     * @param int $id
     * @param UpdateMeetingReportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMeetingReportRequest $request)
    {
        $meeting_reports = $this->meetingReportRepository
            ->makeModel()
            ->qMeetingReport(Auth::id());

        if ($meeting_reports > 0){
            $meetingReport = $this->meetingReportRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($meetingReport)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meeting_reports', 1)]));

            return redirect(route('meetingReports.index'));
        }

        $meetingReport = $this->meetingReportRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.meeting_reports', 1)]));

        return redirect(route('meetingReports.index'));
    }

    /**
     * Remove the specified MeetingReport from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $meeting_reports = $this->meetingReportRepository
            ->makeModel()
            ->qMeetingReport(Auth::id());

        if ($meeting_reports > 0){
            $meetingReport = $this->meetingReportRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($meetingReport)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meeting_reports', 1)]));

            return redirect(route('meetingReports.index'));
        }

        $this->meetingReportRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.meeting_reports', 1)]));


        return redirect(route('meetingReports.index'));
    }
}
