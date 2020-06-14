<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Setting;
use Illuminate\Http\Request;
use Response;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API
 */

class SettingsApiController extends AppBaseController {
	/**
	 * Display a listing of the Category.
	 * GET|HEAD /categories
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function index(Request $request) {
		$settings = Setting::pluck('val', 'name');

		return $this->sendResponse($settings->toArray(), 'Settings retrieved successfully');
	}

}
