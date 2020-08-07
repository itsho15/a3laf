<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller {
	public function simple(Request $request) {
		$data = \DB::table('people');
		if ($request->input('search')) {
			$data = $data->where('name', 'LIKE', "%" . $request->search . "%");
		}
		$data = $data->paginate(10);
		return view('search', compact('data'));
	}
	public function advance(Request $request) {
		$data = \DB::table('people');
		if ($request->name) {
			$data = $data->where('name', 'LIKE', "%" . $request->name . "%");
		}
		if ($request->address) {
			$data = $data->where('address', 'LIKE', "%" . $request->address . "%");
		}
		if ($request->min_age && $request->max_age) {
			$data = $data->where('age', '>=', $request->min_age)
				->where('age', '<=', $request->max_age);
		}
		$data = $data->paginate(10);
		return view('search', compact('data'));
	}
}