<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Repositories\FeatureRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Community;

class FeatureController extends AppBaseController
{
    /** @var  FeatureRepository */
    private $featureRepository;

    public function __construct(FeatureRepository $featureRepo)
    {
        $this->featureRepository = $featureRepo;
    }

    /**
     * Display a listing of the Feature.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $features = $this->featureRepository
            ->makeModel()
            ->join('feature_people','feature_people.feature_id', '=','features.id')
            ->join('communities', 'feature_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->where('community_users.user_id', Auth::user()->id)
            ->select('features.*')
            ->paginate(config('global.per_page'));

        return view('features.index', compact('features'));
    }

    /**
     * Show the form for creating a new Feature.
     *
     * @return Response
     */
    public function create()
    {
        return view('features.create');
    }

    /**
     * Store a newly created Feature in storage.
     *
     * @param CreateFeatureRequest $request
     *
     * @return Response
     */
    public function store(CreateFeatureRequest $request)
    {
        $input = $request->all();

        $community = Community::communities(Auth::id());

        $feature = $this->featureRepository->create($input);
        $feature->communities()->attach($community);

        Flash::success(trans('flash.store', ['model' => trans_choice('functionalities.features', 1)]));

        return redirect(route('features.index'));
    }

    /**
     * Display the specified Feature.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $features = $this->featureRepository
            ->makeModel()
            ->qFeature(Auth::id());

        if ($features > 0){
            $feature = $this->featureRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($feature)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.features', 1)]));

            return redirect(route('features.index'));
        }

        return view('features.show')->with('feature', $feature);
    }

    /**
     * Show the form for editing the specified Feature.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $features = $this->featureRepository
            ->makeModel()
            ->qFeature(Auth::id());

        if ($features > 0){
            $feature = $this->featureRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($feature)) {
             Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.features', 1)]));

            return redirect(route('features.index'));
        }

        return view('features.edit')->with('feature', $feature);
    }

    /**
     * Update the specified Feature in storage.
     *
     * @param int $id
     * @param UpdateFeatureRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeatureRequest $request)
    {
        $features = $this->featureRepository
            ->makeModel()
            ->qFeature(Auth::id());

        if ($features > 0){
            $feature = $this->featureRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($feature)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.features', 1)]));

            return redirect(route('features.index'));
        }

        $feature = $this->featureRepository->update($request->all(), $id);

        Flash::success(trans('flash.update', ['model' => trans_choice('functionalities.features', 1)]));

        return redirect(route('features.index'));
    }

    /**
     * Remove the specified Feature from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $features = $this->featureRepository
            ->makeModel()
            ->qFeature(Auth::id());

        if ($features > 0){
            $feature = $this->featureRepository->find($id);
        }else{
            abort(401);
        }

        if (empty($feature)) {
            Flash::error(trans('flash.error', ['model' => trans_choice('functionalities.features', 1)]));

            return redirect(route('features.index'));
        }

        $this->featureRepository->delete($id);

        Flash::success(trans('flash.destroy', ['model' => trans_choice('functionalities.features', 1)]));

        return redirect(route('features.index'));
    }
}
