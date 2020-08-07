<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use App\User;
use Response;

class UserController extends AppBaseController {
	/** @var  UserRepository */
	private $userRepository;
	protected $serverKey;

	public function __construct(UserRepository $userRepo) {
		$this->userRepository = $userRepo;
	}

	public function saveToken() {
		$user = User::find(request('user_id'));
		$user->device_id = request('fcm_token');
		$user->save();

		if ($user) {
			return response()->json([
				'message' => 'User token updated',
			]);
		}
		return response()->json([
			'message' => 'Error!',
		]);
	}

	public function MarkAsReadNotification() {
		$notification = auth()->user()->notifications()->where('id', request('id'))->first();
		$notification->markAsRead();
		return response()->json(['url' => url('conversation/' . request('conversation_id'))]);
	}

}
