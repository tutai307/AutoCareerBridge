<div class="table-responsive">
    <table class="table table-responsive-md">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>University</th>
            <th>Response Message</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @if ($data->count() > 0)
            @foreach ($data as $index => $item)
                <tr>
                    <td>0{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->university->name }}</td>
                    <td>{{ $item->response_message ?? 'No message' }}</td>
                    <td>{{ $item->start_date }}</td>
                    <td>{{ $item->end_date }}</td>
                    <td> @php
                            // Đặt màu sắc theo trạng thái
                            $statusClass = match($item->status) {
                                2 => 'badge-success',
                                3 => 'badge-danger',
                                4 => 'badge-primary',
                                default => 'badge-warning'
                            };
                            $statusText = match($item->status) {
                                2 => 'Accepted',
                                3 => 'Rejected',
                                4 => 'Active',
                                default => 'Pending'
                            };
                        @endphp
                        <span class="badge light {{ $statusClass }}">{{ $statusText }}</span></td>
                    <td>
                        <div class="">
                            <a class="btn btn-primary shadow btn-xs sharp me-1" href="#"> <i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a class="btn btn-primary shadow btn-xs sharp me-1" href="#"> <i
                                    class="la la-file-text"></i>
                            </a>
                            <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"
                               href="#"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center text-muted">Không có dữ liệu phù hợp.</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-3">
    {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
