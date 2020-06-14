<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateMessageAPIRequest;
use App\Models\Message;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class MessageController
 * @package App\Http\Controllers\API
 */

class MessageAPIController extends AppBaseController {
	/** @var  MessageRepository */
	private $messageRepository;

	public function __construct(MessageRepository $messageRepo) {
		$this->messageRepository = $messageRepo;
	}
	/**
	 * Store a newly created Message in storage.
	 * POST /messages
	 *
	 * @param CreateMessageAPIRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateMessageAPIRequest $request) {
		$input = $request->all();

		$message = $this->messageRepository->create($input);

		return $this->sendResponse($message->toArray(), 'Message saved successfully');
	}

	/**
	 * Remove the specified Message from storage.
	 * DELETE /messages/{id}
	 *
	 * @param int $id
	 *
	 * @throws \Exception
	 *
	 * @return Response
	 */
	public function destroy($id) {
		/** @var Message $message */
		$message = $this->messageRepository->find($id);

		if (empty($message)) {
			return $this->sendError('Message not found');
		}

		$message->delete();

		return $this->sendSuccess('Message deleted successfully');
	}
}
