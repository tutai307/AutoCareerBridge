<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Công việc</th>
                <th>Trường học</th>
                <th>Ngày tạo</th>
                <th>Trạng thái</th>
                @if (isset($data) && $data === $pending)
                    <th>Hành động</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @php $serial = 1; @endphp <!-- Khởi tạo số thứ tự -->
            @foreach ($data->groupBy('job_id') as $jobItems)
                @php
                    $job = $jobItems->first()->job; // Lấy job đầu tiên trong nhóm
                @endphp
                @foreach ($jobItems as $index => $dataItem)
                    <tr>
                        @if ($index == 0)
                            <td rowspan="{{ $jobItems->count() }}"><strong>{{ $serial }}</strong></td>
                            <td rowspan="{{ $jobItems->count() }}">
                                <a href="{{ route('company.showJob', ['slug' => $dataItem->job->slug]) }}"
                                    rel="noopener noreferrer"> {!! wordwrap($job->name, 50, '<br>', true) !!}</a>
                            </td>
                        @endif
                        <td><a style="color: #007bff; text-decoration: none; display: flex; align-items: center;"
                                target="_blank"
                                href="{{ route('detailUniversity', ['slug' => $dataItem->university->slug]) }}">{{ $dataItem->university->name }}</a>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($dataItem->created_at)->format('d/m/Y') }}</td>
                        <td>
                            @if ($dataItem->status == 1)
                                <span class="badge bg-warning">Chờ phê duyệt</span>
                            @elseif ($dataItem->status == 2)
                                <span class="badge bg-success">Đã duyệt</span>
                            @elseif ($dataItem->status == 3)
                                <span class="badge bg-danger">Đã từ chối</span>
                            @endif
                        </td>
                        @if (isset($data) && $data === $pending)
                            <td>
                                @if ($dataItem->status == 1)
                                    <a href="{{ route('company.updateStatus', ['id' => $dataItem->id, 'status' => 2]) }}"
                                        class="btn btn-primary">Phê duyệt</a>
                                    <a href="{{ route('company.updateStatus', ['id' => $dataItem->id, 'status' => 3]) }}"
                                        class="btn btn-danger">Từ chối</a>
                                @elseif ($dataItem->status == 2)
                                    <span class="badge bg-success">Đã duyệt</span>
                                @elseif ($dataItem->status == 3)
                                    <span class="badge bg-danger">Đã từ chối</span>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
                @php $serial++; @endphp <!-- Tăng số thứ tự cho nhóm tiếp theo -->
            @endforeach
            @if ($data->isEmpty())
                <tr>
                    <td colspan="8" class="text-center text-muted">Không có dữ liệu</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
