<?php

namespace App\Repositories;

use App\Events\CreateMessage;
use App\Models\Message;
use App\Notifications\NewMessage;
use App\Repositories\BaseRepository;
use App\User;
use JWTAuth;

/**
 * Class MessageRepository
 * @package App\Repositories
 * @version March 17, 2020, 8:28 pm UTC
 */

class MessageRepository extends BaseRepository {
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'id',
		'content',
		'conversation_id',
		'user_id',
		'type',
	];

	/**
	 * Return searchable fields
	 *
	 * @return array
	 */
	public function getFieldsSearchable() {
		return $this->fieldSearchable;
	}

	/**
	 * Configure the Model
	 **/
	public function model() {
		return Message::class;
	}

	/**
	 * Create model record
	 *
	 * @param array $input
	 *
	 * @return Model
	 */
	public function create($input) {

		$input['user_id'] = JWTAuth::user()->id;
		if ($input['type'] == 'image') {
			$input['content'] = up()->upload([
				'file' => 'content',
				'path' => 'images_message',
				'upload_type' => 'single',
				'delete_file' => '',
			]);
		}
		if ($input['type'] == 'voice') {
			$input['content'] = up()->upload([
				'file' => 'content',
				'path' => 'voices_message',
				'upload_type' => 'single',
				'delete_file' => '',
			]);
		}
		$model = $this->model->newInstance($input);
		$model->save();

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
		$userTo->notify(new NewMessage($model));

		pushNotifications($userTo->device_id, 'Message', 'new message from ' . $model->user_name, 'newMessage', $model);

		broadcast(new CreateMessage($model))->toOthers();
		return $model;
	}
}
