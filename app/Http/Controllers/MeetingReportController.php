<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMeetingReportRequest;
use App\Http\Requests\UpdateMeetingReportRequest;
use App\Repositories\MeetingReportRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

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
        $meetingReports = $this->meetingReportRepository->all();

        return view('meeting_reports.index')
            ->with('meetingReports', $meetingReports);
    }

    /**
     * Show the form for creating a new MeetingReport.
     *
     * @return Response
     */
    public function create()
    {
        return view('meeting_reports.create');
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
        $meetingReport = $this->meetingReportRepository->find($id);

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
        $meetingReport = $this->meetingReportRepository->find($id);

        if (empty($meetingReport)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meeting_reports', 1)]));

            return redirect(route('meetingReports.index'));
        }

        return view('meeting_reports.edit')->with('meetingReport', $meetingReport);
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
        $meetingReport = $this->meetingReportRepository->find($id);

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
        $meetingReport = $this->meetingReportRepository->find($id);

        if (empty($meetingReport)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.meeting_reports', 1)]));

            return redirect(route('meetingReports.index'));
        }

        $this->meetingReportRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.meeting_reports', 1)]));


        return redirect(route('meetingReports.index'));
    }
}
