<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">

            {{-- Admin --}}
            @if (auth('admin')->user()->role == ROLE_ADMIN)
                <li class="{{ request()->segment(2) == 'home' ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.home') }}" aria-expanded="false">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">{{ __('label.admin.sidebar.dashboard') }}</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) == 'jobs' ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.jobs.index') }}" aria-expanded="false">
                        <i class="fa-solid fa-briefcase"></i>
                        <span class="nav-text">{{ __('label.admin.sidebar.manager_job') }}</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) == 'workshops' ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.workshops.index') }}" aria-expanded="false">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                        <span class="nav-text">{{ __('label.admin.sidebar.workshops') }}</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) == 'users' ? 'mm-active' : '' }}">
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
                <li class="{{ request()->segment(2) == 'fields' ? 'mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <span class="nav-text">{{ __('label.admin.sidebar.manager_field') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.fields.index') }}">{{ __('label.admin.sidebar.list') }}</a></li>
                        <li><a href="{{ route('admin.fields.create') }}">{{ __('label.admin.sidebar.create') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->segment(2) == 'majors' ? 'mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-book"></i>
                        <span class="nav-text">{{ __('label.admin.sidebar.manager_major') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.majors.index') }}">{{ __('label.admin.sidebar.list') }}</a></li>
                        <li><a href="{{ route('admin.majors.create') }}">{{ __('label.admin.sidebar.create') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- Sub Admin --}}
            @if (auth('admin')->user()->role == ROLE_SUB_ADMIN)
                <li class="{{ request()->segment(2) == 'home' ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.home') }}" aria-expanded="false">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">{{ __('label.admin.sidebar.dashboard') }}</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) == 'jobs' ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.jobs.index') }}" aria-expanded="false">
                        <i class="fa-solid fa-briefcase"></i>
                        <span class="nav-text">{{ __('label.admin.sidebar.manager_job') }}</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) == 'workshops' ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.workshops.index') }}" aria-expanded="false">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                        <span class="nav-text">{{ __('label.admin.sidebar.workshops') }}</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) == 'fields' ? 'mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <span class="nav-text">{{ __('label.admin.sidebar.manager_field') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.fields.index') }}">{{ __('label.admin.sidebar.list') }}</a></li>
                        <li><a href="{{ route('admin.fields.create') }}">{{ __('label.admin.sidebar.create') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->segment(2) == 'majors' ? 'mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-book"></i>
                        <span class="nav-text">{{ __('label.admin.sidebar.manager_major') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.majors.index') }}">{{ __('label.admin.sidebar.list') }}</a></li>
                        <li><a href="{{ route('admin.majors.create') }}">{{ __('label.admin.sidebar.create') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- University --}}
            @if (auth('admin')->user()->role == ROLE_UNIVERSITY)
                <li>
                    <a href="{{ route('university.home') }}" aria-expanded="false">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">{{ __('label.university.sidebar.dashboard') }}</span>
                    </a>
                </li>
                <li class="{{ request()->is('university/academic-affairs*') ? 'mm-active' : '' }}">
                    <a href="{{ route('university.academicAffairs') }}" aria-expanded="false">
                        <i class="fa-solid fa-users"></i>
                        <span class="nav-text">{{ __('label.university.sidebar.manage_academic') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('university.collaboration') }}" aria-expanded="false">
                        <i class="fas fa-handshake"></i>
                        <span class="nav-text">{{ __('label.university.sidebar.colab_manager') }}</span>
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
                        <span class="nav-text">{{ __('label.university.sidebar.manage_workshop') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('university.workshop.index') }}">{{ __('label.university.list') }}</a>
                        </li>
                        <li><a
                                href="{{ route('university.workshop.create') }}">{{ __('label.university.add_new') }}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-book"></i>
                        <span class="nav-text">{{ __('label.university.sidebar.manage_major') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('university.majors.index') }}">{{ __('label.university.list') }}</a>
                        </li>
                        <li><a
                                href="{{ route('university.majors.create') }}">{{ __('label.university.add_new') }}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('university.jobs.applied') }}" aria-expanded="false">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                        <span class="nav-text">{{ __('label.university.sidebar.jobs_applied') }}</span>
                    </a>
                </li>
                <li class="{{ request()->is('university/manage-company-workshop*') ? 'mm-active' : '' }}">
                    <a href="{{ route('university.manageCompanyWorkshop') }}?tab=pending" aria-expanded="false"> <i
                            class="fa-solid fa-clipboard-list"></i>
                        <span class="nav-text">{{ __('label.university.sidebar.manage_workshop_applied') }}</span>
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
                        <span class="nav-text">{{ __('label.university.sidebar.manage_major') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('university.majors.index') }}">{{ __('label.university.list') }}</a>
                        </li>
                        <li><a
                                href="{{ route('university.majors.create') }}">{{ __('label.university.add_new') }}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                        <span class="nav-text">{{ __('label.university.sidebar.manage_workshop') }}</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('university.workshop.index') }}">{{ __('label.university.list') }}</a>
                        </li>
                        <li><a
                                href="{{ route('university.workshop.create') }}">{{ __('label.university.add_new') }}</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('university/manage-company-workshop*') ? 'mm-active' : '' }}">
                    <a href="{{ route('university.manageCompanyWorkshop') }}?tab=pending" aria-expanded="false"> <i
                            class="fa-solid fa-clipboard-list"></i>
                        <span class="nav-text">{{ __('label.university.sidebar.manage_workshop_applied') }}</span>
                    </a>
                </li>
            @endif

            {{-- Company --}}
            @if (auth('admin')->user()->role == ROLE_COMPANY)
                <li>
                    <a href="{{ route('company.home') }}" aria-expanded="false">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">{{ __('label.company.sidebar.dashboard') }}</span>
                    </a>
                </li>
                <li class="{{ request()->is('company/manage-hiring*') ? 'mm-active' : '' }}">
                    <a href="{{ route('company.manageHiring') }}" aria-expanded="false">
                        <i class="material-icons">group</i>
                        <span class="nav-text">{{ __('label.company.sidebar.manage_hiring') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('company.collaboration') }}" aria-expanded="false">
                        <i class="fas fa-handshake"></i>
                        <span class="nav-text">{{ __('label.company.sidebar.manage_collaboration') }}</span>
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

                <li class="{{ request()->is('company/manage-university-job*') ? 'mm-active' : '' }}">
                    <a href="{{ route('company.manageUniversityJob') }}?tab=pending" aria-expanded="false"> <i
                            class="fa-solid fa-clipboard-list"></i>
                        <span class="nav-text">{{ __('label.company.sidebar.manage_applied_jobs') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('company.workshops.applied') }}" aria-expanded="false">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                        <span class="nav-text">{{ __('label.company.sidebar.manage_workshop') }}</span>
                    </a>
                </li>
            @endif

            {{-- Hiring --}}
            @if (auth('admin')->user()->role == ROLE_HIRING)
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
                <li class="{{ request()->is('company/manage-university-job*') ? 'mm-active' : '' }}">
                    <a href="{{ route('company.manageUniversityJob') }}?tab=pending" aria-expanded="false"> <i
                            class="fa-solid fa-clipboard-list"></i>
                        <span class="nav-text">Quản lý công việc được ứng tuyển</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('company.workshops.applied') }}" aria-expanded="false">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                        <span class="nav-text">Bài workshop đã ứng tuyển</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
