<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Repositories\CommunityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CommunityController extends AppBaseController
{
    /** @var  CommunityRepository */
    private $communityRepository;

    public function __construct(CommunityRepository $communityRepo)
    {
        $this->communityRepository = $communityRepo;
    }

    /**
     * Display a listing of the Community.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $communities = $this->communityRepository->all();

        return view('communities.index')
            ->with('communities', $communities);
    }

    /**
     * Show the form for creating a new Community.
     *
     * @return Response
     */
    public function create()
    {
        return view('communities.create');
    }

    /**
     * Store a newly created Community in storage.
     *
     * @param CreateCommunityRequest $request
     *
     * @return Response
     */
    public function store(CreateCommunityRequest $request)
    {
        $input = $request->all();

        $community = $this->communityRepository->create($input);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.communities', 1)]));

        return redirect(route('communities.index'));
    }

    /**
     * Display the specified Community.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $community = $this->communityRepository->find($id);

        if (empty($community)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.communities', 1)]));

            return redirect(route('communities.index'));
        }

        return view('communities.show')->with('community', $community);
    }

    /**
     * Show the form for editing the specified Community.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $community = $this->communityRepository->find($id);

        if (empty($community)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.communities', 1)]));

            return redirect(route('communities.index'));
        }

        return view('communities.edit')->with('community', $community);
    }

    /**
     * Update the specified Community in storage.
     *
     * @param int $id
     * @param UpdateCommunityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCommunityRequest $request)
    {
        $community = $this->communityRepository->find($id);

        if (empty($community)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.communities', 1)]));

            return redirect(route('communities.index'));
        }

        $community = $this->communityRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.communities', 1)]));

        return redirect(route('communities.index'));
    }

    /**
     * Remove the specified Community from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $community = $this->communityRepository->find($id);

        if (empty($community)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.communities', 1)]));

            return redirect(route('communities.index'));
        }

        $this->communityRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.communities', 1)]));

        return redirect(route('communities.index'));
    }
}
