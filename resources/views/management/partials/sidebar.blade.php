<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">

            {{-- Admin --}}
            @if (auth('admin')->user()->role == ROLE_ADMIN)
                <li>
                    <a href="{{ route('admin.home') }}" aria-expanded="false">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">{{ __('label.admin.sidebar.dashboard') }}</span>
                    </a>
                </li>
                <li {{ request()->routeIs('admin.jobs.index') ? 'class=mm-active' : '' }}>
                    <a href="{{ route('admin.jobs.index') }}" aria-expanded="false">
                        <i class="fa-solid fa-briefcase"></i>
                        <span class="nav-text">{{ __('label.admin.sidebar.manager_job') }}</span>
                    </a>
                </li>
                <li {{ request()->routeIs('admin.workshops.index') ? 'class=mm-active' : '' }}>
                    <a href="{{ route('admin.workshops.index') }}" aria-expanded="false">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                        <span class="nav-text">{{ __('label.admin.sidebar.workshops') }}</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-users"></i>
                        <span class="nav-text">{{ __('label.admin.sidebar.manager_user') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.users.index') }}">{{ __('label.admin.sidebar.list') }}</a></li>
                        <li><a href="{{ route('admin.users.create') }}">{{ __('label.admin.sidebar.create') }}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <span class="nav-text">Lĩnh vực</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.fields.index') }}">Danh sách</a></li>
                        <li><a href="{{ route('admin.fields.create') }}">Thêm mới</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-book"></i>
                        <span class="nav-text">Chuyên ngành</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.majors.index') }}">Danh sách</a></li>
                        <li><a href="{{ route('admin.majors.create') }}">Thêm mới</a></li>
                    </ul>
                </li>
            @endif

            {{-- Sub Admin --}}
            @if (auth('admin')->user()->role == ROLE_SUB_ADMIN)
                <li>
                    <a href="{{ route('admin.home') }}" aria-expanded="false">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.jobs.index') }}" aria-expanded="false">
                        <i class="fa-solid fa-briefcase"></i>
                        <span class="nav-text">Bài tuyển dụng</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.workshops.index') }}" aria-expanded="false">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                        <span class="nav-text">Workshops</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-users"></i>
                        <span class="nav-text">Role SUB ADMIN</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">Danh sách</a></li>
                        <li><a href="#">Thêm mới</a></li>
                    </ul>
                </li>
            @endif

            {{-- University --}}
            @if (auth('admin')->user()->role == ROLE_UNIVERSITY)
                <li>
                    <a href="{{ route('company.home') }}" aria-expanded="false">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">Thống kê</span>
                    </a>
                </li>
                <li class="{{ request()->is('university/academic-affairs*') ? 'mm-active' : '' }}">
                    <a href="{{ route('university.academicAffairs') }}" aria-expanded="false">
                        <i class="fa-solid fa-users"></i>
                        <span class="nav-text">Quản lí giáo vụ</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('university.collaboration') }}" aria-expanded="false">
                        <i class="fas fa-handshake"></i>
                        <span class="nav-text">Quản lý hợp tác</span>
                    </a>
                </li>
                <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-users"></i>
                        <span class="nav-text">{{ __('label.university.sidebar.manager_student') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('university.students.index') }}">{{ __('label.university.list') }}</a>
                        </li>
                        <li><a
                                href="{{ route('university.students.create') }}">{{ __('label.university.add_new') }}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                        <span class="nav-text">QL workshop</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('university.workshop.index') }}">Danh sách</a></li>
                        <li><a href="{{ route('university.workshop.create') }}">Thêm mới</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-book"></i>
                        <span class="nav-text">QL chuyên ngành</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('university.majors.index') }}">Danh sách</a></li>
                        <li><a href="{{ route('university.majors.create') }}">Thêm mới</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('university.jobs.applied') }}" aria-expanded="false">
                        <i class="fa-solid fa-briefcase"></i>
                        <span class="nav-text">{{ __('label.university.sidebar.jobs_applied')}}</span>
                    </a>
                </li>
            @endif

            {{-- Sub University --}}
            @if (auth('admin')->user()->role == ROLE_SUB_UNIVERSITY)
                <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-users"></i>
                        <span class="nav-text">{{ __('label.university.sidebar.manager_student') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('university.students.index') }}">{{ __('label.university.list') }}</a>
                        </li>
                        <li><a
                                href="{{ route('university.students.create') }}">{{ __('label.university.add_new') }}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-book"></i>
                        <span class="nav-text">QL chuyên ngành</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('university.majors.index') }}">Danh sách</a></li>
                        <li><a href="{{ route('university.majors.create') }}">Thêm mới</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                        <span class="nav-text">QL workshop</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('university.workshop.index') }}">Danh sách</a></li>
                        <li><a href="{{ route('university.workshop.create') }}">Thêm mới</a></li>
                    </ul>
                </li>
            @endif

            {{-- Company --}}
            @if (auth('admin')->user()->role == ROLE_COMPANY)
                <li>
                    <a href="{{ route('company.home') }}" aria-expanded="false">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">Thống kê</span>
                    </a>
                </li>
                <li class="{{ request()->is('company/manage-hiring*') ? 'mm-active' : '' }}">
                    <a href="{{ route('company.manageHiring') }}" aria-expanded="false">
                        <i class="material-icons">group</i>
                        <span class="nav-text">Quản lý nhân viên</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('company.collaboration') }}" aria-expanded="false">
                        <i class="fas fa-handshake"></i>
                        <span class="nav-text">Quản lý hợp tác</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('company.searchUniversity') }}" aria-expanded="false">
                        <i class="material-icons">search</i>
                        <span class="nav-text">Tìm kiếm trường học</span>
                    </a>
                </li> --}}
                {{--
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-book"></i>
                        <span class="nav-text">Chuyên ngành</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('company.majorCompany') }}">Danh sách</a></li>
                        <li><a href="{{ route('company.createMajorCompany') }}">Thêm mới</a></li>
                    </ul>
                </li> --}}

                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-briefcase"></i>
                        <span class="nav-text">{{ __('label.company.sidebar.job') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('company.manageJob') }}">{{ __('label.company.sidebar.list') }}</a>
                        </li>
                        <li><a href="{{ route('company.createJob') }}">{{ __('label.company.sidebar.create') }}</a>
                        </li>

                    </ul>
                </li>
            @endif

            {{-- Hiring --}}
            @if (auth('admin')->user()->role == ROLE_HIRING)
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-users"></i>
                        <span class="nav-text"> {{ __('label.company.sidebar.business_staff') }} </span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">{{ __('label.company.sidebar.list') }}</a></li>
                        <li><a href="#">{{ __('label.company.sidebar.create') }}</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-briefcase"></i>
                        <span class="nav-text">{{ __('label.company.sidebar.job') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('company.manageJob') }}">{{ __('label.company.sidebar.list') }}</a>
                        </li>
                        <li><a href="{{ route('company.createJob') }}">{{ __('label.company.sidebar.create') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
    </div>
</div>
