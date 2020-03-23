<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssistantRequest;
use App\Http\Requests\UpdateAssistantRequest;
use App\Repositories\AssistantRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Person;
use App\Models\Meeting;

class AssistantController extends AppBaseController
{
    /** @var  AssistantRepository */
    private $assistantRepository;

    public function __construct(AssistantRepository $assistantRepo)
    {
        $this->assistantRepository = $assistantRepo;
    }

    /**
     * Display a listing of the Assistant.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $assistants = $this->assistantRepository
            ->makeModel()
            ->join('meetings', 'assistants.meeting_id', '=', 'meetings.id')
            ->join('community_meetings','community_meetings.meeting_id', '=','meetings.id')
            ->join('communities', 'community_meetings.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->select('assistants.*')
            ->paginate(config('global.per_page'));

        return view('assistants.index', compact('assistants'));
    }

    /**
     * Show the form for creating a new Assistant.
     *
     * @return Response
     */
    public function create()
    {
        $people = Person::peoplePerCommunity(Auth::id())->pluck('email', 'id');
        $meetings = Meeting::meetingsPerCommunity(Auth::id())->pluck('name', 'id');

        return view('assistants.create', compact('people', 'meetings'));
    }

    /**
     * Store a newly created Assistant in storage.
     *
     * @param CreateAssistantRequest $request
     *
     * @return Response
     */
    public function store(CreateAssistantRequest $request)
    {
        $input = $request->all();

        $assistant = $this->assistantRepository->create($input);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.assistants', 1)]));

        return redirect(route('assistants.index'));
    }

    /**
     * Display the specified Assistant.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $assitants = $this->assistantRepository
            ->makeModel()
            ->qAssitant(Auth::id());

        if ($assitants > 0){
            $assistant = $this->assistantRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($assistant)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.assistants', 1)]));

            return redirect(route('assistants.index'));
        }

        return view('assistants.show')->with('assistant', $assistant);
    }

    /**
     * Show the form for editing the specified Assistant.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $assitants = $this->assistantRepository
            ->makeModel()
            ->qAssitant(Auth::id());

        if ($assitants > 0){
            $assistant = $this->assistantRepository->find($id);
        }else{
            abort(401);
        }

        $people = Person::peoplePerCommunity(Auth::id())->pluck('email', 'id');
        $meetings = Meeting::meetingsPerCommunity(Auth::id())->pluck('name', 'id');

        if (empty($assistant)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.assistants', 1)]));

            return redirect(route('assistants.index'));
        }

        return view('assistants.edit', compact('assistant', 'people', 'meetings'));
    }

    /**
     * Update the specified Assistant in storage.
     *
     * @param int $id
     * @param UpdateAssistantRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssistantRequest $request)
    {
        $assitants = $this->assistantRepository
            ->makeModel()
            ->qAssitant(Auth::id());

        if ($assitants > 0){
            $assistant = $this->assistantRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($assistant)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.assistants', 1)]));

            return redirect(route('assistants.index'));
        }

        $assistant = $this->assistantRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.assistants', 1)]));

        return redirect(route('assistants.index'));
    }

    /**
     * Remove the specified Assistant from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assitants = $this->assistantRepository
            ->makeModel()
            ->qAssitant(Auth::id());

        if ($assitants > 0){
            $assistant = $this->assistantRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($assistant)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.assistants', 1)]));

            return redirect(route('assistants.index'));
        }

        $this->assistantRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.assistants', 1)]));

        return redirect(route('assistants.index'));
    }
}
