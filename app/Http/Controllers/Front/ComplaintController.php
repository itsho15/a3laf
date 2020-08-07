<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateComplaintRequest;
use App\Repositories\ComplaintRepository;
use Flash;
use Response;

class ComplaintController extends AppBaseController {
	/** @var  ComplaintRepository */
	private $complaintRepository;

	public function __construct(ComplaintRepository $complaintRepo) {
		$this->complaintRepository = $complaintRepo;
	}
	/**
	 * Store a newly created Complaint in storage.
	 *
	 * @param CreateComplaintRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateComplaintRequest $request) {
		$input = $request->all();
		$complaint = $this->complaintRepository->create($input);
		session()->flash('success', __('messages.saved', ['model' => __('models/complaints.singular')]));
		return redirect()->back();
	}
}
