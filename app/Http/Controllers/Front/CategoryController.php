<?php

namespace App\Http\Controllers\Front;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\AppBaseController;
use App\Models\Ad;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOTools;
use Flash;
use Response;

class CategoryController extends AppBaseController {
	/** @var  CategoryRepository */
	private $categoryRepository;

	public function __construct(CategoryRepository $categoryRepo) {
		$this->categoryRepository = $categoryRepo;
	}

	/**
	 * Display a listing of the Category.
	 *
	 * @param CategoryDataTable $categoryDataTable
	 * @return Response
	 */
	public function index() {
		SEOTools::setTitle(setting('site_title_' . lang()));
		SEOTools::setDescription(setting('aboutus_' . lang()));
		SEOTools::opengraph()->setUrl(url('/'));
		SEOTools::setCanonical('https://codecasts.com.br/lesson');
		SEOTools::opengraph()->addProperty('type', 'others');
		SEOTools::twitter()->setSite(setting('twitter_name'));
		SEOTools::jsonLd()->addImage(url('dist/svg/logo.svg'));

		$categories = Category::with(['ads'])->get();
		switch (request('sort')) {
		case 'desc':
			$ads = Ad::where('status', 'live')->Orwhere('status', 'sold')->orderBy('created_at', 'desc')->paginate(12);
			break;
		case 'high_price':
			$ads = Ad::where('status', 'live')->Orwhere('status', 'sold')->orderBy('price', 'desc')->paginate(12);
			break;
		case 'low_price':
			$ads = Ad::where('status', 'live')->Orwhere('status', 'sold')->orderBy('price', 'asc')->paginate(12);
			break;
		default:
			$ads = Ad::where('status', 'live')->Orwhere('status', 'sold')->orderBy('created_at', 'desc')->paginate(12);
			break;
		}
		return view('front.categories.index', compact('categories', 'ads'));
	}

	/**
	 * Display the specified Category.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id) {
		SEOTools::setTitle(setting('site_title_' . lang()));
		SEOTools::setDescription(setting('aboutus_' . lang()));
		SEOTools::opengraph()->setUrl(url('/'));
		SEOTools::setCanonical('https://codecasts.com.br/lesson');
		SEOTools::opengraph()->addProperty('type', 'others');
		SEOTools::twitter()->setSite(setting('twitter_name'));
		SEOTools::jsonLd()->addImage(url('dist/svg/logo.svg'));
		$categories = Category::with(['ads'])->get();
		$category = Category::whereId($id)->with(['ads'])->first();
		if (empty($category)) {
			Flash::error('Category not found');
			return redirect(route('front.categories.index'));
		}
		return view('front.categories.show', compact('categories', 'category', 'id'));
	}
}
