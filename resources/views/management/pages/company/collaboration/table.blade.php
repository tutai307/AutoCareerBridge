<div class="table-responsive">
    <table class="table table-responsive-md">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th>{{ __('label.company.collaboration.title') }}</th>
            <th>{{ __('label.company.collaboration.university') }}</th>
            <th>{{ __('label.company.collaboration.response_message') }}</th>
{{--            <th>{{ __('label.company.collaboration.start_date') }}</th>--}}
{{--            <th>{{ __('label.company.collaboration.end_date') }}</th>--}}
            <th>{{ __('label.company.collaboration.status') }}</th>
            <th class="text-center">{{ __('label.company.collaboration.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @if ($data->count() > 0)
            @foreach ($data as $index => $item)
                <tr>
                    <td class="text-center">
                      {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                    </td>
                    <td>{{ Str::limit($item->title, 30) }}</td>
                    <td>{{ $item->university->name  }}</td>
                    <td>{{ Str::limit($item->response_message ?? 'No message', 40) }}</td>
{{--                    <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}</td>--}}
{{--                    <td>{{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</td>--}}
                    <td>
                        @php
                            $statusClass = match($item->status) {
                                2 => 'badge-success',
                                3 => 'badge-danger',
                                default => 'badge-warning'
                            };
                            $statusText = match($item->status) {
                                2 => 'Accepted',
                                3 => 'Rejected',
                                default => 'Pending'
                            };
                        @endphp
                        <span class="badge light {{ $statusClass }}">{{ $statusText }}</span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a
                                class="btn btn-primary shadow btn-xs sharp me-1"
                                title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-info shadow btn-xs sharp me-1 modalTrigger"
                               data-bs-toggle="modal"
                               data-id="{{ $item->id }}"
                               data-title="{{ $item->title }}"
                               data-message="{{ $item->response_message ?? '' }}"
                               data-university="{{ $item->university->name }}"
                               data-content="{{ $item->content }}"
                               data-bs-target="#exampleModalCenter"
                               title="View Details">
                                <i class="la la-file-text"></i>
                            </a>
                            <a href="#"
                               class="btn btn-danger shadow btn-xs sharp btn-remove"
                               data-id="{{ $item->id }}"
                               title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="text-center text-muted">
                    @if($status == 'Search Results')
                        {{ __('label.company.collaboration.pagination_search') }}
                    @else
                        {{ __('label.company.collaboration.pagination') }}
                    @endif
                </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

@if ($data->count() > 0)
    <div class="d-flex justify-content-center align-items-center mt-3">
        <div class="dataTables_paginate">
            {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endif

