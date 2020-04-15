<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Administrator\CreateUserRequest;
use App\Http\Requests\Administrator\UpdateUserRequest;
use App\Repositories\Administrator\UserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Community;

class AssociatedUsersController extends Controller
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
        return redirect(route('account.index'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {
        $communities_auth = Community::communities(Auth::id())->count();
        if($communities_auth == 0){
            Flash::error(trans('flash.error_no_user_community'));
            return redirect(route('communities.index'));
        }else{
            return view('associated_users.create');
        }
        
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

        $communities = Community::communities(Auth::id());

        $user = $this->userRepository->create($input);
        $user->communities()->attach($communities);
        $user->assign($request->input('roles'));

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.users', 1)]));

        return redirect(route('account.index'));
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

            return redirect(route('account.index'));
        }

        return view('associated_users.show')->with('user', $user);
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
        $roles = array('supervisor' => 'Supervisor', 'reports' => 'Reportes');

        if (empty($user)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.users', 1)]));

            return redirect(route('account.index'));
        }

        return view('associated_users.edit',compact('user', 'roles'));
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

            return redirect(route('account.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.users', 1)]));

        return redirect(route('account.index'));
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

            return redirect(route('account.index'));
        }

        $this->userRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.users', 1)]));

        return redirect(route('account.index'));
    }
}
