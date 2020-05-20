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
use App\User;
use App\Models\GenList;
use App\Models\Community;
use App\Models\CommunityPeople;
use App\Models\Feature;
use App\Models\Group;
use App\Models\Profile;
use App\Models\Country;
use App\Models\Meeting;

class GuestController extends AppBaseController
{
    /** @var  PersonRepository */
    private $personRepository;

    public function __construct(PersonRepository $personRepo)
    {
        $this->personRepository = $personRepo;
    }

    /**
     * Show the form for creating a new Person.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $user = User::findOrfail(Auth::id());        
        
        if(is_null($user->parent_id))
        {
            $user_id = Auth::id(); 
        }else{
            $user_id = $user->parent_id;
        }

        $communities_auth = Community::communities($user_id);
        
        if($communities_auth->count() > 0){

            $q_people_register = CommunityPeople::qCommunityPeople(Auth::id());
            $user = User::findOrfail(Auth::id());        
                
            if(is_null($user->parent_id))
            {
                $q_people_plan = User::infoPlan(Auth::id())->first();
            }else{
                $q_people_plan = User::infoPlan($user->parent_id)->first();
            }

            if($q_people_register >= $q_people_plan->q_users){
                abort(401);
            }else{
                $communities = $communities_auth->pluck('name','id');

                $sexes = GenList::where('group_id','1')->get(['id', 'item_description'])->pluck('item_description','id');

                $features = Feature::featuresByUser(Auth::id())->pluck('name', 'id');

                $groups = Group::groupsByUser(Auth::id())->pluck('name', 'id');

                $profiles = Profile::profilesByUser(Auth::id())->pluck('name', 'id');

                $countries = Country::all()->pluck('name', 'id');

                $meeting_id = $request->meeting;

                return view('guests.create', compact('communities','sexes', 'features', 'groups', 'profiles', 'countries', 'meeting_id'));
            }            
        }else{
            Flash::error(trans('flash.error_no_person_community'));
            return redirect(route('communities.index'));
        }        
        
    }

    /**
     * Store a newly created Person in storage.
     *
     * @param CreatePersonRequest $request
     *
     * @return Response
     */
    public function store(CreatePersonRequest $request)
    {
        $input = $request->all();
        $input['status'] = 0;

        $person = $this->personRepository->create($input);
        $person->communities()->attach($request->communities);

        for($i = 0; $i < count($request->communities); $i++){
            $person->features()->attach($request->features, 
                [
                    'community_id' => $request->communities[$i]
                ]); 
        }  

        $meeting = Meeting::findOrFail($request->meeting_id);
        $meeting->people()->attach($person->id, ['new_assistant' => 1]);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.people', 1)]));

        return redirect(route('meetings.index'));
    }
}
