<div class="table-responsive">
    <table class="table table-responsive-md">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>{{ __('label.university.collaboration.title') }}</th>
                <th>{{ __('label.university.collaboration.company') }}</th>
                @if ($status == 'Search Results')
                @elseif($status == 'Request')
                    <th>{{ __('label.university.collaboration.end_date') }}</th>
                @elseif($status == 'Accept' || $status == 'Complete')
                    <th>{{ __('label.university.collaboration.start_date') }}</th>
                    <th>{{ __('label.university.collaboration.end_date') }}</th>
                @elseif($status == 'Reject')
                    <th>{{ __('label.university.collaboration.response_message') }}</th>
                @endif
                <th class="text-center">{{ __('label.university.collaboration.status') }}</th>
                <th class="text-right">{{ __('label.university.collaboration.action') }}</th>
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
                        <td>{{ $item->company->name }}</td>
                        @if ($status == 'Search Results')
                        @elseif($status == 'Request')
                            <td>{{ $item->end_date }}</td>
                        @elseif($status == 'Accept' || $status == 'Complete')
                            <td>{{ $item->start_date }}</td>
                            <td>{{ $item->end_date }}</td>
                        @elseif($status == 'Reject')
                            <td>{{ Str::limit($item->response_message ?? __('label.university.collaboration.not_found'), 40) }}</td>
                        @endif
                        <td class="text-center">
                            @php
                                $statusClass = match ($item->status) {
                                    2 => 'badge-info',
                                    3 => 'badge-danger',
                                    4 => 'badge-success',
                                    default => 'badge-warning',
                                };
                                $statusText = match ($item->status) {
                                    2 => __('label.university.collaboration.active'),
                                    3 => __('label.university.collaboration.rejected'),
                                    4 => __('label.university.collaboration.completed'),
                                    default => __('label.university.collaboration.pending'),
                                };
                            @endphp
                            <span class="badge light {{ $statusClass }}">{{ $statusText }}</span>
                        </td>
                        <td class="">
                            <div class="text-right">
                                @if ($item->status == STATUS_PENDING && $item->created_by == auth('admin')->user()->role)
                                    <form action="{{ route('university.collaboration.delete', $item->id) }}"
                                        method="POST" style="display:inline;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger shadow btn-xs sharp btn-delete"
                                            data-id="">
                                            <i class="la la-refresh"></i>
                                        </button>
                                    </form>
                                @endif
                                    <a class="btn btn-info shadow btn-xs sharp me-1 modalTrigger" data-bs-toggle="modal"
                                       data-id="{{ $item->id }}" data-title="{{ $item->title }}"
                                       data-message="{{ $item->response_message ?? '' }}"
                                       data-university="{{ $item->university->name }}"
                                       data-content="{{ $item->content }}" data-bs-target="#exampleModalCenter"
                                       title="View Details" onclick="getDetailColab({{ json_encode($item) }})">
                                        <i class="la la-file-text"></i>
                                    </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        @if ($status == 'Search Results')
                            {{ __('label.university.collaboration.pagination_search') }}
                        @else
                            {{ __('label.university.collaboration.pagination') }}
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
