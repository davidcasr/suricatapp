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
use App\Models\GenList;
use App\Models\Community;

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
        $people = $this->personRepository
            ->makeModel()
            ->join('community_people','community_people.person_id', '=','people.id')
            ->join('communities', 'community_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->select('people.*')
            ->paginate(config('global.per_page'));

        return view('people.index', compact('people'));
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
            $communities = $communities_auth->pluck('name','id');

            $sexes = GenList::where('group_id','1')->get(['id', 'item_description'])->pluck('item_description','id');

            return view('people.create', compact('communities','sexes'));
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
        }else{
            abort(401);
        }
        
        if (empty($person)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.people', 1)]));

            return redirect(route('people.index'));
        }

        return view('people.show')->with('person', $person);
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

        if (empty($person)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.people', 1)]));

            return redirect(route('people.index'));
        }

        return view('people.edit', compact('person', 'communities', 'sexes'));
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
