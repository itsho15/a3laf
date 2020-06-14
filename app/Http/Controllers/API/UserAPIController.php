<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\User;
use Hash;
use Illuminate\Http\Request;
use JWTAuth;
use Response;
use Validator;
use willvincent\Rateable\Rating;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */

class UserAPIController extends AppBaseController {
	/** @var  UserRepository */
	private $userRepository;

	public function __construct(UserRepository $userRepo) {
		$this->userRepository = $userRepo;
	}

	/**
	 * @param Request $request
	 * @return Response
	 *
	 * @SWG\Get(
	 *      path="/users",
	 *      summary="Get a listing of the Users.",
	 *      tags={"User"},
	 *      description="Get all Users",
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
	 *                  @SWG\Items(ref="#/definitions/User")
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
		$users = $this->userRepository->all(
			$request->except(['skip', 'limit']),
			$request->get('skip'),
			$request->get('limit')
		);

		return $this->sendResponse($users->tSWGrray(), 'Users retrieved successfully');
	}

	public function register(Request $request) {
		$validator = Validator::make(request()->all(), [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'phone' => 'required|string|unique:users',
			'city_id' => 'required|integer|exists:cities,id',
			'type' => 'required|in:user,provider',
		]);

		$data = [
			'email' => request('email'),
			'type' => request('type'),
			'device_id' => request('device_id'),
			'phone' => request('phone'),
			'name' => request('name'),
			'city_id' => request('city_id'),
			'lat' => request('lat'),
			'lng' => request('lng'),
			'password' => Hash::make(request('password')),
			'status' => (request('type') == 'user') ? 'active' : 'pending',
		];

		if (request()->hasFile('avatar')) {
			$data['avatar'] = up()->uplSWGd([
				'file' => 'avatar',
				'path' => 'avatars',
				'uplSWGd_type' => 'single',
				'delete_file' => '',
			]);
		}

		if ($validator->fails()) {
			return $this->sendError($validator->errors());
		}

		$auth = User::create($data);

		$userdata = User::find($auth->id);
		$token = JWTAuth::fromUser($auth);
		$user = new UserResource($userdata);

		$response = [
			'user' => $user,
			'token' => $token,
		];

		return $this->sendResponse($response, 'User registered  successfully');
	}

	public function authenticate(Request $request) {
		$login = request()->input('phone');

		$fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
		request()->merge([$fieldType => $login]);
		$credentials = $request->only($fieldType, 'password');
		try {
			if (!$token = JWTAuth::attempt($credentials)) {
				return $this->sendError('invalid_credentials');
			}
		} catch (JWTException $e) {
			return $this->sendError('could_not_create_token');
		}

		$auth = JWTAuth::user();

		$user = new UserResource($auth);
		$response = [
			'user' => $user,
			'token' => $token,
		];
		return $this->sendResponse($response, 'User loged in successfully');

	}

	/**
	 * @param int $id
	 * @return Response
	 *
	 * @SWG\Get(
	 *      path="/users/{id}",
	 *      summary="Display the specified User",
	 *      tags={"User"},
	 *      description="Get User",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of User",
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
	 *                  ref="#/definitions/User"
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
		/** @var User $user */
		$user = $this->userRepository->find($id);

		if (empty($user)) {
			return $this->sendError('User not found');
		}

		return $this->sendResponse($user->toArray(), 'User retrieved successfully');
	}

	/**
	 * @param int $id
	 * @param UpdateUserAPIRequest $request
	 * @return Response
	 *
	 * @SWG\Put(
	 *      path="/users/{id}",
	 *      summary="Update the specified User in storage",
	 *      tags={"User"},
	 *      description="Update User",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of User",
	 *          type="integer",
	 *          required=true,
	 *          in="path"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="body",
	 *          in="body",
	 *          description="User that should be updated",
	 *          required=false,
	 *          @SWG\Schema(ref="#/definitions/User")
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
	 *                  ref="#/definitions/User"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
	 */
	public function update(UpdateUserAPIRequest $request) {
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

		$input = collect(request()->all())->filter()->all();

		/** @var User $user */
		$user = $this->userRepository->find($user->id);

		if (empty($user)) {
			return $this->sendError('User not found');
		}

		$user = $this->userRepository->update($input, $user->id);

		return $this->sendResponse(new UserResource($user), 'User updated successfully');
	}

	/**
	 * @param int $id
	 * @return Response
	 *
	 * @SWG\Delete(
	 *      path="/users/{id}",
	 *      summary="Remove the specified User from storage",
	 *      tags={"User"},
	 *      description="Delete User",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of User",
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
		/** @var User $user */
		$user = $this->userRepository->find($id);

		if (empty($user)) {
			return $this->sendError('User not found');
		}

		$user->delete();

		return $this->sendSuccess('User deleted successfully');
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
			'user_id' => 'required|exists:users,id',
			'comment' => 'required|string',
		]);
		$RateToUser = User::find(request('user_id'));

		$rating = new Rating;
		$rating->rating = request('rate');
		$rating->comment = request('comment');
		$rating->user_id = $user->id;

		$RateToUser->ratings()->save($rating);

		$averageRating = $RateToUser->averageRating;

		$rated_user = $RateToUser;

		return $this->sendResponse(
			compact('averageRating', 'rated_user'),
			__('messages.updated', ['model' => __('models/users.singular')])
		);

	}

	public function getNotifications() {
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
		$notifications = $user->notifications()->paginate(20);
		$count = $user->unreadNotifications()->count();
		return $this->sendResponse(['unreadNotifications' => $count, 'notifications' => $notifications], 'User notifications retrieved  successfully');
	}

	public function MarkAsReadNotification() {
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

		$notification = $user->notifications()->where('id', request('id'))->first();

		if (empty($notification)) {
			return $this->sendError('notification not found or not specify to current user');
		} else {
			$notification->markAsRead();
			return $this->sendSuccess('marked as read successfully');
		}
	}
}
