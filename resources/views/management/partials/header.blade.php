<div class="nav-header">
    @php
        $checkRoute = '';
        if (
            Auth::guard('admin')->user()->role === ROLE_ADMIN ||
            Auth::guard('admin')->user()->role === ROLE_SUB_ADMIN
        ) {
            $checkRoute = 'admin.home';
        } elseif (
            Auth::guard('admin')->user()->role === ROLE_COMPANY ||
            Auth::guard('admin')->user()->role === ROLE_HIRING
        ) {
            $checkRoute = 'company.home';
        } elseif (
            Auth::guard('admin')->user()->role === ROLE_UNIVERSITY ||
            Auth::guard('admin')->user()->role === ROLE_SUB_UNIVERSITY
        ) {
            $checkRoute = 'university.home';
        }
    @endphp
    <a href="{{ route($checkRoute) }}"><img src=" {{ asset('clients/images/header/logo2.png') }}" alt="Logo"
            title="Job Pro" class=" brand-logo">
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
            <svg width="20" height="20" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="22" y="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="22" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="11" y="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="11" y="22" width="4" height="4" rx="2" fill="#2A353A" />
                <rect width="4" height="4" rx="2" fill="#2A353A" />
                <rect y="11" width="4" height="4" rx="2" fill="#2A353A" />
                <rect x="22" y="22" width="4" height="4" rx="2" fill="#2A353A" />
                <rect y="22" width="4" height="4" rx="2" fill="#2A353A" />
            </svg>
        </div>
    </div>
</div>

