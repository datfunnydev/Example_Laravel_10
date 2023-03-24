<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LogActivityDataTable;
use App\Http\Controllers\Controller;

class LogActivityController extends Controller
{
    public function index(LogActivityDataTable $logActivityDataTable): mixed
    {
        return $logActivityDataTable->render('admin.log_activity.index');
    }
}
