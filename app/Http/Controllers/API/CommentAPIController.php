<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateCommentAPIRequest;
use App\Http\Requests\API\UpdateCommentAPIRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class CommentController
 * @package App\Http\Controllers\API
 */

class CommentAPIController extends AppBaseController {
	/** @var  CommentRepository */
	private $commentRepository;

	public function __construct(CommentRepository $commentRepo) {
		$this->commentRepository = $commentRepo;
		$this->middleware('jwt.verify')->except(['index', 'show']);
	}

	/**
	 * @param Request $request
	 * @return Response
	 *
	 */
	public function index(Request $request) {
	    
		$comments = Comment::where('ad_id',request('ad_id'))->paginate(20);

		return $this->sendResponse(
			$comments,
			__('messages.retrieved', ['model' => __('models/comments.plural')])
		);
	}

	/**
	 * @param CreateCommentAPIRequest $request
	 * @return Response
	 *

	 */
	public function store(CreateCommentAPIRequest $request) {
	    
		$input = $request->all();

		$comment = $this->commentRepository->create($input);

		return $this->sendResponse(
			new CommentResource($comment),
			__('messages.saved', ['model' => __('models/comments.singular')])
		);
	}

	/**
	 * @param int $id
	 * @return Response
	 *
	 */
	public function show($id) {
		/** @var Comment $comment */
		$comment = $this->commentRepository->find($id);

		if (empty($comment)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/comments.singular')])
			);
		}

		return $this->sendResponse(
			new CommentResource($comment),
			__('messages.retrieved', ['model' => __('models/comments.singular')])
		);
	}

	/**
	 * @param int $id
	 * @param UpdateCommentAPIRequest $request
	 * @return Response
	 *
	 */
	public function update($id, UpdateCommentAPIRequest $request) {
		$input = $request->all();

		/** @var Comment $comment */
		$comment = $this->commentRepository->find($id);

		if (empty($comment)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/comments.singular')])
			);
		}

		$comment = $this->commentRepository->update($input, $id);

		return $this->sendResponse(
			new CommentResource($comment),
			__('messages.updated', ['model' => __('models/comments.singular')])
		);
	}

	/**
	 * @param int $id
	 * @return Response
	 *
	 */
	public function destroy($id) {
		/** @var Comment $comment */
		$comment = $this->commentRepository->find($id);

		if (empty($comment)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/comments.singular')])
			);
		}

		$comment->delete();

		return $this->sendResponse(
			$id,
			__('messages.deleted', ['model' => __('models/comments.singular')])
		);
	}
}
