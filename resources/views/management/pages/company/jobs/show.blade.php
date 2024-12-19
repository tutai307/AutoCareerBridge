@extends('management.layout.main')

@section('title', __('label.company.job.show_job'))

@section('content')
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="page-titles">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('company.manageJob') }}">{{ __('label.company.job.title_job') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ __('label.company.job.show_job') }} </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader">
                        <div class="cpa">
                            <i class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.company.job.show_job') }}
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="handle expand"><i class="fal fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div class="cm-content-body form excerpt" style="">
                        <div class="col-xl-12">
                            <div class="card h-auto">
                                <div class="card-body">
                                    <div class="post-details">
                                        <h3 class="mb-2 text-black"> {{ $job->name }} </h3>
                                        <ul class="mb-4 post-meta d-flex flex-wrap">
                                            <li class="post-author me-3"><i
                                                    class="fas fa-user me-2"></i>{{ $job->user->hiring ? $job->user->hiring->name : $job->user->company->name ?? '' }}
                                            </li>
                                            <li class="post-date me-3"><i
                                                    class="far fa-calendar-plus me-2"></i>{{ $job->created_at ? $job->created_at->format('d/m/Y') : '' }}
                                            </li>
                                            <li class="post-comment me-3"><i
                                                    class="fa-solid fa-book me-2"></i>{{ $job->major->name }}</li>
                                        </ul>
                                        <div class="mb-3">
                                            <p class="bg-light p-1 ps-2 pe-2 d-inline-block rounded">
                                                <i class="fa-solid fa-clock me-2"></i>{{ __('label.company.job.deadline') }}
                                                {{ $job->end_date ? \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') : '' }}
                                            </p>
                                        </div>
                                        {!! $job->detail !!}
                                        <div class="profile-skills mt-5 mb-5">
                                            <h4 class="text-primary mb-2">{{ __('label.company.job.skill') }}</h4>
                                            @foreach ($job->skills as $skill)
                                                <button
                                                    class="btn btn-primary light btn-xs mb-1">{{ $skill->name }}</button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($job->universities && $job->universities->isNotEmpty())
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('label.company.job.list_internship') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('label.company.job.university_name') }}</th>
                                            <th>Email</th>
                                            <th>Link website</th>
                                            <th>{{ __('label.company.job.status') }}</th>
                                            <th>{{ __('label.company.job.request_date') }}</th>
                                            <th class="text-center">{{ __('label.company.job.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobUniversities as $index => $university)
                                            @php
                                                $universityJob = $university->universityJobs->first();
                                            @endphp
                                            <tr>
                                                <th><strong>{{ $loop->iteration + ($jobUniversities->currentPage() - 1) * $jobUniversities->perPage() }}</strong>
                                                </th>
                                                <td><a style="color: #007bff; text-decoration: none; display: flex; align-items: center;" href="{{ route('detailUniversityAdmin', ['slug' => $university->slug]) }}">{{ $university->name }}</a></td>
                                                <td>{{ $university->email }}</td>
                                                <td>
                                                    <a href="{{ $university->website_link }}"
                                                        target="_blank">{!! wordwrap( $university->website_link, 50, '<br>', true) !!}</a>
                                                </td>
                                                @if ($universityJob)
                                                    @switch($universityJob->status)
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
                                                                    class="badge badge-danger">{{ __('label.company.job.refused') }}</span>
                                                            </td>
                                                        @break
                                                    @endswitch
                                                    <td>{{ $universityJob->created_at->format('d/m/Y') }}</td>
                                                    @if ($universityJob->status == STATUS_PENDING)
                                                        <td>
                                                            <a href="{{ route('company.updateStatus', ['id' => $universityJob->id, 'status' => 2]) }}"
                                                                class="btn btn-primary">Phê duyệt</a>
                                                            <a href="{{ route('company.updateStatus', ['id' => $universityJob->id, 'status' => 3]) }}"
                                                                class="btn btn-danger">Từ chối</a>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-2">
                                    @if ($jobUniversities->lastPage() > 1)
                                        {{ $jobUniversities->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-xl-12">
                <div class="page-titles">
                    <a class="btn btn-light ms-3"
                        href="{{ route('company.manageJob') }}">{{ __('label.company.job.back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
