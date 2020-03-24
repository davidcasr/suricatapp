<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\Plan;

class AccountController extends Controller
{
    public function index(Request $request)
    {	

    	$user = User::findOrfail(Auth::id());

    	$plans = Plan::join('plan_users','plan_users.plan_id', '=', 'plans.id')
    			->where('plan_users.user_id', Auth::id())
    			->get();

    	$q_users_register = User::join('community_users', 'community_users.user_id', '=', 'users.id')
        		->whereIn('community_users.community_id', [DB::raw('( SELECT community_users.id FROM users JOIN community_users ON community_users.user_id = users.id WHERE community_users.user_id = '.Auth::id().' )') ])
        		->whereNotIn('community_users.user_id', [Auth::id()])
        		->select('users.*')
        		->count();

        $q_admin_per_user = User::infoPlan(Auth::id())->pluck('q_administrators')[0];

        if($q_users_register < $q_admin_per_user){
        	$button_create = true;
        }else{
        	$button_create = false;
        }

        $users = User::join('community_users', 'community_users.user_id', '=', 'users.id')
        		->whereIn('community_users.community_id', [DB::raw('( SELECT community_users.id FROM users JOIN community_users ON community_users.user_id = users.id WHERE community_users.user_id = '.Auth::id().' )') ])
        		->whereNotIn('community_users.user_id', [Auth::id()])
        		->select('users.*')
        		->paginate(config('global.per_page'));

    	return view('account.index', compact('user', 'plans', 'users', 'button_create'));
    }
}