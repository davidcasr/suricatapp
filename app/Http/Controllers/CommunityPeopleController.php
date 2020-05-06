<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Repositories\PersonRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\CommunityPeople;
use App\Models\Group;
use App\Models\Profile;
use App\Models\Person;

class CommunityPeopleController extends AppBaseController
{
    /**
     * Show the form for creating a new CommunityPeople.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $groups = Group::groupsByUser(Auth::id())->pluck('name', 'id');

        $profiles = Profile::profilesByUser(Auth::id())->pluck('name', 'id');

        $person_id = $request->person;

        return view('community_people.create', compact('groups', 'profiles', 'person_id'));
    }

    /**
     * Store a newly created CommunityPeople in storage.
     *
     * @param CreatePersonRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $communities = CommunityPeople::where('person_id', $request->person_id)
                ->whereNull('group_id')
                ->whereNull('profile_id')
                ->get();
        
        foreach ($communities as $community){
        	CommunityPeople::create([
        		'community_id' 	=> $community->community_id,
        		'person_id' 	=> $request['person_id'],
        		'group_id' 		=> $request['groups'],
        		'profile_id' 	=> $request['profiles'],
        	]);
        }
        
        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.people', 1)]));

        return redirect(route('people.show', $request->person_id));
    }

    /**
     * Remove the specified CommunityPeople from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        CommunityPeople::destroy($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.people', 1)]));

        return redirect(route('people.show', $request->person_id));
    }
}
