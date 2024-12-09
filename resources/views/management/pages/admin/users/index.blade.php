@extends('management.layout.main')

@section('title', __('label.admin.user.title_list'))

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">{{  __('label.admin.home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('label.admin.user.title_list') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.admin.filter') }}
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <form method="GET" action="{{ route('admin.users.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6">
                                            <label class="form-label">{{  __('label.admin.user.user_name_or_email') }}</label>
                                            <input type="text" class="form-control mb-xl-0 mb-3" name="search"
                                                value="{{ request()->search }}" placeholder="{{  __('label.admin.search') }}">
                                        </div>

                                        <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                            <label class="form-label">{{  __('label.admin.user.role') }}</label>
                                            <select name="role" class="form-control default-select h-auto wide" placeholder="{{  __('label.admin.user.select_role') }}">
                                                <option value="{{ ROLE_SUB_ADMIN }}"
                                                    {{ request()->role == ROLE_SUB_ADMIN ? 'selected' : '' }}>Sub Admin
                                                </option>
                                                <option value="{{ ROLE_UNIVERSITY }}"
                                                    {{ request()->role == ROLE_UNIVERSITY ? 'selected' : '' }}>{{ __('label.admin.user.university') }}</option>
                                                <option value="{{ ROLE_COMPANY }}"
                                                    {{ request()->role == ROLE_COMPANY ? 'selected' : '' }}>{{ __('label.admin.user.company') }}</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                            <label class="form-label">{{ __('label.admin.user.status') }}</label>
                                            <select name="active" class="form-control default-select h-auto wide" placeholder="{{ __('label.admin.user.select_status') }}">
                                                <option value="{{ ACTIVE }}"
                                                    {{ request()->active == ACTIVE ? 'selected' : '' }}>{{ __('label.admin.user.active') }}
                                                </option>
                                                <option value="{{ INACTIVE }}"
                                                    {{ (int) request()->active === INACTIVE ? 'selected' : '' }}>{{ __('label.admin.user.inactive') }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                            <label
                                                class="form-label">{{ __('label.admin.user.join_date') }}</label>
                                            <input type="text" id="dateRangePicker" class="form-control"
                                                name="date_range"
                                                placeholder="{{ __('label.university.student.select_entry_graduation_year_range') }}"
                                                style="background-color: #fff"
                                                value="{{ request()->date_range }}">
                                        </div>

                                        <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0 d-flex align-items-end">
                                            <div>
                                                <button class="btn btn-primary me-2" title="Click here to Search"
                                                    type="submit">
                                                    <i class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.admin.filter') }}
                                                </button>
                                                <button class="btn btn-danger light" title="Click here to remove filter"
                                                    type="button"
                                                    onclick="window.location.href='{{ route('admin.users.index') }}'">
                                                    {{ __('label.admin.clear_filter') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card quick_payment">
                        <div class="card-header border-0 pb-2 d-flex justify-content-between">
                            <h2 class="card-title">{{ __('label.admin.user.title_list') }}</h2>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">{{ __('label.admin.add_new') }}</a>
                        </div>
                        <div class="card-body p-0">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{  __('label.admin.user.user_name') }}</th>
                                                <th>Email</th>
                                                <th>{{  __('label.admin.user.role') }}</th>
                                                <th>{{  __('label.admin.user.status') }}</th>
                                                <th>{{  __('label.admin.user.join_date') }}</th>
                                                <th>{{  __('label.admin.user.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($users))
                                                @forelse ($users as $user)
                                                    <tr>
                                                        <td><strong>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</strong>
                                                        </td>
                                                        <td>
                                                            <span class="w-space-no">{{ $user->user_name }}</span>
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            @if ($user->role == ROLE_SUB_ADMIN)
                                                                <span class="badge bg-info">{{ __('label.admin.user.sub_admin') }}</span>
                                                            @elseif($user->role == ROLE_UNIVERSITY)
                                                                <span class="badge bg-secondary">{{  __('label.admin.user.university') }}</span>
                                                            @elseif($user->role == ROLE_COMPANY)
                                                                <span class="badge bg-warning">{{__('label.admin.user.company')}}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                @if ($user->active == ACTIVE)
                                                                    <button class="btn btn-sm btn-success 
                                                                    @if (\Auth::guard('admin')->user()->role == ROLE_ADMIN || (\Auth::guard('admin')->user()->role == ROLE_SUB_ADMIN && $user->role != ROLE_ADMIN && $user->role != ROLE_SUB_ADMIN))
                                                                        btn-toggle-status
                                                                    @endif
                                                                    " data-id="{{ $user->id }}" data-status="inactive">{{ __('label.admin.user.active') }}</button>
                                                                @else
                                                                    <button class="btn btn-sm btn-danger
                                                                    @if (\Auth::guard('admin')->user()->role == ROLE_ADMIN || (\Auth::guard('admin')->user()->role == ROLE_SUB_ADMIN && $user->role != ROLE_ADMIN && $user->role != ROLE_SUB_ADMIN))
                                                                        btn-toggle-status
                                                                    @endif
                                                                    " data-id="{{ $user->id }}" data-status="active">{{ __('label.admin.user.inactive') }}</button>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ $user->created_at ? $user->created_at->format('d/m/Y') : '' }}
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                                    class="btn btn-primary shadow btn-xs sharp me-1 
                                                                    @php
                                                                        if (\Auth::guard('admin')->user()->role == ROLE_SUB_ADMIN && $user->role == ROLE_SUB_ADMIN || $user->role == ROLE_ADMIN) {
                                                                            echo 'd-none';
                                                                        }
                                                                    @endphp
                                                                     "><i
                                                                        class="fa fa-pencil"></i></a>
                                                                <form action="{{ route('admin.users.destroy', $user) }}"
                                                                    method="POST" style="display:inline;"
                                                                    class="delete-form 
                                                                    @php
                                                                        if (\Auth::guard('admin')->user()->role == ROLE_SUB_ADMIN && $user->role == ROLE_SUB_ADMIN || $user->role == ROLE_ADMIN) {
                                                                            echo 'd-none';
                                                                        }
                                                                    @endphp
                                                                    ">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                                        data-id="{{ $user->id }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">{{  __('label.admin.user.no_user') }}</td>
                                                    </tr>
                                                @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                {{ $users->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#dateRangePicker", {
                mode: "range",
                dateFormat: "d/m/Y",
                locale: "vn",
                monthSelectorType: "static",
                onClose: function(selectedDates, dateStr, instance) {
                    document.getElementById('dateRangePicker').value = dateStr;
                }
            });
        });

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            let form = $(this).closest('.delete-form');
            Swal.fire({
                title: "{{ __('label.admin.delete_confirm') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "{{ __('label.admin.delete') }}",
                cancelButtonText: "{{ __('label.admin.cancel') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        $(document).on('click', '.btn-toggle-status', function () {
            let button = $(this);
            let userId = button.data('id');
            let currentStatus = button.data('status');

            $.ajax({
                url: '{{ route('admin.user.toggleStatus') }}',
                type: 'POST',
                data: {
                    id: userId,
                    status: currentStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        if (response.new_status === 'active') {
                            button.removeClass('btn-danger').addClass('btn-success')
                                .text('{{ __('label.admin.user.active') }}')
                                .data('status', 'inactive');
                        } else {
                            button.removeClass('btn-success').addClass('btn-danger')
                                .text('{{ __('label.admin.user.inactive') }}')
                                .data('status', 'active');
                        }
                    }
                },
                error: function () {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
        });
    </script>
@endsection
