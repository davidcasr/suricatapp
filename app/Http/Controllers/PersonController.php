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

class PersonController extends AppBaseController
{
    /** @var  PersonRepository */
    private $personRepository;

    public function __construct(PersonRepository $personRepo)
    {
        $this->personRepository = $personRepo;
    }

    /**
     * Display a listing of the Person.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $people = $this->personRepository
            ->makeModel()
            ->join('community_people','community_people.person_id', '=','people.id')
            ->join('communities', 'community_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->distinct()
            ->select('people.*')
            ->where('people.first_name', 'LIKE', '%$keyword%')
            ->orWhere('people.last_name', 'LIKE', '%$keyword%')
            ->paginate(config('global.per_page'));
        }else{
            $people = $this->personRepository
            ->makeModel()
            ->join('community_people','community_people.person_id', '=','people.id')
            ->join('communities', 'community_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->distinct()
            ->select('people.*')
            ->paginate(config('global.per_page'));
        }        

        $q_people_register = CommunityPeople::qCommunityPeople(Auth::id());
        $q_people_plan = User::infoPlan(Auth::id())->get(['q_users'])->pluck('q_users')[0];

        if($q_people_register >= $q_people_plan){
            $button_create = false;
        }else{
            $button_create = true;
        }

        return view('people.index', compact('people', 'button_create'));
    }

    /**
     * Show the form for creating a new Person.
     *
     * @return Response
     */
    public function create()
    {
        $communities_auth = Community::communities(Auth::id());
        
        if($communities_auth->count() > 0){

            $q_people_register = CommunityPeople::qCommunityPeople(Auth::id());
            $q_people_plan = User::infoPlan(Auth::id())->get(['q_users'])->pluck('q_users')[0];

            if($q_people_register >= $q_people_plan){
                abort(401);
            }else{
                $communities = $communities_auth->pluck('name','id');

                $sexes = GenList::where('group_id','1')->get(['id', 'item_description'])->pluck('item_description','id');

                $features = Feature::featuresByUser(Auth::id())->pluck('name', 'id');

                $groups = Group::groupsByUser(Auth::id())->pluck('name', 'id');

                $profiles = Profile::profilesByUser(Auth::id())->pluck('name', 'id');

                return view('people.create', compact('communities','sexes', 'features', 'groups', 'profiles'));
            }            
        }else{
            Flash::error(trans('flash.error_no_community'));
            return redirect(route('people.index'));
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

        $person = $this->personRepository->create($input);
        $person->communities()->attach($request->communities);

        $sync_data = [];
        for($i = 0; $i < count($request->communities); $i++){
            $person->features()->attach($request->features, ['community_id' => $request->communities[$i]]);
        }

        if(isset(($request->groups))){
            for($i = 0; $i < count($request->groups); $i++){
            $group = Group::findOrFail($request->groups[$i]);
            $group->communities_people()->attach($request->communities, ['profile_id' => $request->profiles, 'person_id' => $person->id]);
            } 
        }
               

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.people', 1)]));

        return redirect(route('people.index'));
    }

    /**
     * Display the specified Person.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $people = $this->personRepository
            ->makeModel()
            ->qPeople(Auth::id(), $id);

        if ($people > 0){
            $person = $this->personRepository->find($id);
            $person->load('features');

            $communities = CommunityPeople::join('communities','community_people.community_id', '=', 'communities.id')
                ->where('community_people.person_id', $id)
                ->select('communities.*')
                ->distinct()
                ->get();

            $groups = CommunityPeople::join('groups','community_people.group_id', '=', 'groups.id')
                ->where('community_people.person_id', $id)
                ->select('groups.*')
                ->distinct()
                ->get();
            $profiles = CommunityPeople::join('profiles','community_people.profile_id', '=', 'profiles.id')
                ->where('community_people.person_id', $id)
                ->select('profiles.*')
                ->distinct()
                ->get();
        }else{
            abort(401);
        }
        
        if (empty($person)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.people', 1)]));

            return redirect(route('people.index'));
        }

        return view('people.show', compact('person','communities', 'groups', 'profiles'));
    }

    /**
     * Show the form for editing the specified Person.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $people = $this->personRepository
            ->makeModel()
            ->qPeople(Auth::id(), $id);

        if ($people > 0){
            $person = $this->personRepository->find($id);
            $person->load('features');
        }else{
            abort(401);
        }

        $communities_auth = Community::communities(Auth::id());
        $communities = $communities_auth->pluck('name','id');

        $sexes = GenList::where('group_id','1')->get(['id', 'item_description'])->pluck('item_description','id');
        $features = Feature::featuresByUser(Auth::id())->pluck('name', 'id');
        
        $groups = Group::groupsByUser(Auth::id())->pluck('name', 'id');

        $profiles = Profile::profilesByUser(Auth::id())->pluck('name', 'id');

        if (empty($person)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.people', 1)]));

            return redirect(route('people.index'));
        }

        return view('people.edit', compact('person', 'communities', 'sexes', 'features', 'groups', 'profiles'));
    }

    /**
     * Update the specified Person in storage.
     *
     * @param int $id
     * @param UpdatePersonRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePersonRequest $request)
    {
        $people = $this->personRepository
            ->makeModel()
            ->qPeople(Auth::id(), $id);

        if ($people > 0){
            $person = $this->personRepository->find($id);
            
            $sync_data = [];
            for($i = 0; $i < count($request->communities); $i++){
                $person->features()->attach($request->features, ['community_id' => $request->communities[$i]]);
            }

            if(isset(($request->groups))){
                for($i = 0; $i < count($request->groups); $i++){
                    $group = Group::findOrFail($request->groups[$i]);
                    $group->communities_people()->attach($request->communities, ['profile_id' => $request->profiles, 'person_id' => $person->id]);
                }
            }
        }else{
            abort(401);
        }

        if (empty($person)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.people', 1)]));

            return redirect(route('people.index'));
        }

        $person = $this->personRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.people', 1)]));

        return redirect(route('people.index'));
    }

    /**
     * Remove the specified Person from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $people = $this->personRepository
            ->makeModel()
            ->qPeople(Auth::id(), $id);

        if ($people > 0){
            $person = $this->personRepository->find($id);
            $person->load('features');
        }else{
            abort(401);
        }

        if (empty($person)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.people', 1)]));

            return redirect(route('people.index'));
        }

        $this->personRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.people', 1)]));

        return redirect(route('people.index'));
    }
}
