<div class="card-body">
    {!!
        $dataTable->table([
            'class' => 'table table-separate table-head-custom table-checkable display nowrap',
            'id' => 'datatable_log_activity',
        ])
    !!}
</div>
@push('scripts')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        let DatatableLogActivity;
        $(document).ready(function() {
            DatatableLogActivity = window.LaravelDataTables["datatable_log_activity"];
        });
    </script>
@endpush
