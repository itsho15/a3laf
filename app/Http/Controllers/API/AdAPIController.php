<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateAdAPIRequest;
use App\Http\Requests\API\UpdateAdAPIRequest;
use App\Http\Resources\AdResource;
use App\Http\Resources\AdResourceSingle;
use App\Models\Ad;
use App\Repositories\AdRepository;
use App\Traits\Searching;
use Illuminate\Http\Request;
use JWTAuth;
use Response;
use willvincent\Rateable\Rating;

/**
 * Class AdController
 * @package App\Http\Controllers\API
 */

class AdAPIController extends AppBaseController {
	/** @var  AdRepository */
	use Searching;
	private $adRepository;

	public function __construct(AdRepository $adRepo) {
		$this->adRepository = $adRepo;
		$this->middleware('jwt.verify')->except(['index', 'show', 'RecentAds', 'OtherAds', 'Search', 'upload_file', 'deleteImage']);
	}

	/**
	 * @param Request $request
	 * @return Response
	 *
	 */
	public function index(Request $request) {
		if (request('ad_type')) {
			$ads = Ad::where('ad_type', request('ad_type'))->where('status', 'live')->Orwhere('status', 'sold')->paginate(10);
		} else {
			$ads = Ad::where('status', 'live')->Orwhere('status', 'sold')->paginate(10);
		}

		/*
			    add isFav , lastImage To response
		*/
		foreach ($ads as $ad) {
			$ad->isFav = $ad->isFav();
			$ad->averageRating = $ad->averageRating;
			$ad->ratings = $ad->ratings;
			$ad->lastImage = ($ad->images()) ? $ad->images()->first() : '';
		}
		return $this->sendResponse(
			$ads,
			__('messages.retrieved', ['model' => __('models/ads.plural')])
		);
	}

	/**
	 * @param Request $request
	 * @return Response
	 *
	 */
	public function RecentAds(Request $request) {
		$ads = Ad::where('status', 'live')->Orwhere('status', 'sold')->latest()->take('10')->get();
		return $this->sendResponse(
			AdResourceSingle::collection($ads),
			__('messages.retrieved', ['model' => __('models/ads.plural')])
		);
	}

	/**
	 * @param Request $request
	 * @return Response
	 *
	 */
	public function OtherAds(Request $request) {
		$RecentAds = Ad::where('status', 'live')->Orwhere('status', 'sold')->latest()->take('10')->pluck('id');
		$otherAds = Ad::where('status', 'live')->Orwhere('status', 'sold')->whereNotIn('id', $RecentAds)->take('10')->get();
		return $this->sendResponse(
			AdResource::collection($otherAds),
			__('messages.retrieved', ['model' => __('models/ads.plural')])
		);
	}

