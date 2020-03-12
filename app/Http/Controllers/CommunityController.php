<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Repositories\CommunityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\CommunityUsers;

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
        $communities = $this->communityRepository
            ->makeModel()
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->paginate(config('global.per_page'));

        $q_communities_register = CommunityUsers::qCommunityUsers(Auth::id());
        $q_communities_plan = User::infoPlan(Auth::id())->get(['q_communities'])->pluck('q_communities')[0];

        if($q_communities_register >= $q_communities_plan){
            $button_create = false;
        }else{
            $button_create = true;
        }

        return view('communities.index', compact('communities', 'button_create'));
    }

    /**
     * Show the form for creating a new Community.
     *
     * @return Response
     */
    public function create()
    {
        $q_communities_register = CommunityUsers::qCommunityUsers(Auth::id());
        $q_communities_plan = User::infoPlan(Auth::id())->get(['q_communities'])->pluck('q_communities')[0];

        if($q_communities_register >= $q_communities_plan){
            abort(401);
        }else{
            return view('communities.create');
        }
        
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

        $community->users()->attach(Auth::user()->id);

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
        $communities = $this->communityRepository
            ->makeModel()
            ->qCommunities(Auth::id(), $id);

        if ($communities > 0){
            $community = $this->communityRepository->find($id);
        }else{
            abort(401);
        }
            
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
        $communities = $this->communityRepository
            ->makeModel()
            ->qCommunities(Auth::id(), $id);;

        if ($communities > 0){
            $community = $this->communityRepository->find($id);
        }else{
            abort(401);
        }

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
        $communities = $this->communityRepository
            ->makeModel()
            ->qCommunities(Auth::id(), $id);

        if ($communities > 0){
            $community = $this->communityRepository->find($id);
        }else{
            abort(401);
        }

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
        /*
        $communities = $this->communityRepository
            ->makeModel()
            ->qCommunities(Auth::id(), $id);

        if ($communities > 0){
            $community = $this->communityRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($community)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.communities', 1)]));

            return redirect(route('communities.index'));
        }

        $this->communityRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.communities', 1)]));

        return redirect(route('communities.index'));
        */
    }
}
