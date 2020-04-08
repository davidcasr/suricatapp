<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\ProfileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Community;

class ProfileController extends AppBaseController
{
    /** @var  ProfileRepository */
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepo)
    {
        $this->profileRepository = $profileRepo;
    }

    /**
     * Display a listing of the Profile.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $profiles = $this->profileRepository
            ->makeModel()
            ->join('community_profiles','community_profiles.profile_id', '=','profiles.id')
            ->join('communities', 'community_profiles.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->orWhere('profiles.name', 'LIKE', '%$keyword%')
            ->select('profiles.*')
            ->distinct()
            ->paginate(config('global.per_page'));
        }else{
            $profiles = $this->profileRepository
            ->makeModel()
            ->join('community_profiles','community_profiles.profile_id', '=','profiles.id')
            ->join('communities', 'community_profiles.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->select('profiles.*')
            ->distinct()
            ->paginate(config('global.per_page'));   
        }

        return view('profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new Profile.
     *
     * @return Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created Profile in storage.
     *
     * @param CreateProfileRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileRequest $request)
    {
        $input = $request->all();

        $community = Community::communities(Auth::id());

        $profile = $this->profileRepository->create($input);
        $profile->communities()->attach($community);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.profiles', 1)]));

        return redirect(route('profiles.index'));
    }

    /**
     * Display the specified Profile.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {

        $profiles = $this->profileRepository
            ->makeModel()
            ->qProfile(Auth::id());

        if ($profiles > 0){
            $profile = $this->profileRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($profile)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.profiles', 1)]));

            return redirect(route('profiles.index'));
        }

        return view('profiles.show')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified Profile.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $profiles = $this->profileRepository
            ->makeModel()
            ->qProfile(Auth::id());

        if ($profiles > 0){
            $profile = $this->profileRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($profile)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.profiles', 1)]));

            return redirect(route('profiles.index'));
        }

        return view('profiles.edit')->with('profile', $profile);
    }

    /**
     * Update the specified Profile in storage.
     *
     * @param int $id
     * @param UpdateProfileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileRequest $request)
    {
        $profiles = $this->profileRepository
            ->makeModel()
            ->qProfile(Auth::id());

        if ($profiles > 0){
            $profile = $this->profileRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($profile)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.profiles', 1)]));

            return redirect(route('profiles.index'));
        }

        $profile = $this->profileRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.profiles', 1)]));

        return redirect(route('profiles.index'));
    }

    /**
     * Remove the specified Profile from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profiles = $this->profileRepository
            ->makeModel()
            ->qProfile(Auth::id());

        if ($profiles > 0){
            $profile = $this->profileRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($profile)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.profiles', 1)]));

            return redirect(route('profiles.index'));
        }

        $this->profileRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.profiles', 1)]));

        return redirect(route('profiles.index'));
    }
}
