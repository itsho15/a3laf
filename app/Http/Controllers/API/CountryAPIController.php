<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateCountryAPIRequest;
use App\Http\Requests\API\UpdateCountryAPIRequest;
use App\Models\Country;
use App\Repositories\CountryRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class CountryController
 * @package App\Http\Controllers\API
 */

class CountryAPIController extends AppBaseController {
	/** @var  CountryRepository */
	private $countryRepository;

	public function __construct(CountryRepository $countryRepo) {
		$this->countryRepository = $countryRepo;
	}

	/**
	 * Display a listing of the Country.
	 * GET|HEAD /countries
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function index(Request $request) {
		$countries = $this->countryRepository->all(
			$request->except(['skip', 'limit']),
			$request->get('skip'),
			$request->get('limit')
		);

		return $this->sendResponse(
			$countries->toArray(),
			__('messages.retrieved', ['model' => __('models/countries.plural')])
		);
	}

	/**
	 * Store a newly created Country in storage.
	 * POST /countries
	 *
	 * @param CreateCountryAPIRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateCountryAPIRequest $request) {
		$input = $request->all();

		$country = $this->countryRepository->create($input);

		return $this->sendResponse(
			$country->toArray(),
			__('messages.saved', ['model' => __('models/countries.singular')])
		);
	}

	/**
	 * Display the specified Country.
	 * GET|HEAD /countries/{id}
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function show($id) {
		/** @var Country $country */
		$country = Country::with('cities')->find($id);

		if (empty($country)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/countries.singular')])
			);
		}

		return $this->sendResponse(
			$country->toArray(),
			__('messages.retrieved', ['model' => __('models/countries.singular')])
		);
	}

	/**
	 * Update the specified Country in storage.
	 * PUT/PATCH /countries/{id}
	 *
	 * @param int $id
	 * @param UpdateCountryAPIRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateCountryAPIRequest $request) {
		$input = $request->all();

		/** @var Country $country */
		$country = $this->countryRepository->find($id);

		if (empty($country)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/countries.singular')])
			);
		}

		$country = $this->countryRepository->update($input, $id);

		return $this->sendResponse(
			$country->toArray(),
			__('messages.updated', ['model' => __('models/countries.singular')])
		);
	}

	/**
	 * Remove the specified Country from storage.
	 * DELETE /countries/{id}
	 *
	 * @param int $id
	 *
	 * @throws \Exception
	 *
	 * @return Response
	 */
	public function destroy($id) {
		/** @var Country $country */
		$country = $this->countryRepository->find($id);

		if (empty($country)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/countries.singular')])
			);
		}

		$country->delete();

		return $this->sendResponse(
			$id,
			__('messages.deleted', ['model' => __('models/countries.singular')])
		);
	}
}
