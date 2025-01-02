@extends('management.layout.main')

@section('title', __('label.company.job.about'))

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"> {{ __('label.company.job.home') }} </a></li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ __('label.company.job.about') }} </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="filter cm-content-box box-primary">
                <div class="content-title SlideToolHeader">
                    <div class="cpa">
                        <i class="fa-sharp fa-solid fa-filter me-2"></i> {{ __('label.company.job.filter') }}
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="handle expand"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt" style="">
                    <form method="GET" action="{{ route('company.manageJob') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6">
                                    <label class="form-label"> {{ __('label.company.job.title_search') }} </label>
                                    <input type="text" class="form-control mb-xl-0 mb-3" name="search"
                                        value="{{ request()->search }}"
                                        placeholder="{{ __('label.company.job.filter') }}...">
                                </div>

                                <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                    <label class="form-label"> {{ __('label.company.job.status') }} </label>
                                    <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                        <select name="status" class="form-control default-select h-auto wide"
                                            placeholder="{{ __('label.company.job.select_status') }}">
                                            <option value="{{ STATUS_PENDING }}"
                                                @if (request()->status == STATUS_PENDING) selected @endif>
                                                {{ __('label.company.job.pending') }}
                                            </option>
                                            <option value="{{ STATUS_APPROVED }}"
                                                @if (request()->status == STATUS_APPROVED) selected @endif>
                                                {{ __('label.company.job.approved') }}
                                            </option>
                                            <option value="{{ STATUS_REJECTED }}"
                                                @if (request()->status == STATUS_REJECTED) selected @endif>
                                                {{ __('label.company.job.refused') }}
                                            </option>
                                        </select>

                                        <div class="dropdown-menu ">
                                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                    <label class="form-label"> {{ __('label.company.job.major') }} </label>
                                    <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                        <select name="major" class="form-control default-select h-auto wide"
                                            placeholder="{{ __('label.company.job.select_major') }}">
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

                                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-sm-3 align-self-end">
                                    <div>
                                        <button class="btn btn-primary me-2" title="Click here to Search" type="submit">
                                            <i class="fa-sharp fa-solid fa-filter me-2"></i>
                                            {{ __('label.company.job.filter') }}
                                        </button>
                                        <button class="btn btn-danger light" title="Click here to remove filter"
                                            type="button"
                                            onclick="window.location.href='{{ route('company.manageJob') }}'">
                                            {{ __('label.company.job.clear_filter') }}
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
                    <h4 class="card-title">{{ __('label.company.job.about') }}</h4>
                    <a href="{{ route('company.createJob') }}"
                        class="btn btn-primary">{{ __('label.company.job.create') }}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ __('label.company.job.title') }} </th>
                                    <th> {{ __('label.company.job.author') }} </th>
                                    <th> {{ __('label.company.job.required_major') }} </th>
                                    <th> {{ __('label.company.job.posting_date') }} </th>
                                    <th> {{ __('label.company.job.expiration_date') }} </th>
                                    <th class="text-center"> {{ __('label.company.job.status') }} </th>
                                    <th class="text-center"> {{ __('label.company.job.action') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($jobs))
                                    @forelse ($jobs as $index => $job)
                                        <tr>
                                            <td><strong>{{ $loop->iteration + ($jobs->currentPage() - 1) * $jobs->perPage() }}</strong>
                                            </td>
                                            <td>
                                                <span class="w-space-no">{{ $job->name }}</span>
                                            </td>
                                            <td>{{ $job->user->hiring ? $job->user->hiring->name : $job->user->company->name ?? '' }}
                                            </td>
                                            <td>{{ $job->major->name }}</td>
                                            <td>
                                                {{ $job->created_at ? $job->created_at->format('d/m/Y') : '' }}
                                            </td>
                                            <td>
                                                {{ $job->end_date ? \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') : '' }}
                                            </td>
                                            <td class="text-center">
                                                @if ($job->status == STATUS_PENDING)
                                                    <div>
                                                        <span class="badge bg-warning">
                                                            {{ __('label.company.job.pending') }}
                                                        </span>
                                                    </div>
                                                @elseif($job->status == STATUS_APPROVED)
                                                    <div>
                                                        <span class="badge bg-success">
                                                            {{ __('label.company.job.approved') }}
                                                        </span>
                                                    </div>
                                                @elseif($job->status == STATUS_REJECTED)
                                                    <div>
                                                        <span class="badge bg-danger">
                                                            {{ __('label.company.job.refused') }}
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="d-flex align-items-center">

                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('company.showJob', $job->slug) }}"
                                                        class="btn btn-info shadow btn-xs sharp me-1">
                                                        <i class="fa-solid fa-file-alt"></i>
                                                    </a>
                                                    @if ($job->status != STATUS_REJECTED && $job->status != STATUS_APPROVED)
                                                        <a href="{{ route('company.editJob', $job->slug) }}"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                class="fa fa-pencil"></i>
                                                        </a>
                                                    @endif
                                                    <form action="{{ route('company.deleteJob', $job->id) }}"
                                                        method="POST" style="display:inline;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                            data-id="{{ $job->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                {{ __('label.company.job.no_jobs') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                @endif
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
@endsection

@section('js')
    <script>
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            let form = $(this).closest('.delete-form');
            Swal.fire({
                title: "{{ __('label.company.job.delete_confirm') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "{{ __('label.company.job.delete') }}",
                cancelButtonText: "{{ __('label.company.job.cancel') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
