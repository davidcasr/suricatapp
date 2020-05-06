<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Administrator\UserRepository;
use App\Http\Requests\Administrator\UpdateUserRequest;
use App\User;
use App\Models\Plan;
use Flash;
use Bouncer;

class AccountController extends Controller
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function index(Request $request)
    {        
    	$user = User::findOrfail(Auth::id());

        if(Bouncer::is($user)->a('admin')){

            $plans = Plan::join('plan_users','plan_users.plan_id', '=', 'plans.id')
            ->where('plan_users.user_id', Auth::id())
            ->get();

            $user = User::findOrfail(Auth::id());        
            
            if(is_null($user->parent_id))
            {
                $users = User::where('parent_id', Auth::id())->paginate(config('global.per_page'));
                $q_users_register = User::where('parent_id', Auth::id())->count();
                $q_admin_per_user = User::infoPlan(Auth::id())->first();
            }else{
                $q_users_register = User::where('parent_id', $user->parent_id)->count();
                $q_admin_per_user = User::infoPlan($user->parent_id)->first();
            }

            if($q_users_register < $q_admin_per_user->q_administrators){
                $button_create = true;
            }else{
                $button_create = false;
            }
           
            return view('account.index', compact('user', 'plans', 'users', 'button_create'));
        }else{
            return view('account.index', compact('user'));
        }     
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

        if (empty($user)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.users', 1)]));

            return redirect(route('account.index'));
        }

        return view('account.edit',compact('user'));
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
}

