<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('label.company.applyJob.name') }}</th>
                <th>{{ __('label.company.applyJob.university') }}</th>
                <th>{{ __('label.company.applyJob.date') }}</th>
                <th>{{ __('label.company.applyJob.status') }}</th>
                @if (isset($data) && $data === $pending)
                    <th  class="text-center">{{ __('label.company.applyJob.action') }}</th>
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
                                <span class="badge bg-warning">{{ __('label.company.applyJob.pending') }}</span>
                            @elseif ($dataItem->status == 2)
                                <span class="badge bg-success">{{ __('label.company.applyJob.approved') }}</span>
                            @elseif ($dataItem->status == 3)
                                <span class="badge bg-danger">{{ __('label.company.applyJob.rejected') }}</span>
                            @endif
                        </td>
                        @if (isset($data) && $data === $pending)
                            <td  class="text-center">
                                @if ($dataItem->status == 1)
                                    <a href="{{ route('company.updateStatus', ['id' => $dataItem->id, 'status' => 2]) }}"
                                        class="btn btn-primary">{{ __('label.company.applyJob.approve') }}</a>
                                    <a href="{{ route('company.updateStatus', ['id' => $dataItem->id, 'status' => 3]) }}"
                                        class="btn btn-danger">{{ __('label.company.applyJob.reject') }}</a>
                                @elseif ($dataItem->status == 2)
                                    <span class="badge bg-success">{{ __('label.company.applyJob.approved') }}</span>
                                @elseif ($dataItem->status == 3)
                                    <span class="badge bg-danger">{{ __('label.company.applyJob.rejected') }}</span>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
                @php $serial++; @endphp <!-- Tăng số thứ tự cho nhóm tiếp theo -->
            @endforeach
            @if ($data->isEmpty())
                <tr>
                    <td colspan="8" class="text-center text-muted">{{ __('label.company.applyJob.no_data') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
