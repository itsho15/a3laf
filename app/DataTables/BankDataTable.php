<?php

namespace App\DataTables;

use App\Models\Bank;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BankDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		$dataTable = new EloquentDataTable($query);

		return $dataTable->addColumn('action', 'admin.banks.datatables_actions')
			->editColumn('name', function ($q) {
				return $q->getTranslation('name', \App::getLocale());
			});
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Bank $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Bank $model) {
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
			'id' => new Column(['title' => __('models/banks.fields.id'), 'data' => 'id', 'searchable' => false]),
			'name' => new Column(['title' => __('models/banks.fields.name'), 'data' => 'name', 'searchable' => false]),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return '$MODEL_NAME_PLURAL_SNAKE_$datatable_' . time();
	}
}
