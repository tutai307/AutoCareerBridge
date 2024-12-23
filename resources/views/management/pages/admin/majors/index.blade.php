@extends('management.layout.main')

@section('title', 'Danh sách chuyên ngành')

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.home') }}">{{ __('label.admin.home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ __('label.admin.majors.list_majors') }}</li>
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
                            <form method="GET" action="{{ route('admin.majors.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6">
                                            <label class="form-label">{{ __('label.admin.majors.name_major') }}</label>
                                            <input type="text" class="form-control mb-xl-0" name="search"
                                                value="{{ request()->search }}"
                                                placeholder="{{ __('label.admin.search') }}">
                                        </div>

                                        @empty(!$fields)
                                            <div class="col-xl-3 col-sm-6">
                                                <label class="form-label">{{ __('label.admin.fields.name_field') }}</label>
                                                <select name="field" class="form-control default-select h-auto wide"
                                                    placeholder="">
                                                    <option value="" selected>{{ __('label.admin.majors.select_field') }}
                                                    </option>
                                                    @foreach ($fields as $field)
                                                        <option value="{{ $field->id }}"
                                                            {{ request()->field == $field->id ? 'selected' : '' }}>
                                                            {{ $field->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endempty

                                        <div class="col-xl-3 col-sm-6 align-self-end">
                                            <button class="btn btn-primary me-2" title="Click here to Search"
                                                type="submit">
                                                <i
                                                    class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.admin.filter') }}
                                            </button>
                                            <button class="btn btn-danger light" title="Click here to remove filter"
                                                type="button"
                                                onclick="window.location.href='{{ route('admin.majors.index') }}'">
                                                {{ __('label.admin.clear_filter') }}
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
                        <div class="card-header border-0 pb-2 d-flex justify-content-between">
                            <h2 class="card-title">{{ __('label.admin.majors.list_majors') }}</h2>
                            <a href="{{ route('admin.majors.create') }}"
                                class="btn btn-primary">{{ __('label.admin.add_new') }}</a>
                        </div>
                        <div class="card-body p-0">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('label.admin.majors.name_major') }}</th>
                                                <th>{{ __('label.admin.fields.name_field') }}</th>
                                                <th>{{ __('label.admin.majors.description') }}</th>
                                                <th>{{ __('label.admin.majors.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($majors)
                                                @forelse ($majors as $item)
                                                    <tr>
                                                        <td><strong>{{ $loop->iteration + ($majors->currentPage() - 1) * $majors->perPage() }}</strong>
                                                        </td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->field->name ?? '' }}</td>
                                                        </td>

                                                        <td>
                                                            {!! Str::limit($item->description, 80) ?? '' !!}
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <a href="{{ route('admin.majors.edit', $item->id) }}"
                                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                        class="fa fa-pencil"></i></a>
                                                                <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"
                                                                    data-type="DELETE"
                                                                    data-message="{{ __('label.delete_confirm') }}"
                                                                    data-irreversible_action="{{ __('label.irreversible_action') }}"
                                                                    data-delete="{{ __('label.delete') }}"
                                                                    data-cancel="{{ __('label.cancel') }}"
                                                                    href="javascript:void(0)"
                                                                    data-url="{{ route('admin.majors.destroy', ['major' => $item->id]) }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Không có chuyên ngành nào.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    {{ $majors->links('pagination::bootstrap-4') }}
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
    <script>
        $(document).on('click', '.btn_change_status', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let url = $(this).data('url');
            let thisBtn = $(this);

            Swal.fire({
                title: "Bạn có muốn duyệt không ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Chấp nhận",
                cancelButtonText: "Từ chối",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'patch',
                            id: id,
                            confirm: 'accept'
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                thisBtn.removeClass('btn-warning btn-danger btn_change_status')
                                    .addClass('btn-success').text(response.text_status);

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: response.message
                                });
                            }
                        }
                    });
                } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'patch',
                            id: id,
                            confirm: 'reject'
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                thisBtn.removeClass('btn-warning btn-success btn_change_status')
                                    .addClass('btn-danger').text(response.text_status);

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: response.message
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
