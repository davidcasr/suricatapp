<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests;
use App\Http\Requests\Administrator\CreatePlanRequest;
use App\Http\Requests\Administrator\UpdatePlanRequest;
use App\Repositories\Administrator\PlanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request;

class PlanController extends AppBaseController
{
    /** @var  PlanRepository */
    private $planRepository;

    public function __construct(PlanRepository $planRepo)
    {
        $this->planRepository = $planRepo;
    }

    /**
     * Display a listing of the Plan.
     *
     * @param PlanDataTable $planDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        $plans = $this->planRepository->paginate(config('global.per_page'));

        return view('administrator.plans.index')
            ->with('plans', $plans);
    }

    /**
     * Show the form for creating a new Plan.
     *
     * @return Response
     */
    public function create()
    {
        return view('administrator.plans.create');
    }

    /**
     * Store a newly created Plan in storage.
     *
     * @param CreatePlanRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanRequest $request)
    {
        $input = $request->all();

        $plan = $this->planRepository->create($input);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.plans', 1)]));

        return redirect(route('plans.index'));
    }

    /**
     * Display the specified Plan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $plan = $this->planRepository->find($id);

        if (empty($plan)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.plans', 1)]));

            return redirect(route('plans.index'));
        }

        return view('administrator.plans.show')->with('plan', $plan);
    }

    /**
     * Show the form for editing the specified Plan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $plan = $this->planRepository->find($id);

        if (empty($plan)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.plans', 1)]));

            return redirect(route('plans.index'));
        }

        return view('administrator.plans.edit')->with('plan', $plan);
    }

    /**
     * Update the specified Plan in storage.
     *
     * @param  int              $id
     * @param UpdatePlanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanRequest $request)
    {
        $plan = $this->planRepository->find($id);

        if (empty($plan)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.plans', 1)]));

            return redirect(route('plans.index'));
        }

        $plan = $this->planRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.plans', 1)]));

        return redirect(route('plans.index'));
    }

    /**
     * Remove the specified Plan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $plan = $this->planRepository->find($id);

        if (empty($plan)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.plans', 1)]));

            return redirect(route('plans.index'));
        }

        $this->planRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.plans', 1)]));

        return redirect(route('plans.index'));
    }
}
