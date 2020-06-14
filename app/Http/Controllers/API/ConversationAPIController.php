<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateConversationAPIRequest;
use App\Http\Requests\API\UpdateConversationAPIRequest;
use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use App\Repositories\ConversationRepository;
use Illuminate\Http\Request;
use JWTAuth;
use Response;

/**
 * Class ConversationController
 * @package App\Http\Controllers\API
 */

class ConversationAPIController extends AppBaseController {
	/** @var  ConversationRepository */
	private $conversationRepository;

	public function __construct(ConversationRepository $conversationRepo) {
		$this->conversationRepository = $conversationRepo;
	}

	/**
	 * Display a listing of the Conversation.
	 * GET|HEAD /conversations
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function index(Request $request) {
		$conversations = $this->conversationRepository->all(
			$request->except(['skip', 'limit']),
			$request->get('skip'),
			$request->get('limit')
		);

		return $this->sendResponse(
			$conversations->toArray(),
			__('messages.retrieved', ['model' => __('models/conversations.plural')])
		);
	}

	/**
	 * Store a newly created Conversation in storage.
	 * POST /conversations
	 *
	 * @param CreateConversationAPIRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateConversationAPIRequest $request) {
		$input = $request->all();
		$conversationcheckfrom = Conversation::where('from_id', $request->from_id)
			->where('to_id', $request->to_id)
			->first();

		$conversationcheckto = Conversation::where('from_id', $request->to_id)
			->where('to_id', $request->from_id)
			->first();

		if ($conversationcheckfrom || $conversationcheckto) {
			if ($conversationcheckto) {
				$conversation = $conversationcheckto;
			}
			if ($conversationcheckfrom) {
				$conversation = $conversationcheckfrom;
			}
		} else {
			$conversation = $this->conversationRepository->create($input);
		}

		$Conversationresponse = new ConversationResource(Conversation::find($conversation->id));
		return $this->sendResponse(
			$Conversationresponse,
			__('messages.saved', ['model' => __('models/conversations.singular')])
		);
	}

	/**
	 * Display the specified Conversation.
	 * GET|HEAD /conversations/{id}
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function show($id) {
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
		/** @var Conversation $conversation */
		$conversation = Conversation::whereId($id)->with('messages')->first();

		if ($conversation->from_id != $user->id && $conversation->to_id != $user->id) {
			return $this->sendError('You Can not see this Conversation');
		}
		if (empty($conversation)) {
			return $this->sendError('Conversation not found');
		}

		$Conversationresponse = new ConversationResource(Conversation::find($conversation->id));

		return $this->sendResponse($Conversationresponse, 'Conversation retrieved successfully');
	}

	/**
	 * Update the specified Conversation in storage.
	 * PUT/PATCH /conversations/{id}
	 *
	 * @param int $id
	 * @param UpdateConversationAPIRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateConversationAPIRequest $request) {
		$input = $request->all();

		/** @var Conversation $conversation */
		$conversation = $this->conversationRepository->find($id);

		if (empty($conversation)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/conversations.singular')])
			);
		}

		$conversation = $this->conversationRepository->update($input, $id);

		return $this->sendResponse(
			$conversation->toArray(),
			__('messages.updated', ['model' => __('models/conversations.singular')])
		);
	}

	/**
	 * Remove the specified Conversation from storage.
	 * DELETE /conversations/{id}
	 *
	 * @param int $id
	 *
	 * @throws \Exception
	 *
	 * @return Response
	 */
	public function destroy($id) {
		/** @var Conversation $conversation */
		$conversation = $this->conversationRepository->find($id);

		if (empty($conversation)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/conversations.singular')])
			);
		}

		$conversation->delete();

		return $this->sendResponse(
			$id,
			__('messages.deleted', ['model' => __('models/conversations.singular')])
		);
	}
}
