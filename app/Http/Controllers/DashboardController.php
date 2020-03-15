<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Community;
use App\Models\Person;
use App\Models\Group;
use App\Models\Meeting;

class DashboardController extends Controller
{
    /**
     * Dashboard
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

    	$communities = Community::join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::id())
            ->get()
            ->count();
    	
    	$people = Person::join('community_people','community_people.person_id', '=','people.id')
            ->join('communities', 'community_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::id())
            ->get()
            ->count();

    	$groups = '';
    	$meetings = '';

        return view('dashboard.index', compact('communities', 'people', 'groups', 'meetings'));
    }
}
