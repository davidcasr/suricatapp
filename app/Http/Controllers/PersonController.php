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

        $user = User::findOrfail(Auth::id());        
            
        if(is_null($user->parent_id))
        {
            $q_people_plan = User::infoPlan(Auth::id())->first();
        }else{
            $q_people_plan = User::infoPlan($user->parent_id)->first();
        }

        if($q_people_register >= $q_people_plan->q_users){
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

                return view('people.create', compact('communities','sexes', 'features', 'groups', 'profiles', 'countries'));
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

        $person = $this->personRepository->create($input);
        $person->communities()->attach($request->communities);

        for($i = 0; $i < count($request->communities); $i++){
            $person->features()->attach($request->features, 
                [
                    'community_id' => $request->communities[$i]
                ]); 
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

            $community_people = CommunityPeople::where('community_people.person_id', $id)
                ->whereNotNull('community_people.group_id')
                ->distinct()
                ->paginate(config('global.per_page'));
        }else{
            abort(401);
        }
        
        if (empty($person)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.people', 1)]));

            return redirect(route('people.index'));
        }

        return view('people.show', compact('person','communities', 'community_people'));
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
        }else{
            abort(401);
        }

        $communities_auth = Community::communities(Auth::id());
        $communities = $communities_auth->pluck('name','id');

        $sexes = GenList::where('group_id','1')->get(['id', 'item_description'])->pluck('item_description','id');
        $features = Feature::featuresByUser(Auth::id())->pluck('name', 'id');
        
        $groups = Group::groupsByUser(Auth::id())->pluck('name', 'id');

        $profiles = Profile::profilesByUser(Auth::id())->pluck('name', 'id');

        $countries = Country::all()->pluck('name', 'id');

        if (empty($person)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.people', 1)]));

            return redirect(route('people.index'));
        }

        return view('people.edit', compact('person', 'communities', 'sexes', 'features', 'groups', 'profiles', 'countries'));
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
            $person->communities()->sync($request->communities);
            
            foreach ($request->communities as $community){
                if(isset($request->features)){
                    foreach ($request->features as $key => $feature){
                        $features[$feature] = array('community_id' => $community);
                    }
                }else{
                    $features = null;
                }                
            }
            
            $person->features()->sync($features);

        }else{
            abort(401);
        }

        if (empty($person)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.people', 1)]));

            return redirect(route('people.index'));
        }

        $input = $request->all();
        $input['status'] = 1;

        $person = $this->personRepository->update($input, $id);

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
            $person->features()->detach();
            $person->groups()->detach();    
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
