<?php

namespace App\DataTables;

use App\Models\Ad;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AdDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		$dataTable = new EloquentDataTable($query);

		return $dataTable
			->addColumn('action', 'admin.ads.datatables_actions')
			->editColumn('city_id', function ($q) {
				return $q->city->getTranslation('name', \App::getLocale());
			})->editColumn('user_id', function ($q) {
			return $q->user->name;
		})->editColumn('category_id', function ($q) {
			return $q->category->getTranslation('name', \App::getLocale());
		})->rawColumns([
			'city_id',
			'user_id',
			'category_id',
			'action',
		]);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Ad $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Ad $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->columns($this->getColumns())
			->minifiedAjax()
			->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
			->parameters([
				'dom' => 'Bfrtip',
				'stateSave' => true,
				'responsive' => true,
				'order' => [[0, 'desc']],
				'buttons' => [
					[
						'extend' => 'create',
						'className' => 'btn btn-primary btn-sm',
						'text' => '<i class="fa fa-plus"></i> ' . __('auth.app.create') . '',
					],
					[
						'extend' => 'export',
						'className' => 'btn btn-info btn-sm',
						'text' => '<i class="fa fa-download"></i> ' . __('auth.app.export') . '',
					],
					[
						'extend' => 'print',
						'className' => 'btn btn-success btn-sm',
						'text' => '<i class="fa fa-print"></i> ' . __('auth.app.print') . '',
					],
					[
						'extend' => 'reset',
						'className' => 'btn btn-warning btn-sm',
						'text' => '<i class="fa fa-undo"></i> ' . __('auth.app.reset') . '',
					],
					[
						'extend' => 'reload',
						'className' => 'btn btn-danger btn-sm',
						'text' => '<i class="fa fa-refresh"></i> ' . __('auth.app.reload') . '',
					],
				],
				'language' => [
					'url' => url('//cdn.datatables.net/plug-ins/1.10.12/i18n/English.json'),
				],
			]);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			'id' => new Column(['title' => __('models/ads.fields.id'), 'data' => 'id', 'searchable' => false]),
			'name' => new Column(['title' => __('models/ads.fields.name'), 'data' => 'name', 'searchable' => true]),
			'ad_type' => new Column(['title' => __('models/ads.fields.ad_type'), 'data' => 'ad_type', 'searchable' => true]),
			'contact_types' => new Column(['title' => __('models/ads.fields.contact_types'), 'data' => 'contact_types', 'searchable' => false]),
			'price' => new Column(['title' => __('models/ads.fields.price'), 'data' => 'price', 'searchable' => true]),
			'city_id' => new Column(['title' => __('models/ads.fields.city_id'), 'data' => 'city_id', 'searchable' => true]),
			'user_id' => new Column(['title' => __('models/ads.fields.user_id'), 'data' => 'user_id', 'searchable' => true]),
			'category_id' => new Column(['title' => __('models/ads.fields.category_id'), 'data' => 'category_id', 'searchable' => true]),
			'status' => new Column(['title' => __('models/ads.fields.status'), 'data' => 'status', 'searchable' => false]),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'adsdatatable_' . time();
	}
}
