<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests;
use App\Http\Requests\Administrator\CreateUserRequest;
use App\Http\Requests\Administrator\UpdateUserRequest;
use App\Repositories\Administrator\UserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;

class UserController extends AppBaseController
{
     /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the user.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->paginate(config('global.per_page'));

        return view('administrator.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::get()->pluck('name', 'name');

        return view('administrator.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);
        $user->assign($request->input('roles'));

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.users', 1)]));

        return redirect(route('users.index'));
    }

    /**
     * Display the specified user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        $user->load('roles');

        if (empty($user)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.users', 1)]));

            return redirect(route('users.index'));
        }

        return view('administrator.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $roles = Role::get()->pluck('name', 'name');

        if (empty($user)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.users', 1)]));

            return redirect(route('users.index'));
        }

        return view('administrator.users.edit',compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.users', 1)]));

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.users', 1)]));

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.users', 1)]));

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.users', 1)]));

        return redirect(route('users.index'));
    }
}
