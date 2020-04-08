<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests;
use App\Http\Requests\Administrator\CreateGenListRequest;
use App\Http\Requests\Administrator\UpdateGenListRequest;
use App\Repositories\Administrator\GenListRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\GenGroup;
use Illuminate\Http\Request;

class GenListController extends AppBaseController
{
    /** @var  GenListRepository */
    private $genListRepository;

    public function __construct(GenListRepository $genListRepo)
    {
        $this->genListRepository = $genListRepo;
    }

    /**
     * Display a listing of the GenList.
     *
     * @param GenListDataTable $genListDataTable
     * @return Response
     */
    public function index(Request $request)
    {

        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $gen_lists = $this->genListRepository
            ->where('item_description', 'LIKE', '%$keyword%')
            ->paginate(config('global.per_page'));
        }else{
            $gen_lists = $this->genListRepository->paginate(config('global.per_page'));
        }       

        return view('administrator.gen_lists.index')
            ->with('gen_lists', $gen_lists);
    }

    /**
     * Show the form for creating a new GenList.
     *
     * @return Response
     */
    public function create()
    {
        $gen_group = GenGroup::get()->pluck('group_description', 'id');

        return view('administrator.gen_lists.create', compact('gen_group'));
    }

    /**
     * Store a newly created GenList in storage.
     *
     * @param CreateGenListRequest $request
     *
     * @return Response
     */
    public function store(CreateGenListRequest $request)
    {
        $input = $request->all();

        $genList = $this->genListRepository->create($input);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.gen_list', 1)]));

        return redirect(route('genLists.index'));
    }

    /**
     * Display the specified GenList.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $genList = $this->genListRepository->find($id);

        if (empty($genList)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.gen_list', 1)]));

            return redirect(route('genLists.index'));
        }

        return view('administrator.gen_lists.show')->with('genList', $genList);
    }

    /**
     * Show the form for editing the specified GenList.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $genList = $this->genListRepository->find($id);
        $gen_group = GenGroup::get()->pluck('group_description', 'id');

        if (empty($genList)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.gen_list', 1)]));

            return redirect(route('genLists.index'));
        }

        return view('administrator.gen_lists.edit', compact('genList', 'gen_group'));
    }

    /**
     * Update the specified GenList in storage.
     *
     * @param  int              $id
     * @param UpdateGenListRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGenListRequest $request)
    {
        $genList = $this->genListRepository->find($id);

        if (empty($genList)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.gen_list', 1)]));

            return redirect(route('genLists.index'));
        }

        $genList = $this->genListRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.gen_list', 1)]));

        return redirect(route('genLists.index'));
    }

    /**
     * Remove the specified GenList from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $genList = $this->genListRepository->find($id);

        if (empty($genList)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.gen_list', 1)]));

            return redirect(route('genLists.index'));
        }

        $this->genListRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.gen_list', 1)]));

        return redirect(route('genLists.index'));
    }
}
