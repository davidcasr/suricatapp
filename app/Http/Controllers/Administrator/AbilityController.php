<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests;
use App\Http\Requests\Administrator\CreateAbilityRequest;
use App\Http\Requests\Administrator\UpdateAbilityRequest;
use App\Repositories\Administrator\AbilityRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Silber\Bouncer\Database\Ability;
use Illuminate\Http\Request;

class AbilityController extends AppBaseController
{
      /** @var  AbilityRepository */
    private $abilityRepository;

    public function __construct(AbilityRepository $abilityRepo)
    {
        $this->abilityRepository = $abilityRepo;
    }

    /**
     * Display a listing of the ability.
     *
     * @param AbilityDataTable $abilityDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        $abilities = $this->abilityRepository->paginate(config('global.per_page'));

        return view('administrator.abilities.index')
            ->with('abilities', $abilities);
    }

    /**
     * Show the form for creating a new ability.
     *
     * @return Response
     */
    public function create()
    {
        return view('administrator.abilities.create');
    }

    /**
     * Store a newly created ability in storage.
     *
     * @param CreateAbilityRequest $request
     *
     * @return Response
     */
    public function store(CreateAbilityRequest $request)
    {
        $input = $request->all();

        $ability = $this->abilityRepository->create($input);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.abilities', 1)]));

        return redirect(route('abilities.index'));
    }

    /**
     * Display the specified ability.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ability = $this->abilityRepository->find($id);

        if (empty($ability)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.abilities', 1)]));

            return redirect(route('abilities.index'));
        }

        return view('administrator.abilities.show')->with('ability', $ability);
    }

    /**
     * Show the form for editing the specified ability.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ability = $this->abilityRepository->find($id);

        if (empty($ability)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.abilities', 1)]));

            return redirect(route('abilities.index'));
        }

        return view('administrator.abilities.edit',compact('ability'));
    }

    /**
     * Update the specified ability in storage.
     *
     * @param  int              $id
     * @param UpdateAbilityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAbilityRequest $request)
    {
        $ability = $this->abilityRepository->find($id);

        if (empty($ability)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.abilities', 1)]));

            return redirect(route('abilities.index'));
        }

        $ability = $this->abilityRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.abilities', 1)]));

        return redirect(route('abilities.index'));
    }

    /**
     * Remove the specified ability from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ability = $this->abilityRepository->find($id);

        if (empty($ability)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.abilities', 1)]));

            return redirect(route('abilities.index'));
        }

        $this->abilityRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.abilities', 1)]));

        return redirect(route('abilities.index'));
    }
}
