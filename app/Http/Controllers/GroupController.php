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
use App\Models\Community;
use App\Models\Group;

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
        $groups = $this->groupRepository
            ->makeModel()
            ->join('community_people','community_people.group_id', '=','groups.id')
            ->join('communities', 'community_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->select('groups.*')
            ->paginate(config('global.per_page'));

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new Group.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if(!$request->subgroup){
            return view('groups.create');
        }else{
            $subgroup = $request->subgroup;
            $levels = Group::where('id', $request->subgroup)->select('level')->get();
            return view('groups.create', compact('subgroup', 'levels'));
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
        
        $community = Community::communities(Auth::id());

        $group = $this->groupRepository->create($input);
        $group->communities()->attach($community);

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

        return view('groups.show')->with('group', $group);
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

        return view('groups.edit')->with('group', $group);
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
}
