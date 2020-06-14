<?php

namespace App\Http\Controllers;

use App\DataTables\CountryDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Repositories\CountryRepository;
use Flash;
use Response;

class CountryController extends AppBaseController {
	/** @var  CountryRepository */
	private $countryRepository;

	public function __construct(CountryRepository $countryRepo) {
		$this->countryRepository = $countryRepo;
	}

	/**
	 * Display a listing of the Country.
	 *
	 * @param CountryDataTable $countryDataTable
	 * @return Response
	 */
	public function index(CountryDataTable $countryDataTable) {
		return $countryDataTable->render('admin.countries.index');
	}

	/**
	 * Show the form for creating a new Country.
	 *
	 * @return Response
	 */
	public function create() {
		return view('admin.countries.create');
	}

	/**
	 * Store a newly created Country in storage.
	 *
	 * @param CreateCountryRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateCountryRequest $request) {
		$input = $request->all();

		$country = $this->countryRepository->create($input);

		Flash::success(__('messages.saved', ['model' => __('models/countries.singular')]));

		return redirect(route('admin.countries.index'));
	}

	/**
	 * Display the specified Country.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id) {
		$country = $this->countryRepository->find($id);

		if (empty($country)) {
			Flash::error(__('models/countries.singular') . ' ' . __('messages.not_found'));

			return redirect(route('admin.countries.index'));
		}

		return view('admin.countries.show')->with('country', $country);
	}

	/**
	 * Show the form for editing the specified Country.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id) {
		$country = $this->countryRepository->find($id);

		if (empty($country)) {
			Flash::error(__('messages.not_found', ['model' => __('models/countries.singular')]));

			return redirect(route('admin.countries.index'));
		}

		return view('admin.countries.edit')->with('country', $country);
	}

	/**
	 * Update the specified Country in storage.
	 *
	 * @param  int              $id
	 * @param UpdateCountryRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateCountryRequest $request) {
		$country = $this->countryRepository->find($id);

		if (empty($country)) {
			Flash::error(__('messages.not_found', ['model' => __('models/countries.singular')]));

			return redirect(route('admin.countries.index'));
		}

		$country = $this->countryRepository->update($request->all(), $id);

		Flash::success(__('messages.updated', ['model' => __('models/countries.singular')]));

		return redirect(route('admin.countries.index'));
	}

	/**
	 * Remove the specified Country from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id) {
		$country = $this->countryRepository->find($id);

		if (empty($country)) {
			Flash::error(__('messages.not_found', ['model' => __('models/countries.singular')]));

			return redirect(route('admin.countries.index'));
		}

		$this->countryRepository->delete($id);

		Flash::success(__('messages.deleted', ['model' => __('models/countries.singular')]));

		return redirect(route('admin.countries.index'));
	}
}
