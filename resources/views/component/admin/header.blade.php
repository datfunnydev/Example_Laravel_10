<div id=kt_header class="header header-fixed">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="header-menu-wrapper header-menu-wrapper-left" id=kt_header_menu_wrapper></div>
        <div class=topbar>
            <div class=dropdown>
                <div class=topbar-item data-toggle=dropdown data-offset=10px,0px>
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        @if (App::getLocale() == 'vi')
                            <img class="h-20px w-20px rounded-sm"
                                 src="{{ asset('assets/media/svg/flags/220-vietnam.svg') }}" alt="" />
                        @else
                            <img class="h-20px w-20px rounded-sm"
                                 src="{{ asset('assets/media/svg/flags/226-united-states.svg') }}" alt="" />
                        @endif
                    </div>
                </div>
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <ul class="navi navi-hover py-4">
                        <li class=navi-item>
                            <a href="#" data-lang="vi" class="switch_lang navi-link">
                                <span class="symbol symbol-20 mr-3">
                                    <img src="{{ asset('assets/media/svg/flags/220-vietnam.svg') }}" alt />
                                </span>
                                <span class=navi-text>{{ __('Tiếng Việt') }}</span>
                            </a>
                        </li>
                        <li class="navi-item active">
                            <a href="#" data-lang="en" class="switch_lang navi-link">
                                <span class="symbol symbol-20 mr-3">
                                    <img src="{{ asset('assets/media/svg/flags/226-united-states.svg') }}" alt />
                                </span>
                                <span class=navi-text>{{ __('Tiếng Anh') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="topbar-item">
                <div onclick="load_notification()" class="btn btn-icon btn-clean btn-lg mr-1"
                     id="kt_quick_panel_toggle">
                    <span style="position: relative" class="svg-icon svg-icon-xl svg-icon-primary">
                        <svg width="24px" height="24px" viewBox="0 0 24 24">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <path
                                    d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z"
                                    fill="#000000" />
                                <rect fill="#000000" opacity="0.3" x="10" y="16" width="4"
                                      height="4" rx="2" />
                            </g>
                        </svg>
                        <div style="position: absolute; top: -5%; right: -5%; border-radius: 50%; width: 13px; height: 13px; background-color: red;">
                            <span
                                style="display: flex;flex-direction: column; justify-content: center;text-align: center;font-size: 9.5px; color: white"
                                id="count_notification"></span>
                        </div>
                    </span>
                </div>
            </div>
            <div class=topbar-item>
                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                     id=kt_quick_user_toggle>
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">{{ __('Xin chào') }},</span>
                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->name }}</span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                        @isset(Auth::user()->avatar)
                            <span class="symbol-label font-size-h5 font-weight-bold"
                                  style="background-image:url('/storage/images/avatars/{{ Auth::user()->avatar }}')"></span>
                        @else
                            <span class="symbol-label font-size-h5 font-weight-bold"
                                  style="background-image:url({{ asset('assets/media/users/blank.png') }})"></span>
                        @endisset
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
