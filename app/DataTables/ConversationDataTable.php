<?php

namespace App\DataTables;

use App\Models\Conversation;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ConversationDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		$dataTable = new EloquentDataTable($query);

		return $dataTable->addColumn('action', 'admin.conversations.datatables_actions');
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Conversation $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Conversation $model) {
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
			'id' => new Column(['title' => __('models/conversations.fields.id'), 'data' => 'id', 'searchable' => false]),
			'offer_id' => new Column(['title' => __('models/conversations.fields.offer_id'), 'data' => 'offer_id', 'searchable' => false]),
			'order_id' => new Column(['title' => __('models/conversations.fields.order_id'), 'data' => 'order_id', 'searchable' => false]),
			'from_id' => new Column(['title' => __('models/conversations.fields.from_id'), 'data' => 'from_id', 'searchable' => false]),
			'to_id' => new Column(['title' => __('models/conversations.fields.to_id'), 'data' => 'to_id', 'searchable' => false]),
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
