<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests;
use App\Http\Requests\Administrator\CreateRoleRequest;
use App\Http\Requests\Administrator\UpdateRoleRequest;
use App\Repositories\Administrator\RoleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;	
use Illuminate\Http\Request;

class RoleController extends AppBaseController
{
     /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $rolRepo)
    {
        $this->roleRepository = $rolRepo;
    }

    /**
     * Display a listing of the role.
     *
     * @param RoleDataTable $roleDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = $this->roleRepository->paginate(config('global.per_page'));

        return view('administrator.roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Response
     */
    public function create()
    {
        $abilities = Ability::get()->pluck('name', 'name');

        return view('administrator.roles.create', compact('abilities'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $role = $this->roleRepository->create($input);
        $role->assign($request->input('roles'));

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.roles', 1)]));

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->find($id);

        $role->load('abilities');

        if (empty($role)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.roles', 1)]));

            return redirect(route('roles.index'));
        }

        return view('administrator.roles.show')->with('abilities', $abilities);
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->find($id);
        $roles = Role::get()->pluck('name', 'name');

        if (empty($role)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.roles', 1)]));

            return redirect(route('roles.index'));
        }

        return view('administrator.roles.edit',compact('role', 'roles'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param  int              $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.roles', 1)]));

            return redirect(route('roles.index'));
        }

        $role = $this->roleRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.roles', 1)]));

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.roles', 1)]));

            return redirect(route('roles.index'));
        }

        $this->roleRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.roles', 1)]));

        return redirect(route('roles.index'));
    }
}
