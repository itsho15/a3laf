<?php

namespace App\Http\Controllers;

use App\DataTables\AdDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Repositories\AdRepository;
use Flash;
use Response;

class AdController extends AppBaseController {
	/** @var  AdRepository */
	private $adRepository;

	public function __construct(AdRepository $adRepo) {
		$this->adRepository = $adRepo;
	}

	/**
	 * Display a listing of the Ad.
	 *
	 * @param AdDataTable $adDataTable
	 * @return Response
	 */
	public function index(AdDataTable $adDataTable) {
		return $adDataTable->render('admin.ads.index');
	}

	/**
	 * Show the form for creating a new Ad.
	 *
	 * @return Response
	 */
	public function create() {
		return view('admin.ads.create');
	}

	/**
	 * Store a newly created Ad in storage.
	 *
	 * @param CreateAdRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateAdRequest $request) {
		$input = $request->all();

		$ad = $this->adRepository->create($input);

		Flash::success(__('messages.saved', ['model' => __('models/ads.singular')]));

		return redirect(route('admin.ads.index'));
	}

	/**
	 * Display the specified Ad.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id) {
		$ad = $this->adRepository->find($id);

		if (empty($ad)) {
			Flash::error(__('models/ads.singular') . ' ' . __('messages.not_found'));

			return redirect(route('admin.ads.index'));
		}

		return view('admin.ads.show')->with('ad', $ad);
	}

	/**
	 * Show the form for editing the specified Ad.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id) {
		$ad = $this->adRepository->find($id);

		if (empty($ad)) {
			Flash::error(__('messages.not_found', ['model' => __('models/ads.singular')]));

			return redirect(route('admin.ads.index'));
		}

		return view('admin.ads.edit')->with('ad', $ad);
	}

	/**
	 * Update the specified Ad in storage.
	 *
	 * @param  int              $id
	 * @param UpdateAdRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateAdRequest $request) {
		$ad = $this->adRepository->find($id);

		if (empty($ad)) {
			Flash::error(__('messages.not_found', ['model' => __('models/ads.singular')]));

			return redirect(route('admin.ads.index'));
		}

		$ad = $this->adRepository->update($request->all(), $id);

		Flash::success(__('messages.updated', ['model' => __('models/ads.singular')]));

		return redirect(route('admin.ads.index'));
	}

	/**
	 * Remove the specified Ad from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id) {
		$ad = $this->adRepository->find($id);

		if (empty($ad)) {
			Flash::error(__('messages.not_found', ['model' => __('models/ads.singular')]));

			return redirect(route('admin.ads.index'));
		}

		$this->adRepository->delete($id);

		Flash::success(__('messages.deleted', ['model' => __('models/ads.singular')]));

		return redirect(route('admin.ads.index'));
	}
}
