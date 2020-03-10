<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssistantRequest;
use App\Http\Requests\UpdateAssistantRequest;
use App\Repositories\AssistantRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

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
        $assistants = $this->assistantRepository->all();

        return view('assistants.index')
            ->with('assistants', $assistants);
    }

    /**
     * Show the form for creating a new Assistant.
     *
     * @return Response
     */
    public function create()
    {
        return view('assistants.create');
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
        $assistant = $this->assistantRepository->find($id);

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
        $assistant = $this->assistantRepository->find($id);

        if (empty($assistant)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.assistants', 1)]));

            return redirect(route('assistants.index'));
        }

        return view('assistants.edit')->with('assistant', $assistant);
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
        $assistant = $this->assistantRepository->find($id);

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
        $assistant = $this->assistantRepository->find($id);

        if (empty($assistant)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.assistants', 1)]));

            return redirect(route('assistants.index'));
        }

        $this->assistantRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.assistants', 1)]));

        return redirect(route('assistants.index'));
    }
}
