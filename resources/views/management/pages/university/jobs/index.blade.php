@extends('management.layout.main')

@section('title', __('label.company.job.about'))

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"> {{ __('label.company.job.home') }} </a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('label.company.job.list_applied_jobs') }} 
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('label.company.job.list_applied_jobs') }}</h4>
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
                                    <th> {{ __('label.company.job.status') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($appliedJobs))
                                    @forelse ($appliedJobs as $index => $job)
                                        <tr>
                                            <td><strong>{{ $loop->iteration + ($appliedJobs->currentPage() - 1) * $appliedJobs->perPage() }}</strong>
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
                                            @if ($job->university_job_status)
                                                @switch($job->university_job_status)
                                                    @case(STATUS_PENDING)
                                                        <td><span
                                                                class="badge badge-warning">{{ __('label.company.job.pending') }}</span>
                                                        </td>
                                                    @break

                                                    @case(STATUS_APPROVED)
                                                        <td><span
                                                                class="badge badge-success">{{ __('label.company.job.approved') }}</span>
                                                        </td>
                                                    @break

                                                    @case(STATUS_REJECTED)
                                                        <td><span
                                                                class="badge badge-danger">{{ __('label.company.job.rejected') }}</span>
                                                        </td>
                                                    @break
                                                @endswitch
                                            @endif
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
                    <div class="card-footer">
                        @if ($appliedJobs->lastPage() > 1)
                            {{ $appliedJobs->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
