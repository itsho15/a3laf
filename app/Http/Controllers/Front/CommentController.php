<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCommentRequest;
use App\Repositories\CommentRepository;
use Flash;
use Response;

class CommentController extends AppBaseController {
	/** @var  CommentRepository */
	private $commentRepository;

	public function __construct(CommentRepository $commentRepo) {
		$this->commentRepository = $commentRepo;
	}

	/**
	 * Store a newly created Comment in storage.
	 *
	 * @param CreateCommentRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateCommentRequest $request) {
		$input = $request->all();

		$comment = $this->commentRepository->create($input);
		session()->flash('success', __('messages.saved', ['model' => __('models/comments.singular')]));
		return redirect()->back();
	}
}
