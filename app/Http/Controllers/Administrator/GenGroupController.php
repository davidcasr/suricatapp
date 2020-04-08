<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests;
use App\Http\Requests\Administrator\CreateGenGroupRequest;
use App\Http\Requests\Administrator\UpdateGenGroupRequest;
use App\Repositories\Administrator\GenGroupRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request;

class GenGroupController extends AppBaseController
{
    /** @var  GenGroupRepository */
    private $genGroupRepository;

    public function __construct(GenGroupRepository $genGroupRepo)
    {
        $this->genGroupRepository = $genGroupRepo;
    }

    /**
     * Display a listing of the Gen_Group.
     *
     * @param GenGroupDataTable $genGroupDataTable
     * @return Response
     */
    public function index(Request $request)
    {

        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $gen_groups = $this->genGroupRepository
            ->where('group_description', 'LIKE', '%$keyword%')
            ->paginate(config('global.per_page'));
        }else{
            $gen_groups = $this->genGroupRepository->paginate(config('global.per_page')); 
        }

        return view('administrator.gen_groups.index')
            ->with('gen_groups', $gen_groups);
    }

    /**
     * Show the form for creating a new Gen_Group.
     *
     * @return Response
     */
    public function create()
    {
        return view('administrator.gen_groups.create');
    }

    /**
     * Store a newly created Gen_Group in storage.
     *
     * @param CreateGenGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateGenGroupRequest $request)
    {
        $input = $request->all();

        $genGroup = $this->genGroupRepository->create($input);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.gen_group', 1)]));

        return redirect(route('genGroups.index'));
    }

    /**
     * Display the specified Gen_Group.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $genGroup = $this->genGroupRepository->find($id);

        if (empty($genGroup)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.gen_group', 1)]));

            return redirect(route('genGroups.index'));
        }

        return view('administrator.gen_groups.show')->with('genGroup', $genGroup);
    }

    /**
     * Show the form for editing the specified Gen_Group.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $genGroup = $this->genGroupRepository->find($id);

        if (empty($genGroup)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.gen_group', 1)]));

            return redirect(route('genGroups.index'));
        }

        return view('administrator.gen_groups.edit')->with('genGroup', $genGroup);
    }

    /**
     * Update the specified Gen_Group in storage.
     *
     * @param  int              $id
     * @param UpdateGenGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGenGroupRequest $request)
    {
        $genGroup = $this->genGroupRepository->find($id);

        if (empty($genGroup)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.gen_group', 1)]));

            return redirect(route('genGroups.index'));
        }

        $genGroup = $this->genGroupRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.gen_group', 1)]));

        return redirect(route('genGroups.index'));
    }

    /**
     * Remove the specified Gen_Group from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $genGroup = $this->genGroupRepository->find($id);

        if (empty($genGroup)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.gen_group', 1)]));

            return redirect(route('genGroups.index'));
        }

        $this->genGroupRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.gen_group', 1)]));

        return redirect(route('genGroups.index'));
    }
}
