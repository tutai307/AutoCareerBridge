<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên Workshop</th>
            <th>Doanh nghiệp</th>
            <th>Ngày tạo</th>
            <th>Trạng thái</th>
            @if (isset($data) && $data === $pending)
                <th>Hành động</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @php $serial = 1; @endphp <!-- Khởi tạo số thứ tự -->
        @foreach ($data->groupBy('workshop_id') as $workshopItems)
            @php
                $workshop = $workshopItems->first()->workshops; // Lấy workshop đầu tiên trong nhóm
            @endphp
            @foreach ($workshopItems as $index => $dataItem)
                <tr>
                    @if ($index == 0)
                        <!-- Chỉ hiển thị STT và tên workshop lần đầu tiên -->
                        <td rowspan="{{ $workshopItems->count() }}"><strong>{{ $serial }}</strong></td>
                        <!-- Hiển thị STT -->
                        <td rowspan="{{ $workshopItems->count() }}">
                            {!! wordwrap($workshop->name, 50, '<br>', true) !!}
                        </td>
                    @endif

                    <!-- Hiển thị tên công ty -->
                    <td><a style="color: #007bff; text-decoration: none; display: flex; align-items: center;"
                            target="_blank"
                            href="{{ route('detailCompany', ['slug' => $dataItem->companies->slug]) }}">{{ $dataItem->companies->name }}</a>
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
                                <a href="{{ route('university.updateStatusWorkShop', ['companyId' => $dataItem->company_id, 'workshopId' => $dataItem->workshop_id, 'status' => 2]) }}"
                                    class="btn btn-primary">Phê duyệt</a>
                                <a href="{{ route('university.updateStatusWorkShop', ['companyId' => $dataItem->company_id, 'workshopId' => $dataItem->workshop_id, 'status' => 3]) }}"
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