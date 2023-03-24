<?php

namespace App\DataTables;

use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as YajraBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addIndexColumn()
            ->addColumn('action', 'admin.role.table_action');
    }

    public function query(): Builder
    {
        return (new RoleRepository())->datatable();
    }

    public function html(): YajraBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax('', $this->getScript(), [], ['error' => 'function (err) { defaultOnError(err);}'])
            ->addAction(['width' => '80px', 'responsivePriority' => -1, 'printable' => false, 'title' => __('Chức năng')])
            ->parameters([
                'order' => [[0, 'desc']],
                'responsive' => true,
                'language' => __('datatable'),
                'lengthMenu' => [[10, 50, 100, 200, -1], [10,  50, 100, 200, 'All']],
                'fnDrawCallback' => "function(oSettings) {
                    if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
                        $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                    } else {
                        $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
                    }
                }",
            ]);
    }

    protected function getColumns(): array
    {
        return [
            'dt_rowindex' => (new Column([
                'title' => __('STT'),
                'data' => 'DT_RowIndex',
                'className' => 'text-center',
                'width' => '80px',
                'searchable' => false,
                'orderable' => false,
            ])),
            'name' => (new Column([
                'title' => __('Tên chức vụ'),
                'data' => 'name',
                'searchable' => true,
                'orderable' => false,
            ])),
            'desc' => (new Column([
                'title' => __('Mô tả'),
                'data' => 'desc',
                'searchable' => true,
                'orderable' => false,
            ])),
        ];
    }

    protected function filename(): string
    {
        return __('Danh sách chức vụ').'_'.time();
    }

    private function getScript(): string
    {
        return '';
    }
}
