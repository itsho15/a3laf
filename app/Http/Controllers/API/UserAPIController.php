<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Http\Resources\UserResource;
use App\Models\Token;
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
	 */
	/**
	 * @param Request $request
	 * @return Response
	 *
	 */
	public function forgot_password(Request $request) {
		$validator = Validator::make(request()->all(), ['phone' => "required"]);
		if ($validator->fails()) {
			return $this->sendError($validator->errors()->first());
		}
		/*
			 Check The phone number if exists
		*/
		$user = $this->userRepository->allQuery()->where('phone', request('phone'))->first();

		if (!$user) {
			return $this->sendError('phone Not Exists In system');
		}

		$token = Token::create([
			'user_id' => $user->id,
		]);

		if ($token->sendCode($user)) {
			return $this->sendResponse(['code' => $token->sendCode($user)], 'Code Generated Successfully and it will be expired in 15 min , you can use this code to send it now by firebase sms');
		}

		$token->delete(); // delete token because it can't be sent
		return $this->sendError('Unable to send verification code');

	}

	public function change_password() {
		$validator = Validator::make(request()->all(), [
			'code' => 'required',
			'phone' => 'required',
		]);

		if ($validator->fails()) {
			return $this->sendError($validator->errors()->first());
		}
		/*
			 Check The phone number if exists
		*/
		$user = $this->userRepository->allQuery()->where('phone', request('phone'))->first();

		if (!$user) {
			return $this->sendError('phone Not Exists In system');
		}

		$checkToken = Token::where('code', request('code'))->where('user_id', $user->id)->first();

		if (!$checkToken) {
			return $this->sendError('Code Not Valid With This number');
		}

		/**
		 * check if code isValid and Not Expired And Not Used Before
		 *
		 * isValid Method In Model Token
		 */

		if ($checkToken->isValid()) {
			/*
					 Set The New Password
				*/
			$user_updated = User::whereId($user->id)->update(['password' => bcrypt(request('new_password'))]);
			/**
			 * now we will change token to Used
			 */

			$checkToken->used = 1;
			$checkToken->save();
			$user = new UserResource(User::find($user->id));
			return $this->sendResponse($user, 'Password Changed Successfully');
		} else {
			return $this->sendError('your Code Is Used Before Or Expired please');
		}
	}
	/*
		 set new password and check if old password is correct
	*/
	public function NewPassword(Request $request) {
		try {
			if (!$auth = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}
		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
			return $this->sendError(['token_expired', $e->getStatusCode()]);
		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
			return $this->sendError(['token_invalid', $e->getStatusCode()]);
		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
			return $this->sendError(['token_absent', $e->getStatusCode()]);
		}

		$validator = Validator::make(request()->all(), [
			'old_password' => 'required|string',
			'new_password' => 'required|string',
		]);

		if ($validator->fails()) {
			return $this->sendError($validator->errors());
		}

		if (!\Hash::check(request('old_password'), $auth->password)) {
			return $this->sendError('old password incorrect');
		} else {
			$ChangePassword = User::whereId($auth->id)->update(['password' => bcrypt(request('new_password'))]);
			$user = $this->userRepository->find($auth->id);
			return $this->sendResponse(new UserResource($user), 'New Password Set successfully');
		}
	}

	public function register(Request $request) {
		$validator = Validator::make(request()->all(), [
			'name' => 'required|string|max:255',
			'email' => 'string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
			'phone' => 'required|string|unique:users',
			'type_id' => 'sometimes|nullable|integer|exists:types,id',
			'city_id' => 'required|integer|exists:cities,id',
		]);

		$data = [
			'email' => request('email'),
			'device_id' => request('device_id'),
			'phone' => request('phone'),
			'name' => request('name'),
			'city_id' => request('city_id'),
			'type_id' => request('type_id'),
			'lat' => request('lat'),
			'lng' => request('lng'),
			'password' => Hash::make(request('password')),
		];

		if (request()->hasFile('avatar')) {
			$data['avatar'] = up()->upload([
				'file' => 'avatar',
				'path' => 'avatars',
				'upload_type' => 'single',
				'delete_file' => '',
			]);
		}

		if ($validator->fails()) {
			return $this->sendError($validator->errors());
		}

		$auth = User::create($data);
		$role = \App\Models\Role::where('name', request('role'))->first();
		if ($role) {
			$auth->assignRole($role->name);
		}

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

		$this->validate(request(), [
			'phone' => 'required',
			'password' => 'required',
		]);
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

		$ad = User::find(request('user_id'));
		$checkRate = Rating::where('rateable_id', request('user_id'))->where('user_id', $user->id)->first();

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
}
