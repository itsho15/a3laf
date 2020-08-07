<?php
namespace App\Traits;
trait Searching {
	public function AdvanceSearch($model, $columns, $request) {
		$query = $model->query();
		if ($columns) {
			/*
				 for loop columns to get all fields
			*/

			foreach ($columns as $column => $searchtype) {
				$query->where(function ($q) use ($column, $request, $searchtype) {

					/*
						Check Type of Search by key in array like ( like , = , or , whereHas)
					*/

					if ($column == 'keyword' && $searchtype == 'keyword') {
						$q->where('name', 'like', '%' . $request->keyword . '%')->
							Orwhere('body', 'like', '%' . $request->keyword . '%');
					}
					if ($searchtype == '=' && isset($request->{$column})) {
						$q->where($column, $request->{$column});
					}
					if ($searchtype == 'like' && isset($request->{$column})) {
						$q->where($column, 'like', '%' . $request->{$column} . '%');
					}

				});
			}
		}
		$query = $query->paginate(10, "*");
		return $query;
	}
}