{{-- Header top --}}
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">

                </div>
                <ul class="navbar-nav header-right">
                    {{-- <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link bell dz-theme-mode" href="javascript:void(0);">
                            <i id="icon-light" class="fas fa-sun"></i>
                            <i id="icon-dark" class="fas fa-moon"></i>
                        </a>
                    </li> --}}

                    {{--                    Change Language --}}
                    <li class="nav-item">
                        <div class="search-coundry">
                            <select
                                class="form-control custom-image-select-2 image-select mt-3 mt-sm-0 onchange-language"
                                data-url-language="{{ route('language.change', '') }}">
                                @foreach (config('languages.supported') as $item)
                                    <option value="{{ $item['code'] }}"
                                        {{ $item['code'] == app()->getLocale() ? 'selected' : '' }}
                                        data-thumbnail="{{ asset($item['image']) }}"
                                        data-content="<img src='{{ asset($item['image']) }}'/> ">
                                        {{ $item['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </li>

                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link position-relative" href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown">
                            <p id="countNotificationUnSeen"
                                class="count-notification {{ !empty($notificationCount) ? $notificationCount : 'd-none' }}">
                                {{ !empty($notificationCount) ? $notificationCount : 0 }}</p>
                            <svg width="23" height="23" viewBox="0 0 26 26" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22.75 10.8334C22.7469 9.8751 22.4263 8.94488 21.8382 8.18826C21.2501 7.43163 20.4279 6.89126 19.5 6.6517V4.33337C19.4997 4.15871 19.4572 3.98672 19.3761 3.83204C19.295 3.67736 19.1777 3.54459 19.0342 3.44503C18.8922 3.34623 18.7286 3.28286 18.5571 3.26024C18.3856 3.23763 18.2111 3.25641 18.0484 3.31503L8.59086 6.7492L4.39835 6.50003C4.25011 6.49047 4.10147 6.51151 3.9617 6.56183C3.82192 6.61215 3.69399 6.69068 3.58585 6.79253C3.4789 6.89448 3.39394 7.01723 3.33619 7.15323C3.27843 7.28924 3.24911 7.43561 3.25002 7.58337V15.1667C3.25022 15.3205 3.28316 15.4725 3.34667 15.6126C3.41018 15.7527 3.5028 15.8777 3.61835 15.9792C3.733 16.0795 3.86752 16.1545 4.01312 16.1993C4.15873 16.2441 4.31214 16.2577 4.46335 16.2392L5.88252 16.0659L6.90085 21.8509C6.94471 22.1052 7.07794 22.3356 7.27655 22.5004C7.47516 22.6653 7.7261 22.7538 7.98419 22.75H11.9167C12.0748 22.7521 12.2314 22.7195 12.3756 22.6545C12.5197 22.5896 12.648 22.4939 12.7512 22.3741C12.8544 22.2544 12.9302 22.1135 12.9732 21.9613C13.0162 21.8092 13.0253 21.6494 13 21.4934L12.1984 16.7267L18.1242 18.4167C18.2211 18.4325 18.3198 18.4325 18.4167 18.4167C18.704 18.4167 18.9796 18.3026 19.1827 18.0994C19.3859 17.8962 19.5 17.6207 19.5 17.3334V15.015C20.4279 14.7755 21.2501 14.2351 21.8382 13.4785C22.4263 12.7218 22.7469 11.7916 22.75 10.8334ZM5.41669 8.7317L7.58335 8.85087V13.6717L5.41669 13.9425V8.7317ZM10.6384 20.5834H8.88336L8.03836 15.795L8.59086 15.73L9.89086 16.0875L10.6384 20.5834ZM17.3334 15.9034L11.4292 14.2675C11.2529 14.1491 11.0457 14.085 10.8334 14.0834L9.75002 13.78V8.6667L17.3334 5.91503V15.9034ZM19.5 12.6534V8.97003C19.8233 9.16188 20.0912 9.43455 20.2772 9.76124C20.4632 10.0879 20.5611 10.4574 20.5611 10.8334C20.5611 11.2093 20.4632 11.5788 20.2772 11.9055C20.0912 12.2322 19.8233 12.5049 19.5 12.6967V12.6534Z"
                                    fill="#666666"></path>
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end of-visible " data-bs-popper="static">
                            <div class="dropdown-header">
                                <h4 class="title mb-0">{{ __('label.notification.name') }}</h4>
                                <a href="javascript:void(0);" class="d-none"><i class="flaticon-381-settings-6"></i></a>
                            </div>

                            <div id="DZ_W_Notification1" class="widget-media dlab-scroll p-3" style="height:380px;">
                                <ul class="timeline" id="notificationsHeader"
                                    data-id-chanel="{{ $valueId['company'] ?? ($valueId['university'] ?? (0 ?? ROLE_ADMIN)) }}">
                                    @forelse ($notificationsHeader as $item)
                                        <li onclick="changeStatus({{ $item->id }})">
                                            <a href="{{ url($item->link) }}">
                                                <div class="timeline-panel {{ $item->is_seen == SEEN ? 'read' : '' }}">
                                                    <div class="media me-2">
                                                        @if ($item->type === TYPE_JOB)
                                                            <i class="fa-solid fa-briefcase"></i>
                                                        @elseif($item->type === TYPE_COMPANY)
                                                            <i class="fa-solid fa-building"></i>
                                                        @elseif($item->type === TYPE_UNIVERSITY)
                                                            <i class="fa-solid fa-building-columns"></i>
                                                        @elseif($item->type === TYPE_WORKSHOPS)
                                                            <i class="fa-solid fa-chalkboard-teacher"></i>
                                                        @elseif($item->type === TYPE_COLLABORATION)
                                                            <i class="fas fa-handshake"></i>
                                                        @endif
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">{{ $item->title }}</h6>
                                                        <small
                                                            class="d-block">{{ date('d/m/Y H:i', strtotime($item->created_at)) }}
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="timeline-border"></div>
                                            </a>
                                        </li>
                                    @empty
                                        <li class="list-group-item-1 text-center">
                                            <h5 class="mb-1 text-muted">{{ __('label.notification.no_notification') }}
                                            </h5>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                            @if (count($notificationsHeader) > 0)
                                <a class="all-notification"
                                    href="{{ route('notifications') }}">{{ __('label.notification.read_all') }}
                                    <i class="ti-arrow-end"></i></a>
                            @endif
                        </div>

                    </li>

                    <li class="nav-item">
                        <div class="dropdown header-profile2">
                            <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div class="header-info2 d-flex align-items-center">
                                    <div class="d-flex align-items-center sidebar-info">
                                        <div class="d-none d-md-block">

                                            {{-- Name --}}
                                            <h5 class="mb-0">
                                                @if (Auth::guard('admin')->user()->role === ROLE_ADMIN)
                                                    {{ Str::limit(Auth::guard('admin')->user()->user_name, 20) }}
                                                @elseif (Auth::guard('admin')->user()->role === ROLE_COMPANY)
                                                    {{ Str::limit(Auth::guard('admin')->user()->company->name ?? Str::limit(Auth::guard('admin')->user()->user_name), 20) }}
                                                @elseif (Auth::guard('admin')->user()->role === ROLE_UNIVERSITY)
                                                    {{ Str::limit(Auth::guard('admin')->user()->university->name ?? Str::limit(Auth::guard('admin')->user()->user_name), 20) }}
                                                @elseif (Auth::guard('admin')->user()->role === ROLE_SUB_UNIVERSITY)
                                                    {{ Str::limit(Auth::guard('admin')->user()->user_name ?? Str::limit(Auth::guard('admin')->user()->user_name), 20) }}
                                                @elseif (Auth::guard('admin')->user()->role === ROLE_SUB_ADMIN)
                                                    {{ Str::limit(Auth::guard('admin')->user()->user_name ?? Str::limit(Auth::guard('admin')->user()->user_name), 20) }}
                                                @elseif (Auth::guard('admin')->user()->role === ROLE_HIRING)
                                                    {{ Str::limit(Auth::guard('admin')->user()->hiring->name ?? Str::limit(Auth::guard('admin')->user()->user_name), 20) }}
                                                @else
                                                    {{ Str::limit('Unknown Role', 20) }}
                                                @endif
                                            </h5>


                                            {{-- Role --}}
                                            <p class="mb-0 text-end">
                                                @if (Auth::guard('admin')->user()->role === ROLE_ADMIN)
                                                    {{ __('label.admin.admin') }}
                                                @elseif (Auth::guard('admin')->user()->role === ROLE_COMPANY)
                                                    {{ __('label.auth.page_register.company') }}
                                                @elseif (Auth::guard('admin')->user()->role === ROLE_UNIVERSITY)
                                                    {{ __('label.auth.page_register.university') }}
                                                @elseif (Auth::guard('admin')->user()->role === ROLE_SUB_ADMIN)
                                                    {{ __('label.auth.page_register.sub_admin') }}
                                                @elseif (Auth::guard('admin')->user()->role === ROLE_HIRING)
                                                    {{ __('label.admin.hiring') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Image Thumbnail --}}
                                    <img src="{{ Auth::guard('admin')->user()->role === ROLE_ADMIN
                                        ? asset('management-assets/images/no-img-avatar.png')
                                        : (Auth::guard('admin')->user()->role === ROLE_COMPANY &&
                                        optional(Auth::guard('admin')->user()->company)->avatar_path
                                            ? asset(Auth::guard('admin')->user()->company->avatar_path)
                                            : (Auth::guard('admin')->user()->role === ROLE_UNIVERSITY &&
                                            optional(Auth::guard('admin')->user()->university)->avatar_path
                                                ? asset('storage/' . Auth::guard('admin')->user()->university->avatar_path)
                                                : (Auth::guard('admin')->user()->role === ROLE_SUB_ADMIN
                                                    ? asset('management-assets/images/no-img-avatar.png')
                                                    : (Auth::guard('admin')->user()->role === ROLE_HIRING &&
                                                    optional(Auth::guard('admin')->user()->hirings)->avatar_path
                                                        ? asset(Auth::guard('admin')->user()->hirings->avatar_path)
                                                        : asset('management-assets/images/no-img-avatar.png'))))) }}"
                                        alt="avatar">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="   @if (auth('admin')->user()->role === ROLE_ADMIN) {{ route('admin.users.edit', auth('admin')->user()->id) }}
                                        @elseif (auth('admin')->user()->role === ROLE_COMPANY)
                                            {{ route('company.profile') }}

                                        @elseif (auth('admin')->user()->role === ROLE_UNIVERSITY)
                                            {{ route('university.profile') }}
                                        @elseif (auth('admin')->user()->role === ROLE_SUB_ADMIN)
                                            {{ route('admin.users.edit', auth('admin')->user()->id) }}
                                        @elseif (auth('admin')->user()->role === ROLE_HIRING) @endif"
                                    class="dropdown-item ai-icon ">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path
                                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                fill="var(--primary)" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                fill="var(--primary)" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <span class="ms-2">{{ __('label.admin.header.profile') }} </span>
                                </a>

                                <a href="{{ route('notifications') }}" class="dropdown-item ai-icon ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                fill="var(--primary)" />
                                            <circle fill="var(--primary)" opacity="0.3" cx="19.5"
                                                cy="17.5" r="2.5" />
                                        </g>
                                    </svg>
                                    <span class="ms-2">{{ __('label.admin.header.notification') }} </span>
                                </a>
                                
                                <form action="{{ route('management.logout', Auth::guard('admin')->user()->id) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item ai-icon btn-logout">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="#fd5353" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12">
                                            </line>
                                        </svg>
                                        <span class="ms-2 text-danger">{{ __('label.admin.header.logout') }}
                                        </span>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
