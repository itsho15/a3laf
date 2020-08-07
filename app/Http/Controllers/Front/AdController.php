<?php

namespace App\Http\Controllers\Front;

use App\DataTables\AdDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Models\Ad;
use App\Repositories\AdRepository;
use App\Traits\Searching;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Flash;
use Response;

class AdController extends AppBaseController {
	/** @var  AdRepository */
	use Searching;
	private $adRepository;

	public function __construct(AdRepository $adRepo) {
		$this->adRepository = $adRepo;
		$this->middleware('auth')->only(['store', 'update', 'destroy', 'create', 'edit', 'MyAds']);
	}

	/**
	 * Display a listing of the Ad.
	 *
	 * @param AdDataTable $adDataTable
	 * @return Response
	 */
	public function index() {
		SEOTools::setTitle('Home');
		SEOTools::setDescription('This is my page description');
		SEOTools::opengraph()->setUrl('http://current.url.com');
		SEOTools::setCanonical('https://codecasts.com.br/lesson');
		SEOTools::opengraph()->addProperty('type', 'articles');
		SEOTools::twitter()->setSite('@LuizVinicius73');
		SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');
		return view('front.ads.index');
	}

	/**
	 * Show the form for creating a new Ad.
	 *
	 * @return Response
	 */
	public function create() {
		return view('front.ads.create');
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
		session()->flash('success', __('messages.saved', ['model' => __('models/ads.singular')]));
		return redirect(url('my-ads'));
	}

	public function MyAds() {
		$user = auth()->user();
		$ads = $user->ads()->paginate(10);
		/*
			    add isFav , lastImage To response
		*/
		foreach ($ads as $ad) {
			$ad->isFav = $ad->isFav();
			$ad->averageRating = $ad->averageRating;
			$ad->ratings = $ad->ratings;
			$ad->lastImage = ($ad->images()) ? $ad->images()->first() : '';
		}
		return view('front.ads.myads', compact('ads'));
	}

	/**
	 * Display the specified Ad.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id, $name = '') {
		$ad = Ad::findOrFail($id);

		if ($name !== str_slug($ad->name, '-')) {
			return redirect('/');
		}

		SEOMeta::setTitle($ad->name);
		SEOMeta::setDescription($ad->body);
		SEOMeta::addMeta('article:published_time', $ad->created_at->toW3CString(), 'property');
		SEOMeta::addMeta('article:section', $ad->category->name, 'property');
		SEOMeta::addKeyword([$ad->name, $ad->body, 'key3']);

		OpenGraph::setDescription($ad->body);
		OpenGraph::setTitle($ad->name);
		OpenGraph::setUrl(url('/'));
		OpenGraph::addProperty('type', 'other');
		OpenGraph::addProperty('locale', 'en-us');
		OpenGraph::addProperty('locale:alternate', ['ar-ar', 'en-us']);

		OpenGraph::addImage(($ad->images()->count() > 0) ? $ad->images()->first()->full_file : '');
		OpenGraph::addImage(($ad->images()->count() > 0) ? $ad->images()->pluck('full_file') : '');
		OpenGraph::addImage(['url' => ($ad->images()->count() > 0) ? $ad->images()->first()->full_file : '', 'size' => 300]);
		OpenGraph::addImage(($ad->images()->count() > 0) ? $ad->images()->first()->full_file : '', ['height' => 300, 'width' => 300]);

		JsonLd::setTitle($ad->title);
		JsonLd::setDescription($ad->body);
		JsonLd::setType('other');
		JsonLd::addImage(($ad->images()->count() > 0) ? $ad->images()->first()->full_file : '');

		return view('front.ads.show')->with('ad', $ad);
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
		if (auth()->id() != $ad->user_id) {
			session()->flash('error', 'you can not edit this ad , you not the owner of it');
			return redirect(url('my-ads'));
		}
		if (empty($ad)) {
			session()->flash('error', __('messages.not_found', ['model' => __('models/ads.singular')]));
			return redirect(url('my-ads'));
		}
		return view('front.ads.edit')->with('ad', $ad);
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
			return redirect(route('front.ads.myads'));
		}

		$ad = $this->adRepository->update($request->all(), $id);

		Flash::success(__('messages.updated', ['model' => __('models/ads.singular')]));

		return redirect(url('my-ads'));
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

			return redirect(url('my-ads'));
		}

		$this->adRepository->delete($id);

		Flash::success(__('messages.deleted', ['model' => __('models/ads.singular')]));

		return redirect(url('my-ads'));
	}

	public function Search() {
		$searchResults = $this->AdvanceSearch(
			new Ad(),
			[
				'name' => 'like',
				'city_id' => '=',
				'category_id' => '=',
				'body' => 'like',
				'keyword' => 'keyword',
			], request());

		/*
			    add isFav , lastImage To response
		*/

		foreach ($searchResults as $ad) {
			$ad->isFav = $ad->isFav();
			$ad->averageRating = $ad->averageRating;
			$ad->ratings = $ad->ratings;
			$ad->lastImage = ($ad->images()->count() > 0) ? $ad->images()->first() : '';
		}
		return view('front.ads.search')->with('searchResults', $searchResults);
	}
}
