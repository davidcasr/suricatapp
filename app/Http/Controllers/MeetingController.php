<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Repositories\MeetingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

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
        $meetings = $this->meetingRepository->all();

        return view('meetings.index')
            ->with('meetings', $meetings);
    }

    /**
     * Show the form for creating a new Meeting.
     *
     * @return Response
     */
    public function create()
    {
        return view('meetings.create');
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

        $meeting = $this->meetingRepository->create($input);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.mettings', 1)]));

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
        $meeting = $this->meetingRepository->find($id);

        if (empty($meeting)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.mettings', 1)]));

            return redirect(route('meetings.index'));
        }

        return view('meetings.show')->with('meeting', $meeting);
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
        $meeting = $this->meetingRepository->find($id);

        if (empty($meeting)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.mettings', 1)]));

            return redirect(route('meetings.index'));
        }

        return view('meetings.edit')->with('meeting', $meeting);
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
        $meeting = $this->meetingRepository->find($id);

        if (empty($meeting)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.mettings', 1)]));

            return redirect(route('meetings.index'));
        }

        $meeting = $this->meetingRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.mettings', 1)]));

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
        $meeting = $this->meetingRepository->find($id);

        if (empty($meeting)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.mettings', 1)]));

            return redirect(route('meetings.index'));
        }

        $this->meetingRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.mettings', 1)]));

        return redirect(route('meetings.index'));
    }
}
