<?php

namespace App\Http\Controllers;

use App\DataTables\PageDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreatePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Repositories\PageRepository;
use Flash;
use Response;

class PageController extends AppBaseController {
	/** @var  PageRepository */
	private $pageRepository;

	public function __construct(PageRepository $pageRepo) {
		$this->pageRepository = $pageRepo;
	}

	/**
	 * Display a listing of the Page.
	 *
	 * @param PageDataTable $pageDataTable
	 * @return Response
	 */
	public function index(PageDataTable $pageDataTable) {
		return $pageDataTable->render('admin.pages.index');
	}

	/**
	 * Show the form for creating a new Page.
	 *
	 * @return Response
	 */
	public function create() {
		return view('admin.pages.create');
	}

	/**
	 * Store a newly created Page in storage.
	 *
	 * @param CreatePageRequest $request
	 *
	 * @return Response
	 */
	public function store(CreatePageRequest $request) {
		$input = $request->all();

		$page = $this->pageRepository->create($input);

		Flash::success(__('messages.saved', ['model' => __('models/pages.singular')]));

		return redirect(route('admin.pages.index'));
	}

	/**
	 * Display the specified Page.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id) {
		$page = $this->pageRepository->find($id);

		if (empty($page)) {
			Flash::error(__('models/pages.singular') . ' ' . __('messages.not_found'));

			return redirect(route('admin.pages.index'));
		}

		return view('admin.pages.show')->with('page', $page);
	}

	/**
	 * Show the form for editing the specified Page.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id) {
		$page = $this->pageRepository->find($id);

		if (empty($page)) {
			Flash::error(__('messages.not_found', ['model' => __('models/pages.singular')]));

			return redirect(route('admin.pages.index'));
		}

		return view('admin.pages.edit')->with('page', $page);
	}

	/**
	 * Update the specified Page in storage.
	 *
	 * @param  int              $id
	 * @param UpdatePageRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdatePageRequest $request) {
		$page = $this->pageRepository->find($id);

		if (empty($page)) {
			Flash::error(__('messages.not_found', ['model' => __('models/pages.singular')]));

			return redirect(route('admin.pages.index'));
		}

		$page = $this->pageRepository->update($request->all(), $id);

		Flash::success(__('messages.updated', ['model' => __('models/pages.singular')]));

		return redirect(route('admin.pages.index'));
	}

	/**
	 * Remove the specified Page from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id) {
		$page = $this->pageRepository->find($id);

		if (empty($page)) {
			Flash::error(__('messages.not_found', ['model' => __('models/pages.singular')]));

			return redirect(route('admin.pages.index'));
		}

		$this->pageRepository->delete($id);

		Flash::success(__('messages.deleted', ['model' => __('models/pages.singular')]));

		return redirect(route('admin.pages.index'));
	}
}
