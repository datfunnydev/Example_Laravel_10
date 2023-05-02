<script type="text/javascript">
    load_menu_active();

    function load_menu_active() {
        $(".menu-item").removeClass("menu-item-active");
        let pathname = location.pathname.replace('/', '');
        if (pathname === '') {
            $('#profiles').addClass("menu-item-active");
        } else {
            $('#' + pathname).addClass("menu-item-active");
        }
    }
    $(document).ready(function () {
        $('.switch_lang').on("click", function (e) {
            e.preventDefault();
            let lang = $(this).data("lang");
            axios.get('/language/' + lang)
                .then(function () {
                    location.reload();
                })
        });
    });
</script>
<script type="text/javascript">
    const mess_success = (title, message) => {
        Swal.fire({
            icon: 'success',
            title: title,
            text: message,
            showConfirmButton: false,
            timer: 2000
        });
    };
    const mess_error = (title, message) => {
        Swal.fire({
            icon: 'error',
            title: title,
            text: message,
            showConfirmButton: false,
            timer: 2000
        });
    };
    const mess_trial = () => {
        swal.fire({
            icon: "error",
            text: '{{__('Đã có sự cố xảy ra, vui lòng kiểm tra lại')}}',
            buttonsStyling: false,
            confirmButtonText: '{{__('Đồng ý')}}',
            customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
            }
        }).then(function() {
            KTUtil.scrollTop();
        });
    };
    const disable_btn = (element) => {
        let text = '<span class="spinner-border spinner-border-sm align-middle ms-2"></span><span class="indicator-progress"> {{ __('Vui lòng đợi') }}</span>';
        element.find(':input[type=submit]').attr("disabled", true).html(text);
    }
    const enable_btn = (element, text) => {
        element.find(':input[type=submit]').removeAttr('disabled').text(text);
    }
    const intVal = (i) => {
        return typeof i === 'string' ? i.replaceAll(/[.,₫]/g, '') * 1 : typeof i === 'number' ? i : 0;
    };
    const formatNumber = (data) => {
        try {
            if (parseInt(data) === 0) {
                return 0;
            }
            let x = intVal(data);
            if (isNaN(x)) {
                return 0;
            }
            let e = Math.round(x);

            return e.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        } catch (err) {
            return 0;
        }
    };
    $('.is_number').keyup(function () {
        $(this).val(formatNumber($(this).val()))
    })
    $.fn.datepicker.defaults.language = '{{ App::getLocale() }}';
    $.fn.datepicker.defaults.format = "yyyy-mm-dd";
    $.fn.datepicker.defaults.rtl = KTUtil.isRTL();
    $.fn.datepicker.defaults.todayHighlight = true;
    @if(config('app.debug') == 'false')
        try {
            $.fn.dataTable.ext.errMode = 'none';
        } catch(error) {}
    @endif
    $(document).ajaxError(function(event, jqxhr) {
        if (jqxhr.status === 401) {
            window.location = '/login';
        }
    });
    window.axios.interceptors.response.use(function (response) {
        return response;
    }, function (error) {
        if (401 === error.response.status) {
            window.location = '/login';
        } else {
            return Promise.reject(error);
        }
    });
    $(document).ready(function() {
        let body =  $('body');
        let modal_backdrop =  $('.modal-backdrop');
        $('.modal')
            .on("hidden.bs.modal", function () {
                if ($('.modal:visible').length) {
                    body.addClass('modal-open');
                }
            })
            .on('hidden.bs.modal', function() {
                $(this).removeClass( 'fv-modal-stack' );
                body.data( 'fv_open_modals', body.data( 'fv_open_modals' ) - 1 );
            })
            .on('shown.bs.modal', function () {
                if (typeof( body.data( 'fv_open_modals' ) ) == 'undefined' ) {
                    body.data( 'fv_open_modals', 0 );
                }
                if ($(this).hasClass('fv-modal-stack')) {
                    return;
                }
                $(this).addClass('fv-modal-stack');
                body.data('fv_open_modals', body.data('fv_open_modals' ) + 1 );
                $(this).css('z-index', 1040 + (10 * body.data('fv_open_modals' )));
                modal_backdrop.not('.fv-modal-stack').css('z-index', 1039 + (10 * body.data('fv_open_modals')));
                modal_backdrop.not('fv-modal-stack').addClass('fv-modal-stack');
            });
    });
</script>
