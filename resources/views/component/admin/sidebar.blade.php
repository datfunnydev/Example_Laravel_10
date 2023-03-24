<div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
    <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
        <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10"
            role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_notifications">{{ __('Thông báo') }}</a>
            </li>
        </ul>
        <div class="offcanvas-close mt-n1 pr-5">
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
    </div>
    <div class="offcanvas-content px-10">
        <div class="tab-content">
            <div class="tab-pane fade show pt-3 pr-5 mr-n5 active" id="kt_quick_panel_logs" role="tabpanel">
                <div class="mb-15">
                    <h5 class="font-weight-bold mb-5">{{ __('Thông báo hệ thống') }}</h5>
                    <div id="load_notification"></div>
                </div>
            </div>
        </div>
    </div>
    <div id=kt_quick_user class="offcanvas offcanvas-right p-10">
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0">{{ __('Thông tin tài khoản') }}</h3>
            <a href=# class="btn btn-xs btn-icon btn-light btn-hover-primary" id=kt_quick_user_close>
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <div class="offcanvas-content pr-5 mr-n5">
            <div class="d-flex align-items-center mt-5">
                <div class="symbol symbol-100 mr-5">
                    @if (Auth::user()->avatar)
                        <span class="symbol-label font-size-h5 font-weight-bold"
                              style="background-image:url('/storage/images/avatars/{{ Auth::user()->avatar }}')"></span>
                    @else
                        <span class="symbol-label font-size-h5 font-weight-bold"
                              style="background-image:url({{ asset('assets/media/users/blank.png') }})"></span>
                    @endif
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div class="d-flex flex-column">
                    <span class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                        {{ Auth::user()->name }}
                    </span>
                    <div class="text-muted mt-1">
                        @if(Auth::user()->type == 0)
                            {{ __('Quản trị viên') }}
                        @elseif(Auth::user()->type == 1)
                            {{ Auth::user()->role->name }}
                        @else
                            {{ __('Khách hàng') }}
                        @endif
                    </div>
                    <div class="navi mt-2">
                        <span class=navi-item>
                            <span class="navi-link p-0 pb-2">
                                <span class="navi-icon mr-1">
                                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                                        <svg width=24px height=24px viewBox="0 0 24 24">
                                            <g stroke=none stroke-width=1 fill=none fill-rule=evenodd>
                                                <rect x=0 y=0 width=24 height=24 />
                                                <path
                                                    d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                    fill=#000000 />
                                                <circle fill=#000000 opacity=0.3 cx=19.5 cy=17.5 r=2.5 />
                                            </g>
                                        </svg>
                                    </span>
                                </span>
                                <span class="navi-text text-muted text-hover-primary">{{ Auth::user()->email }}</span>
                            </span>
                        </span>
                        <a href="{{ url('/logout') }}"
                           class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">{{ __('Đăng xuất') }}</a>
                    </div>
                </div>
            </div>
            <div class="separator separator-dashed mt-8 mb-5"></div>
            <div class="navi navi-spacer-x-0 p-0">
                <a href="{{ url('/profile') }}" class=navi-item>
                    <div class=navi-link>
                        <div class="symbol symbol-40 bg-light mr-3">
                            <div class=symbol-label>
                                <span class="svg-icon svg-icon-md svg-icon-success">
                                    <svg width=24px height=24px viewBox="0 0 24 24">
                                        <g stroke=none stroke-width=1 fill=none fill-rule=evenodd>
                                            <rect x=0 y=0 width=24 height=24 />
                                            <path
                                                d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                fill=#000000 />
                                            <circle fill=#000000 opacity=0.3 cx=18.5 cy=5.5 r=2.5 />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class=navi-text>
                            <div class=font-weight-bold>{{ __('Hồ sơ') }}</div>
                            <div class=text-muted>{{ __('Chỉnh sửa hồ sơ cho tài khoản của bạn') }}</div>
                        </div>
                    </div>
                </a>
                <a href="{{ url('/change-pass') }}" class=navi-item>
                    <div class=navi-link>
                        <div class="symbol symbol-40 bg-light mr-3">
                            <div class=symbol-label>
                                <span class="svg-icon svg-icon-md svg-icon-warning">
                                    <svg width=24px height=24px viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M14.1654881,7.35483745 L9.61055177,10.3622525 C9.47921741,10.4489666 9.39637436,10.592455 9.38694497,10.7495509 L9.05991526,16.197949 C9.04337012,16.4735952 9.25341309,16.7104632 9.52905936,16.7270083 C9.63705011,16.7334903 9.74423017,16.7047714 9.83451193,16.6451626 L14.3894482,13.6377475 C14.5207826,13.5510334 14.6036256,13.407545 14.613055,13.2504491 L14.9400847,7.80205104 C14.9566299,7.52640477 14.7465869,7.28953682 14.4709406,7.27299168 C14.3629499,7.26650974 14.2557698,7.29522855 14.1654881,7.35483745 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class=navi-text>
                            <div class=font-weight-bold>{{ __('Đổi mật khẩu') }}</div>
                            <div class=text-muted>{{ __('Đổi mật khẩu cho tài khoản của bạn') }}</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div id=kt_scrolltop class=scrolltop>
    <span class=svg-icon>
        <svg width=24px height=24px viewBox="0 0 24 24">
            <g stroke=none stroke-width=1 fill=none fill-rule=evenodd>
                <polygon points="0 0 24 0 24 24 0 24" />
                <rect fill=#000000 opacity=0.3 x=11 y=10 width=2 height=10 rx=1 />
                <path
                    d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                    fill=#000000 fill-rule=nonzero />
            </g>
        </svg>
    </span>
</div>
