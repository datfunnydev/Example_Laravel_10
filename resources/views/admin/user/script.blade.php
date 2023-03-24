@push('scripts')
    <script type="text/javascript">
        $('#create_birthday, #update_birthday').datepicker();
        $('#create_role_id')
            .select2({
                placeholder: '{{ __('Chọn chức vụ') }}',
            })
            .on('change.select2', function () {
                validation_create_user.revalidateField('role_id');
            });

        $('#update_role_id')
            .select2({
                placeholder: '{{ __('Chọn chức vụ') }}',
            });
    </script>
@endpush
