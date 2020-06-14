<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		$dataTable = new EloquentDataTable($query);

		return $dataTable->addColumn('action', 'admin.categories.datatables_actions');
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Category $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Category $model) {
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
			->addAction(['width' => '120px', 'printable' => false])
			->parameters([
				'dom' => 'Bfrtip',
				'stateSave' => true,
				'order' => [[0, 'desc']],
				'buttons' => [
					['extend' => 'create', 'className' => 'btn btn-primary btn-sm', 'text' => trans('backend.Create')],
					['extend' => 'export', 'className' => 'btn btn-info btn-sm', 'text' => trans('backend.export')],
					['extend' => 'print', 'className' => 'btn btn-success btn-sm', 'text' => trans('backend.print')],
					['extend' => 'reset', 'className' => 'btn btn-warning btn-sm', 'text' => trans('backend.reset')],
					['extend' => 'reload', 'className' => 'btn btn-danger btn-sm', 'text' => trans('backend.reload')],
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
			'id' => ['searchable' => false],
			'name',
			'image',
			'parent_id',
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'categoriesdatatable_' . time();
	}
}
