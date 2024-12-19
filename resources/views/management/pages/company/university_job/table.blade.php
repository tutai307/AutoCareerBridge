<table class="table">
    <thead>
        <tr>
            <th>Tên Công việc</th>
            <th>Trường học</th>
            <th>Ngày tạo</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>

        @forelse ($data as $dataItem)
            @foreach ($dataItem->universityJobs as $index => $job)
                <tr>
                    <!-- Hiển thị tên công ty chỉ một lần -->
                    @if ($index == 0)
                        <td rowspan="{{ count($dataItem->universityJobs) }}">
                            <a href="{{ route('company.showJob', ['slug' => $dataItem->slug]) }}"
                                style="color: #007bff; text-decoration: none; display: flex; align-items: center;">
                                {!! wordwrap($dataItem->name, 50, '<br>', true) !!}
                            </a>
                        </td>
                    @endif
                    <td>
                        <a style="color: #007bff; text-decoration: none; display: flex; align-items: center;"
                            href="{{ route('detailUniversity', ['slug' => $job->university->slug]) }}"
                            target="_blank">{{ $job->university->name }}</a>
                    </td>
                    <td>{{ $job->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if ($job->status == 1)
                            <a href="{{ route('company.updateStatus', ['id' => $job->id, 'status' => 2]) }}"
                                class="btn btn-primary">Phê duyệt</a>
                            <a href="{{ route('company.updateStatus', ['id' => $job->id, 'status' => 3]) }}"
                                class="btn btn-danger">Từ chối</a>
                        @elseif ($job->status == 2)
                            <span class="badge bg-success">Đã duyệt</span>
                        @elseif ($job->status == 3)
                            <span class="badge bg-danger">Đã từ chối</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted">Không có dữ liệu</td>
            </tr>
        @endforelse

    </tbody>

</table>
@if ($data->count() > 0)
    <div class="d-flex justify-content-center align-items-center mt-3">
        <div class="dataTables_paginate">
            {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endif
