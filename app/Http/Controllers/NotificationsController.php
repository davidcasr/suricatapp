<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    public function index(){
    	$birthdays_nearby = Person::join('community_people','community_people.person_id', '=','people.id')
            ->join('communities', 'community_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->whereNull('community_people.group_id')
            ->whereNotNull('people.birth')
            ->whereMonth('people.birth', Carbon::now()->format('m'))
            ->distinct()
            ->get(); 

    	return view('notifications.index', compact('birthdays_nearby'));
    }

    public function show($id){
    	if($id === 'markAsRead'){
    		auth()->user()->unreadNotifications->markAsRead();
    		return redirect()->back();
    	}
    }
}
