<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateTypeAPIRequest;
use App\Http\Requests\API\UpdateTypeAPIRequest;
use App\Models\Type;
use App\Repositories\TypeRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class TypeController
 * @package App\Http\Controllers\API
 */

class TypeAPIController extends AppBaseController {
	/** @var  TypeRepository */
	private $typeRepository;

	public function __construct(TypeRepository $typeRepo) {
		$this->typeRepository = $typeRepo;
	}

	public function index(Request $request) {
		$types = $this->typeRepository->all(
			$request->except(['skip', 'limit']),
			$request->get('skip'),
			$request->get('limit')
		);

		return $this->sendResponse(
			$types->toArray(),
			__('messages.retrieved', ['model' => __('models/types.plural')])
		);
	}

	public function store(CreateTypeAPIRequest $request) {
		$input = $request->all();

		$type = $this->typeRepository->create($input);

		return $this->sendResponse(
			$type->toArray(),
			__('messages.saved', ['model' => __('models/types.singular')])
		);
	}

	public function show($id) {
		/** @var Type $type */
		$type = $this->typeRepository->find($id);

		if (empty($type)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/types.singular')])
			);
		}

		return $this->sendResponse(
			$type->toArray(),
			__('messages.retrieved', ['model' => __('models/types.singular')])
		);
	}

	/**
	 * @param int $id
	 * @param UpdateTypeAPIRequest $request
	 * @return Response
	 *
	 */
	public function update($id, UpdateTypeAPIRequest $request) {
		$input = $request->all();

		/** @var Type $type */
		$type = $this->typeRepository->find($id);

		if (empty($type)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/types.singular')])
			);
		}

		$type = $this->typeRepository->update($input, $id);

		return $this->sendResponse(
			$type->toArray(),
			__('messages.updated', ['model' => __('models/types.singular')])
		);
	}

	/**
	 * @param int $id
	 * @return Response
	 *
	 */
	public function destroy($id) {
		/** @var Type $type */
		$type = $this->typeRepository->find($id);

		if (empty($type)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/types.singular')])
			);
		}

		$type->delete();

		return $this->sendResponse(
			$id,
			__('messages.deleted', ['model' => __('models/types.singular')])
		);
	}
}
