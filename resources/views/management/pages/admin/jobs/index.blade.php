@extends('management.layout.main')

@section('title', 'Danh sách bài đăng')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('label.admin.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('label.admin.sidebar.manager_job') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="filter cm-content-box box-primary">
                <div class="content-title SlideToolHeader">
                    <div class="cpa">
                        <i class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.admin.filter') }}
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="handle expand"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt" style="">
                    <form method="GET" action="{{ route('admin.jobs.index') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6">
                                    <label class="form-label">{{ __('label.admin.job.job_company_name') }}</label>
                                    <input type="text" class="form-control mb-xl-0 mb-3" name="search"
                                        value="{{ request()->search }}" placeholder="{{ __('label.admin.search') }}">
                                </div>

                                <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                    <label class="form-label">{{ __('label.admin.job.status') }}</label>
                                    <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                        <select name="status" class="form-control default-select h-auto wide">
                                            <option value="" @if (request()->status == '') selected @endif>
                                                {{ __('label.admin.job.select_status') }}</option>
                                            <option value="{{ STATUS_PENDING }}"
                                                @if (request()->status == STATUS_PENDING) selected @endif>
                                                {{ __('label.admin.job.pending') }}</option>
                                            <option value="{{ STATUS_APPROVED }}"
                                                @if (request()->status == STATUS_APPROVED) selected @endif>
                                                {{ __('label.admin.job.approved') }}</option>
                                            <option value="{{ STATUS_REJECTED }}"
                                                @if (request()->status == STATUS_REJECTED) selected @endif>
                                                {{ __('label.admin.job.rejected') }}</option>
                                        </select>

                                        <div class="dropdown-menu ">
                                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                    <label class="form-label">{{ __('label.admin.job.major') }}</label>
                                    <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                        <select name="major" class="form-control default-select h-auto wide">
                                            <option value="" @if ('' == request()->major) selected @endif>
                                                {{ __('label.admin.job.select_major') }}</option>
                                            @foreach ($majors as $major)
                                                <option value="{{ $major->id }}"
                                                    @if ($major->id == request()->major) selected @endif>{{ $major->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="dropdown-menu ">
                                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-6 align-self-end">
                                    <div>
                                        <button class="btn btn-primary me-2" title="Click here to Search" type="submit">
                                            <i class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.admin.filter') }}
                                        </button>
                                        <button class="btn btn-danger light" title="Click here to remove filter"
                                            type="button"
                                            onclick="window.location.href='{{ route('admin.jobs.index') }}'">
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('label.admin.job.title_list') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>{{ __('label.admin.job.title') }}</th>
                                    <th>{{ __('label.admin.company') }}</th>
                                    <th>{{ __('label.admin.job.major') }}</th>
                                    <th>{{ __('label.admin.job.created_at') }}</th>
                                    <th>{{ __('label.admin.job.status') }}</th>
                                    <th>{{ __('label.admin.job.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($jobs->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            {{ __('label.admin.job.no_job') }}
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($jobs as $index => $job)
                                    <tr>
                                        <td><strong>{{ $index + 1 + ($jobs->currentPage() - 1) * $jobs->perPage() }}</strong>
                                        </td>
                                        <td>
                                            <span class="w-space-no">{{ $job->name }}</span>
                                        </td>

                                        <td>{{ $job->user->hiring->company->name ?? $job->user->company->name }}</td>
                                        <td>{{ $job->major->name }}</td>
                                        <td>{{ $job->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            @if ($job->status == STATUS_PENDING)
                                                <span class="badge bg-warning">{{ __('label.admin.job.pending') }}</span>
                                            @elseif($job->status == STATUS_APPROVED)
                                                <span class="badge bg-success">{{ __('label.admin.job.approved') }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ __('label.admin.job.rejected') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <a href="#btn-show-details" class="btn btn-primary shadow btn-xs btn-show-details"
                                                    data-slug="{{ $job->slug }}">
                                                    <i class="fa-solid fa-file-alt"></i> {{ __('label.admin.job.detail') }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    @if ($jobs->lastPage() > 1)
                        {{ $jobs->links() }}
                    @endif
                </div>

            </div>
        </div>
    </div>
    <!-- Modal toàn màn hình với các trường đều 2 bên -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 80%;"> <!-- Đặt chiều rộng tối đa là 80% -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">{{ __('label.admin.job.detail_job') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailsModalBody">
                    <!-- Form bên trong modal -->
                    <form action="{{ route('admin.jobs.updateStatus') }}" id="jobForm" method="POST">

                    </form>
                </div>
                <div class="modal-footer" id="buttonSubmit">
                    <button type="button" class="btn btn-primary" data-status='2' id="btnSubmit">{{ __('label.admin.job.approve') }}</button>
                    <button type="button" class="btn btn-danger" data-status='3' id="btnReject">{{ __('label.admin.job.reject') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bắt sự kiện khi nhấn vào nút "Chi tiết"
            document.querySelectorAll('.btn-show-details').forEach(function(button) {
                button.addEventListener('click', function() {
                    var jobSlug = this.getAttribute(
                        'data-slug'); // Lấy slug của bài đăng từ thuộc tính data-slug
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
                    // Gửi yêu cầu Fetch đến server để lấy chi tiết bài đăng dựa trên slug
                    fetch(`{{ route('admin.jobs.slug', ':slug') }}`.replace(':slug', jobSlug))
                        .then(function(response) {
                            return response.json(); // Chuyển đổi kết quả thành JSON
                        })
                        .then(function(data) {
                            $("#detailsModal #jobForm").html(data.html);

                            if (data.status !== 1) {
                                $("#detailsModal #buttonSubmit").hide();
                            }else{
                                $("#detailsModal #buttonSubmit").show();
                            }

                            $('#detailsModal').modal('show');
                        })
                        .catch(function(error) {
                            console.error('Error:', error);

                            Toast.fire({
                                icon: "error",
                                title: "Không tìm thấy bài tuyển dụng."
                            });
                        });
                });
            });

            function submitForm(vl) {
                let form = document.getElementById('jobForm');
                document.querySelector('#jobForm input[name="status"]').value = vl;
                form.submit(); // Gửi form
            }

            document.getElementById('btnSubmit').addEventListener('click', function(e) {
                submitForm(e.target.getAttribute('data-status'));
            })

            document.getElementById('btnReject').addEventListener('click', function(e) {
                submitForm(e.target.getAttribute('data-status'));
            });
        });
    </script>
@endsection
