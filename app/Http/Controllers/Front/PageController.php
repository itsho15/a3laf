<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\AppBaseController;
use App\Models\Page;
use Flash;
use Response;

class PageController extends AppBaseController {
	/**
	 * Display the specified Page.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id, $slug = '') {
		$page = Page::findOrFail($id);
		if ($slug !== str_slug($page->slug, '-')) {
			session()->flash('error', trans('front.not_found_page'));
			return redirect('/');
		}
		return view('front.pages.show', compact('page'));
	}
}
