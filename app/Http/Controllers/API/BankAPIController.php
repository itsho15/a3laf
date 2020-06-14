<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\BankResource;
use App\Models\Bank;
use App\Repositories\BankRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class BankController
 * @package App\Http\Controllers\API
 */

class BankAPIController extends AppBaseController {
	/** @var  BankRepository */
	private $bankRepository;

	public function __construct(BankRepository $bankRepo) {
		$this->bankRepository = $bankRepo;
	}

	/**
	 * Display a listing of the Bank.
	 * GET|HEAD /banks
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function index(Request $request) {
		$banks = $this->bankRepository->all(
			$request->except(['skip', 'limit']),
			$request->get('skip'),
			$request->get('limit')
		);

		return $this->sendResponse(
			BankResource::collection($banks),
			__('messages.retrieved', ['model' => __('models/banks.plural')])
		);
	}
}
