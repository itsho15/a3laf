<?php

namespace App\Http\Controllers\Front;
use App\Events\CreateMessage;
use App\Http\Controllers\AppBaseController;
use App\Models\Conversation;
use App\Models\Message;
use App\Notifications\NewMessage;
use App\User;
use Illuminate\Http\Request;

class ChatsController extends AppBaseController {

	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show chats
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($id) {
		$conversation = Conversation::findOrfail($id);
		if ($conversation->from_id == auth()->id()) {
			$OtherU = \App\User::find($conversation->to_id);
		} else {
			$OtherU = \App\User::find($conversation->from_id);
		}
		return view('chat', compact('id', 'OtherU', 'conversation'));
	}

	public function Store(Request $request) {

		$input = $request->all();

		if ($request->from_id == $request->to_id) {
			session()->flash('error', __('front.can_not_chat_withUrself'));
			return redirect()->back();
		}
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
			$conversation = Conversation::create($input);
		}
		return redirect(url('conversation/' . $conversation->id));
	}

	/**
	 * Fetch all messages
	 *
	 * @return Message
	 */
	public function fetchMessages($id) {

		$conv = Conversation::where('id', $id)->with(['messages' => function ($message) {
			return $message->with('user');
		}])->first();

		return $conv;
	}

	/**
	 * Persist message to database
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function sendMessage(Request $request) {

		$input = request()->all();
		$input['user_id'] = auth()->id();
		$input['type'] = 'text';

		$model = Message::create($input);

		$to_user = [$model->conversation->from_id, $model->conversation->to_id];

		if (($key = array_search($model->user_id, $to_user)) !== false) {
			unset($to_user[$key]);
		}

		$tous = [];

		for ($i = 0; $i <= count($to_user); $i++) {
			if (isset($to_user[$i])) {
				$tous[] = $to_user[$i];
			}
		}

		$userTo = User::find($tous[0]);

		$oldnotificationsMessage = $userTo->notifications()->where('type', 'App\Notifications\NewMessage')->where('data->conversation_id', $input['conversation_id'])->pluck('id');

		$deleteOld = $userTo->notifications()->whereIn('id', $oldnotificationsMessage)->delete();
		$userTo->notify(new NewMessage($model));
		$data = [
			'message_id' => $model->id,
			'user_name' => $model->user->name,
			'conversation_id' => $model->conversation->id,
			'count' => $userTo->unreadNotifications()->count(),
		];
		pushNotifications([$userTo->device_id], 'new message from ' . $model->user->name, $model->content, url('conversation/' . $model->conversation->id), $data, 'web', url('dist/svg/logo.svg'));

		broadcast(new CreateMessage($model))->toOthers();

		return ['status' => 'Message Sent!'];
	}
}
