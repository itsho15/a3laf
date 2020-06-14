<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateFavoriteAPIRequest;
use App\Http\Requests\API\UpdateFavoriteAPIRequest;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use App\Repositories\FavoriteRepository;
use Illuminate\Http\Request;
use JWTAuth;
use Response;

/**
 * Class FavoriteController
 * @package App\Http\Controllers\API
 */

class FavoriteAPIController extends AppBaseController {
	/** @var  FavoriteRepository */
	private $favoriteRepository;

	public function __construct(FavoriteRepository $favoriteRepo) {
		$this->favoriteRepository = $favoriteRepo;
	}

	/**
	 * @param Request $request
	 * @return Response
	 *
	 */
	public function index(Request $request) {
		try {
			if (!$user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return $this->sendError(['token_expired', $e->getStatusCode()]);

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
			return $this->sendError(['token_invalid', $e->getStatusCode()]);

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
			return $this->sendError(['token_absent', $e->getStatusCode()]);
		}

		$favorites = $user->favorite;

		return $this->sendResponse(
			FavoriteResource::collection($favorites),
			__('messages.retrieved', ['model' => __('models/favorites.plural')])
		);
	}

	/**
	 * @param CreateFavoriteAPIRequest $request
	 * @return Response
	 *
	 * @SWG\Post(
	 *      path="/favorites",
	 *      summary="Store a newly created Favorite in storage",
	 *      tags={"Favorite"},
	 *      description="Store Favorite",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="body",
	 *          in="body",
	 *          description="Favorite that should be stored",
	 *          required=false,
	 *          @SWG\Schema(ref="#/definitions/Favorite")
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
	 *                  ref="#/definitions/Favorite"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
	 */
	public function store(CreateFavoriteAPIRequest $request) {
		$input = $request->all();

		$favorite = $this->favoriteRepository->create($input);

		return $this->sendResponse(
			$favorite->toArray(),
			__('messages.saved', ['model' => __('models/favorites.singular')])
		);
	}

	/**
	 * @param int $id
	 * @return Response
	 *
	 * @SWG\Get(
	 *      path="/favorites/{id}",
	 *      summary="Display the specified Favorite",
	 *      tags={"Favorite"},
	 *      description="Get Favorite",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of Favorite",
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
	 *                  ref="#/definitions/Favorite"
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
		/** @var Favorite $favorite */
		$favorite = $this->favoriteRepository->find($id);

		if (empty($favorite)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/favorites.singular')])
			);
		}

		return $this->sendResponse(
			$favorite->toArray(),
			__('messages.retrieved', ['model' => __('models/favorites.singular')])
		);
	}

	/**
	 * @param int $id
	 * @param UpdateFavoriteAPIRequest $request
	 * @return Response
	 *
	 * @SWG\Put(
	 *      path="/favorites/{id}",
	 *      summary="Update the specified Favorite in storage",
	 *      tags={"Favorite"},
	 *      description="Update Favorite",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of Favorite",
	 *          type="integer",
	 *          required=true,
	 *          in="path"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="body",
	 *          in="body",
	 *          description="Favorite that should be updated",
	 *          required=false,
	 *          @SWG\Schema(ref="#/definitions/Favorite")
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
	 *                  ref="#/definitions/Favorite"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
	 */
	public function update($id, UpdateFavoriteAPIRequest $request) {
		$input = $request->all();

		/** @var Favorite $favorite */
		$favorite = $this->favoriteRepository->find($id);

		if (empty($favorite)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/favorites.singular')])
			);
		}

		$favorite = $this->favoriteRepository->update($input, $id);

		return $this->sendResponse(
			$favorite->toArray(),
			__('messages.updated', ['model' => __('models/favorites.singular')])
		);
	}

	/**
	 * @param int $id
	 * @return Response
	 *
	 * @SWG\Delete(
	 *      path="/favorites/{id}",
	 *      summary="Remove the specified Favorite from storage",
	 *      tags={"Favorite"},
	 *      description="Delete Favorite",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of Favorite",
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
		/** @var Favorite $favorite */
		$favorite = $this->favoriteRepository->find($id);

		if (empty($favorite)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/favorites.singular')])
			);
		}

		$favorite->delete();

		return $this->sendResponse(
			$id,
			__('messages.deleted', ['model' => __('models/favorites.singular')])
		);
	}
}
