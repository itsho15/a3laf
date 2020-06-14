<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateAdAPIRequest;
use App\Http\Requests\API\UpdateAdAPIRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use App\Repositories\AdRepository;
use Illuminate\Http\Request;
use JWTAuth;
use Response;

/**
 * Class AdController
 * @package App\Http\Controllers\API
 */

class AdAPIController extends AppBaseController {
	/** @var  AdRepository */
	private $adRepository;

	public function __construct(AdRepository $adRepo) {
		$this->adRepository = $adRepo;
		$this->middleware('jwt.verify')->except(['index', 'show']);
	}

	/**
	 * @param Request $request
	 * @return Response
	 *
	 * @SWG\Get(
	 *      path="/ads",
	 *      summary="Get a listing of the Ads.",
	 *      tags={"Ad"},
	 *      description="Get all Ads",
	 *      produces={"application/json"},
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  type="array",
	 *                  @SWG\Items(ref="#/definitions/Ad")
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
	 */
	public function index(Request $request) {
		$ads = $this->adRepository->all(
			$request->except(['skip', 'limit']),
			$request->get('skip'),
			$request->get('limit')
		);

		return $this->sendResponse(
			new AdResource($ads),
			__('messages.retrieved', ['model' => __('models/ads.plural')])
		);
	}

	/**
	 * @param CreateAdAPIRequest $request
	 * @return Response
	 *
	 * @SWG\Post(
	 *      path="/ads",
	 *      summary="Store a newly created Ad in storage",
	 *      tags={"Ad"},
	 *      description="Store Ad",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="body",
	 *          in="body",
	 *          description="Ad that should be stored",
	 *          required=false,
	 *          @SWG\Schema(ref="#/definitions/Ad")
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  ref="#/definitions/Ad"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
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
	 *
	 * @SWG\Get(
	 *      path="/ads/{id}",
	 *      summary="Display the specified Ad",
	 *      tags={"Ad"},
	 *      description="Get Ad",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of Ad",
	 *          type="integer",
	 *          required=true,
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  ref="#/definitions/Ad"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
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
			new AdResource($ad),
			__('messages.retrieved', ['model' => __('models/ads.singular')])
		);
	}

	/**
	 * @param int $id
	 * @param UpdateAdAPIRequest $request
	 * @return Response
	 *
	 * @SWG\Put(
	 *      path="/ads/{id}",
	 *      summary="Update the specified Ad in storage",
	 *      tags={"Ad"},
	 *      description="Update Ad",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of Ad",
	 *          type="integer",
	 *          required=true,
	 *          in="path"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="body",
	 *          in="body",
	 *          description="Ad that should be updated",
	 *          required=false,
	 *          @SWG\Schema(ref="#/definitions/Ad")
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  ref="#/definitions/Ad"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
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

	/**
	 * @param int $id
	 * @return Response
	 *
	 * @SWG\Delete(
	 *      path="/ads/{id}",
	 *      summary="Remove the specified Ad from storage",
	 *      tags={"Ad"},
	 *      description="Delete Ad",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of Ad",
	 *          type="integer",
	 *          required=true,
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  type="string"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
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
}
