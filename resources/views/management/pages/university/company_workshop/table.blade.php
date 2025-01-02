<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('label.university.applyWorkshop.name') }}</th>
            <th>{{ __('label.university.applyWorkshop.company') }}</th>
            <th>{{ __('label.university.applyWorkshop.date') }}</th>
            <th>{{ __('label.university.applyWorkshop.status') }}</th>
            @if (isset($data) && $data === $pending)
                <th class="text-center">{{ __('label.university.applyWorkshop.action') }}</th>
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
                            <span class="badge bg-warning">{{ __('label.university.applyWorkshop.pending') }}</span>
                        @elseif ($dataItem->status == 2)
                            <span class="badge bg-success">{{ __('label.university.applyWorkshop.approved') }}</span>
                        @elseif ($dataItem->status == 3)
                            <span class="badge bg-danger">{{ __('label.university.applyWorkshop.rejected') }}</span>
                        @endif
                    </td>
                    @if (isset($data) && $data === $pending)
                        <td class="text-center">
                            @if ($dataItem->status == 1)
                                <a href="{{ route('university.updateStatusWorkShop', ['companyId' => $dataItem->company_id, 'workshopId' => $dataItem->workshop_id, 'status' => 2]) }}"
                                    class="btn btn-primary">{{ __('label.university.applyWorkshop.approve') }}</a>
                                <a href="{{ route('university.updateStatusWorkShop', ['companyId' => $dataItem->company_id, 'workshopId' => $dataItem->workshop_id, 'status' => 3]) }}"
                                    class="btn btn-danger">{{ __('label.university.applyWorkshop.reject') }}</a>
                            @elseif ($dataItem->status == 2)
                                <span class="badge bg-success">{{ __('label.university.applyWorkshop.approved') }}</span>
                            @elseif ($dataItem->status == 3)
                                <span class="badge bg-danger">{{ __('label.university.applyWorkshop.rejected') }}</span>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
            @php $serial++; @endphp <!-- Tăng số thứ tự cho nhóm tiếp theo -->
        @endforeach
        @if ($data->isEmpty())
            <tr>
                <td colspan="8" class="text-center text-muted">{{ __('label.university.applyWorkshop.no_data') }}</td>
            </tr>
        @endif
    </tbody>
</table>
</div>