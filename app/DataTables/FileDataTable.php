<?php

namespace App\DataTables;

use App\Models\File;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FileDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		$dataTable = new EloquentDataTable($query);

		return $dataTable->addColumn('action', 'admin.files.datatables_actions');
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\File $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(File $model) {
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
						'className' => 'btn btn-success btn-sm',
						'text' => '<i class="fa fa-plus"></i> ' . __('auth.app.create') . '',
					],
					[
						'extend' => 'export',
						'className' => 'btn btn-success btn-sm',
						'text' => '<i class="fa fa-download"></i> ' . __('auth.app.export') . '',
					],
					[
						'extend' => 'print',
						'className' => 'btn btn-success btn-sm',
						'text' => '<i class="fa fa-print"></i> ' . __('auth.app.print') . '',
					],
					[
						'extend' => 'reset',
						'className' => 'btn btn-success btn-sm',
						'text' => '<i class="fa fa-undo"></i> ' . __('auth.app.reset') . '',
					],
					[
						'extend' => 'reload',
						'className' => 'btn btn-success btn-sm',
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
			'name' => new Column(['title' => __('models/files.fields.name'), 'data' => 'name']),
			'size' => new Column(['title' => __('models/files.fields.size'), 'data' => 'size']),
			'file' => new Column(['title' => __('models/files.fields.file'), 'data' => 'file']),
			'path' => new Column(['title' => __('models/files.fields.path'), 'data' => 'path']),
			'full_file' => new Column(['title' => __('models/files.fields.full_file'), 'data' => 'full_file']),
			'mime_type' => new Column(['title' => __('models/files.fields.mime_type'), 'data' => 'mime_type']),
			'file_type' => new Column(['title' => __('models/files.fields.file_type'), 'data' => 'file_type']),
			'relation_id' => new Column(['title' => __('models/files.fields.relation_id'), 'data' => 'relation_id']),
			'id' => new Column(['title' => __('models/files.fields.id'), 'data' => 'id', 'searchable' => false]),
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