	/**
	 * @param Request $request
	 * @return Response
	 *
	 */
	public function myAds(Request $request) {
		try {
			if (!$user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return response()->json(['token_expired'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

			return response()->json(['token_invalid'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
			return response()->json(['token_absent'], $e->getStatusCode());
		}
		$ads = $user->ads()->paginate(10);
		/*
			    add isFav , lastImage To response
		*/
		foreach ($ads as $ad) {
			$ad->isFav = $ad->isFav();
			$ad->averageRating = $ad->averageRating;
			$ad->ratings = $ad->ratings;
			$ad->lastImage = ($ad->images()) ? $ad->images()->first() : '';
		}
		return $this->sendResponse(
			$ads,
			__('messages.retrieved', ['model' => __('models/ads.plural')])
		);
	}

	/**
	 * @param CreateAdAPIRequest $request
	 * @return Response
	 *

	 */
	public function store(CreateAdAPIRequest $request) {
		$input = $request->all();

		$ad = $this->adRepository->create($input);

		return $this->sendResponse(
			new AdResource($ad),
			__('messages.saved', ['model' => __('models/ads.singular')])
		);
	}

	/**
	 * @param int $id
	 * @return Response
	 */
	public function show($id) {
		/** @var Ad $ad */
		$ad = $this->adRepository->find($id);

		if (empty($ad)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/ads.singular')])
			);
		}

		return $this->sendResponse(
			new AdResourceSingle($ad),
			__('messages.retrieved', ['model' => __('models/ads.singular')])
		);
	}

	/**
	 * @param int $id
	 * @param UpdateAdAPIRequest $request
	 * @return Response
	 *
	 */
	public function update($id, UpdateAdAPIRequest $request) {
		try {
			if (!$user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return response()->json(['token_expired'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

			return response()->json(['token_invalid'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
			return response()->json(['token_absent'], $e->getStatusCode());
		}
		$input = collect(request()->all())->filter()->all();

		/** @var Ad $ad */
		$ad = $this->adRepository->find($id);

		if (empty($ad)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/ads.singular')])
			);
		}

		if ($user->id != $ad->user_id) {
			return $this->sendError('you can not edit this ad , you not the owner of it');
		}

		$ad = $this->adRepository->update($input, $id);

		return $this->sendResponse(
			new AdResource($ad),
			__('messages.updated', ['model' => __('models/ads.singular')])
		);
	}

	public function ChangeStatus($id) {
		try {
			if (!$user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return response()->json(['token_expired'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

			return response()->json(['token_invalid'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
			return response()->json(['token_absent'], $e->getStatusCode());
		}

		/** @var Ad $ad */
		$ad = $this->adRepository->find($id);

		if (empty($ad)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/ads.singular')])
			);
		}

		if ($user->id != $ad->user_id) {
			return $this->sendError('you can not change status , you not the owner of it');
		}

		$ad = $this->adRepository->update(['status' => request('status')], $id);

		return $this->sendResponse(
			new AdResource($ad),
			__('messages.updated', ['model' => __('models/ads.singular')])
		);
	}

	/*
		 	add Rate to user
	*/
	public function Rating() {

		try {
			if (!$user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return response()->json(['token_expired'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

			return response()->json(['token_invalid'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
			return response()->json(['token_absent'], $e->getStatusCode());
		}

		request()->validate([
			'rate' => 'required',
			'ad_id' => 'required|exists:ads,id',
			'comment' => 'required|string',
		]);

		$ad = Ad::find(request('ad_id'));
		$checkRate = Rating::where('rateable_id', request('ad_id'))->where('user_id', $user->id)->first();

		if ($checkRate) {
			return $this->sendError('you rate this ad before ');
		} else {
			$rating = new Rating;
			$rating->rating = request('rate');
			$rating->comment = request('comment');
			$rating->user_id = $user->id;

			$ad->ratings()->save($rating);

			$averageRating = $ad->averageRating;

			$rated_ad = $ad;

			return $this->sendResponse(
				compact('averageRating', 'rated_ad'),
				__('messages.updated', ['model' => __('models/users.singular')])
			);
		}

	}

	/**
	 * @param int $id
	 * @return Response
	 *
	 */
	public function destroy($id) {
		/** @var Ad $ad */
		try {
			if (!$user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return response()->json(['token_expired'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

			return response()->json(['token_invalid'], $e->getStatusCode());

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
			return response()->json(['token_absent'], $e->getStatusCode());
		}
		$ad = $this->adRepository->find($id);

		if (empty($ad)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/ads.singular')])
			);
		}
		if ($user->id != $ad->user_id) {
			return $this->sendError('you can not delete this ad , you not the owner of it');
		}
		$ad->delete();

		return $this->sendResponse(
			$id,
			__('messages.deleted', ['model' => __('models/ads.singular')])
		);
	}

	public function Search() {
		$searchResults = $this->AdvanceSearch(
			new Ad(),
			[
				'name' => 'like',
				'city_id' => '=',
				'category_id' => '=',
				'body' => 'like',
				'keyword' => 'keyword',
			], request());

		/*
			    add isFav , lastImage To response
		*/
		foreach ($searchResults as $ad) {
			$ad->isFav = $ad->isFav();
			$ad->averageRating = $ad->averageRating;
			$ad->ratings = $ad->ratings;
			$ad->lastImage = ($ad->images()->count() > 0) ? $ad->images()->first() : '';
		}

		return $this->sendResponse(
			$searchResults,
			__('messages.retrieved', ['model' => __('models/ads.singular')])
		);
	}

	public function upload_file($ad_id) {

		if (request()->hasFile('file')) {
			$Fid = up()->upload([
				'file' => 'file',
				'path' => 'ads',
				'upload_type' => 'multi',
				'delete_file' => '',
				'file_type' => 'ad',
				'relation_id' => $ad_id,
			]);
			return response(['status' => true, 'id' => $Fid], 200);
		}
	}

	public function deleteImage() {
		if (request()->has('id')) {
			up()->delete(request('id'));
		}
	}
}
