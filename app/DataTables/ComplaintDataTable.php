<?php

namespace App\DataTables;

use App\Models\Complaint;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ComplaintDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		$dataTable = new EloquentDataTable($query);

		return $dataTable->addColumn('action', 'admin.complaints.datatables_actions')
			->editColumn('ad_id', function ($q) {
				return '<a href="' . aurl('ads/' . $q->ad->id . '/edit') . '"> ' . $q->ad->name . '</a>';
			})->rawColumns([
			'ad_id',
			'action',
		]);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Complaint $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Complaint $model) {
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
			'id' => new Column(['title' => __('models/complaints.fields.id'), 'data' => 'id', 'searchable' => false]),
			'content' => new Column(['title' => __('models/complaints.fields.content'), 'data' => 'content', 'searchable' => true]),
			'ad_id' => new Column(['title' => __('models/complaints.fields.ad_id'), 'data' => 'ad_id', 'searchable' => true]),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'complaintsdatatable_' . time();
	}
}
