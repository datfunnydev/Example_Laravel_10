<?php

namespace App\DataTables;

use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as YajraBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addIndexColumn()
            ->addColumn('action', 'admin.user.table_action')
            ->editColumn('last_login_at', function ($query) {
                return Carbon::parse($query->last_login_at)->toDateTimeString();
            });
    }

    public function query(): Builder
    {
        return (new UserRepository())->user_datatable();
    }

    public function html(): YajraBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax('/users', $this->getScript(), [], ['error' => 'function (err) { defaultOnError(err);}'])
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
            'role.name' => (new Column([
                'title' => __('Chức vụ'),
                'data' => 'role.name',
                'searchable' => true,
                'orderable' => false,
            ])),
            'email' => (new Column([
                'title' => __('Email'),
                'data' => 'email',
                'searchable' => true,
                'orderable' => false,
            ])),
            'name' => (new Column([
                'title' => __('Họ và tên'),
                'data' => 'name',
                'searchable' => true,
                'orderable' => false,
            ])),
            'phone' => (new Column([
                'title' => __('Số điện thoại'),
                'data' => 'phone',
                'searchable' => true,
                'orderable' => false,
            ])),
            'last_login_at' => (new Column([
                'title' => __('Đăng nhập lúc'),
                'data' => 'last_login_at',
                'searchable' => true,
                'orderable' => false,
            ])),
        ];
    }

    protected function filename(): string
    {
        return __('Danh sách nhân viên').'_'.time();
    }

    private function getScript(): string
    {
        return '';
    }
}
