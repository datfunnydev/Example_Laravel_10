<?php

namespace App\DataTables;

use App\Repositories\LogActivityRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as YajraBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LogActivityDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)->toDateTimeString();
            });
    }

    public function query(): Builder
    {
        return (new LogActivityRepository())->datatable();
    }

    public function html(): YajraBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax('', $this->getScript(), [], ['error' => 'function (err) { defaultOnError(err);}'])
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
            'user.email' => (new Column([
                'title' => __('Email'),
                'data' => 'user.email',
                'searchable' => true,
                'orderable' => false,
            ])),
            'user.name' => (new Column([
                'title' => __('Nhân viên'),
                'data' => 'user.name',
                'searchable' => true,
                'orderable' => false,
            ])),
            'activity' => (new Column([
                'title' => __('Hoạt động'),
                'data' => 'activity',
                'searchable' => true,
                'orderable' => false,
            ])),
            'created_at' => (new Column([
                'title' => __('Thời gian'),
                'data' => 'created_at',
                'searchable' => true,
                'orderable' => false,
            ])),
        ];
    }

    protected function filename(): string
    {
        return __('log_activity').'_'.time();
    }

    private function getScript(): string
    {
        return '';
    }
}
