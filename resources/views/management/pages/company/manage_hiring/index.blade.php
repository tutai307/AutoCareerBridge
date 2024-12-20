@extends('management.layout.main')

@section('title', 'Danh sách nhân viên')

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
                                <li class="breadcrumb-item"><a href="/company">{{ __('label.company.hiring.home') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ __('label.company.hiring.employee_list') }}</li>
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
                                <i class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.company.hiring.filter') }}
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <form method="GET" action="{{ route('company.manageHiring') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 mb-3">
                                            <label class="form-label">{{ __('label.company.hiring.title_search') }}</label>
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request()->search }}" placeholder="Tìm kiếm...">
                                        </div>
                                        <div class="col-xl-2 col-sm-6">
                                            <label class="form-label">{{ __('label.company.hiring.join_date') }}</label>
                                            <div class="input-hasicon mb-sm-0 mb-3">
                                                <input type="date" name="date" class="form-control"
                                                    value="{{ request()->date }}">
                                                <div class="icon"><i class="far fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 align-self-end mb-3">
                                            <button class="btn btn-primary me-2" title="Click here to Search"
                                                type="submit">
                                                <i
                                                    class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.company.hiring.filter') }}
                                            </button>
                                            <button class="btn btn-danger light" title="Click here to remove filter"
                                                type="button"
                                                onclick="window.location.href='{{ route('company.manageHiring') }}'">
                                                {{ __('label.company.hiring.clear_filter') }}
                                            </button>
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
                        <div style="margin-bottom: -50px" class="card-header border-0 pb-2 d-flex justify-content-between">
                            <h2 class="card-title">{{ __('label.company.hiring.employee_list') }}</h2>
                            <a href="{{ route('company.create') }}"
                                class="btn btn-primary">{{ __('label.company.hiring.create') }}</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body p-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm mb-0 table-striped order-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>{{ __('label.company.hiring.name') }}</th>
                                                                    <th>{{ __('label.company.hiring.image') }}</th>
                                                                    <th>{{ __('label.company.hiring.user_name') }}</th>
                                                                    <th>Email</th>
                                                                    <th>{{ __('label.company.hiring.phone') }}</th>
                                                                    <th>{{ __('label.company.hiring.create_at') }}</th>
                                                                    <th>{{ __('label.company.hiring.action') }}</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="customers">
                                                                @forelse($hirings as $hiring)
                                                                    <tr class="btn-reveal-trigger">
                                                                        <td><strong>{{ $loop->iteration + ($hirings->currentPage() - 1) * $hirings->perPage() }}</strong>
                                                                        </td>
                                                                        <td class="py-2">{!! wordwrap($hiring->name, 30, '<br>', true) !!}</td>
                                                                        @if ($hiring->avatar_path)
                                                                            <td><img class="rounded-circle" width="45"
                                                                                    height="45"
                                                                                    style="object-fit: cover; object-position: center;"
                                                                                    src=" {{ asset('storage/' . $hiring->avatar_path) }}"
                                                                                    alt=""></td>
                                                                        @else
                                                                            <td><img class="rounded-circle" width="45"
                                                                                    height="45"
                                                                                    src=" {{ asset('management-assets/images/no-img-avatar.png') }}">
                                                                            </td>
                                                                        @endif
                                                                        <td class="py-2">{!! wordwrap($hiring->user->user_name, 30, '<br>', true) !!}
                                                                        </td>
                                                                        <td class="py-2">{!! wordwrap( $hiring->user->email, 30, '<br>', true) !!}</td>
                                                                        <td class="py-2">{{ $hiring->phone }}</td>
                                                                        <td class="py-2">
                                                                            {{ $hiring->user->created_at->format('d/m/Y') }}
                                                                        </td>
                                                                        <td class="py-2 text-end">
                                                                            <div class="ms-auto">
                                                                                <a href="{{ route('company.editHiring', $hiring->user_id) }}"
                                                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                                        class="fa fa-pencil"></i></a>

                                                                                <form
                                                                                    action="{{ route('company.deleteHiring', $hiring->user->id) }}"
                                                                                    method="POST" style="display:inline;"
                                                                                    class="delete-form">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="button"
                                                                                        class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                                                        data-id="{{ $hiring->user->id }}">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </button>
                                                                                </form>

                                                                            </div>
                                                                        </td>

                                                                    @empty
                                                                        <td colspan="8" class="text-center">Không có dữ
                                                                            liệu</td>
                                                                @endforelse



                                                            </tbody>
                                                        </table>
                                                        <div class="d-flex justify-content-center align-items-center mt-3">
                                                            <div class="dataTables_paginate">
                                                                {{ $hirings->appends(request()->query())->links() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                </div>
                                </table>

                            </div>
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
            })
        });
    </script>
    <script>
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            let form = $(this).closest('.delete-form');
            Swal.fire({
                title: "{{ __('label.university.delete_confirm') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "{{ __('label.university.delete') }}",
                cancelButtonText: "{{ __('label.university.cancel') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
