@extends('management.layout.main')

@section('title', 'Quản lý ứng tuyển workshop')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"> {{ __('label.company.job.home') }} </a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('label.company.joinWorkshop.manage_workshop') }} 
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('label.company.joinWorkshop.workshop_applied') }} </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ __('label.company.joinWorkshop.name') }} </th>
                                    <th> {{ __('label.company.joinWorkshop.university') }} </th>
                                    <th> {{ __('label.company.joinWorkshop.start_date') }} </th>
                                    <th> {{ __('label.company.joinWorkshop.end_date') }} </th>
                                    <th> {{ __('label.company.joinWorkshop.status') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($workshopApplied))
                                    @forelse ($workshopApplied as $index => $companyWorkshop)
                                        <tr>
                                            <td>
                                                <strong> {{ $loop->iteration }}</strong>
                                            </td>

                                            <td>
                                                <span class="w-space-no"> {!! wordwrap($companyWorkshop->workshops->name, 50, '<br>', true) !!}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('detailUniversity', ['slug' => $companyWorkshop->workshops->university->slug]) }}"
                                                    target="_blank" rel="noopener noreferrer"
                                                    style="color: #007bff; text-decoration: none;">
                                                    {{ $companyWorkshop->workshops->university->name }}
                                                </a>
                                            </td>

                                            </td>

                                            <td>
                                                {{ $companyWorkshop->workshops->start_date }}
                                            </td>
                                            <td>
                                                {{ $companyWorkshop->workshops->end_date }}
                                            </td>
                                            <td>
                                                @if ($companyWorkshop->status == 1)
                                                    <span class="badge bg-warning">{{ __('label.company.joinWorkshop.pending') }}</span>
                                                @elseif ($companyWorkshop->status == 2)
                                                    <span class="badge bg-success">{{ __('label.company.joinWorkshop.approved') }}</span>
                                                @elseif ($companyWorkshop->status == 3)
                                                    <span class="badge bg-danger">{{ __('label.company.joinWorkshop.rejected') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                {{ __('label.company.joinWorkshop.no_data') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="d-flex justify-content-center align-items-center mt-3">
                    <div class="dataTables_paginate">
                        {{ $workshopApplied->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
