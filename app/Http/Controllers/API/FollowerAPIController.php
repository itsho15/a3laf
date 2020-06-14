<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateFollowerAPIRequest;
use App\Models\Follower;
use App\Repositories\FollowerRepository;
use Illuminate\Http\Request;
use JWTAuth;
use Response;

/**
 * Class FollowerController
 * @package App\Http\Controllers\API
 */

class FollowerAPIController extends AppBaseController {
	/** @var  FollowerRepository */
	private $followerRepository;

	public function __construct(FollowerRepository $followerRepo) {
		$this->followerRepository = $followerRepo;
	}

	/**
	 * @param Request $request
	 * @return Response
	 *
	 */
	public function index(Request $request) {
		$followers = $this->followerRepository->all(
			$request->except(['skip', 'limit']),
			$request->get('skip'),
			$request->get('limit')
		);

		return $this->sendResponse(
			$followers->toArray(),
			__('messages.retrieved', ['model' => __('models/followers.plural')])
		);
	}

	/**
	 * @param CreateFollowerAPIRequest $request
	 * @return Response
	 *
	 */
	public function store(CreateFollowerAPIRequest $request) {
		$input = $request->all();

		$follower = $this->followerRepository->create($input);
		if (JWTAuth::user()->id == $input['user_id']) {
			return $this->sendError(
				"you cann't follow your self"
			);
		}
		return $this->sendResponse(
			$follower->toArray(),
			__('messages.saved', ['model' => __('models/followers.singular')])
		);
	}

	/**
	 * @param int $id
	 * @return Response
	 *
	 */
	public function destroy($id) {
		/** @var Follower $follower */
		$follower = $this->followerRepository->find($id);

		if (empty($follower)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/followers.singular')])
			);
		}

		$follower->delete();
		return $this->sendResponse(
			$id,
			__('messages.deleted', ['model' => __('models/followers.singular')])
		);
	}
}
