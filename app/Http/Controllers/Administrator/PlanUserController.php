<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests;
use App\Http\Requests\Administrator\CreatePlanUserRequest;
use App\Http\Requests\Administrator\UpdatePlanUserRequest;
use App\Repositories\Administrator\PlanUserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request;
use App\User;
use App\Models\Plan;
use App\Models\PlanUser;

class PlanUserController extends AppBaseController
{
    /** @var  PlanUserRepository */
    private $planUserRepository;

    public function __construct(PlanUserRepository $planUserRepo)
    {
        $this->planUserRepository = $planUserRepo;
    }

    /**
     * Display a listing of the PlanUser.
     *
     * @param PlanUserDataTable $planUserDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $plan_users = $this->planUserRepository
            ->where('user_id', 'LIKE', '%$keyword%')
            ->paginate(config('global.per_page'));
        }else{
            $plan_users = $this->planUserRepository->paginate(config('global.per_page'));
        }

        return view('administrator.plan_users.index')
            ->with('plan_users', $plan_users);
    }

    /**
     * Show the form for creating a new PlanUser.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::get()->pluck('email','id');
        $plans = Plan::get()->pluck('name','id');

        return view('administrator.plan_users.create', compact('users', 'plans'));
    }

    /**
     * Store a newly created PlanUser in storage.
     *
     * @param CreatePlanUserRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanUserRequest $request)
    {
        $input = $request->all();

        $planUser = $this->planUserRepository->create($input);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.plan_users', 1)]));

        return redirect(route('plan_users.index'));
    }

    /**
     * Display the specified PlanUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $planUser = $this->planUserRepository->find($id);

        if (empty($planUser)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.plan_users', 1)]));

            return redirect(route('plan_users.index'));
        }

        return view('administrator.plan_users.show')->with('planUser', $planUser);
    }

    /**
     * Show the form for editing the specified PlanUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $planUser = $this->planUserRepository->find($id);
        $users = User::get()->pluck('email','id');
        $plans = Plan::get()->pluck('name','id');

        if (empty($planUser)) {
             Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.plan_users', 1)]));

            return redirect(route('plan_users.index'));
        }

        return view('administrator.plan_users.edit', compact('planUser', 'users', 'plans'));
    }

    /**
     * Update the specified PlanUser in storage.
     *
     * @param  int              $id
     * @param UpdatePlanUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanUserRequest $request)
    {
        $planUser = $this->planUserRepository->find($id);

        if (empty($planUser)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.plan_users', 1)]));

            return redirect(route('plan_users.index'));
        }

        $planUser = $this->planUserRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.plan_users', 1)]));

        return redirect(route('plan_users.index'));
    }

    /**
     * Remove the specified PlanUser from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $planUser = $this->planUserRepository->find($id);

        if (empty($planUser)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.plan_users', 1)]));

            return redirect(route('plan_users.index'));
        }

        $this->planUserRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.plan_users', 1)]));

        return redirect(route('plan_users.index'));
    }
}
