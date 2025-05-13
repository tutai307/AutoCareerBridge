<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('label.company.resume.name') }}</th>
                <th>{{ __('label.company.resume.university') }}</th>
                <th>{{ __('label.company.resume.contact') }}</th>
                <th>{{ __('label.company.resume.status') }}</th>
                <th>{{ __('label.company.resume.action') }}</th>
                @if (isset($data) && $data === $pending)
                    <th class="text-center">{{ __('label.company.applyJob.action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @php $serial = 1; @endphp <!-- Khởi tạo số thứ tự -->
            @php
                // dd($data);
            @endphp
            @foreach ($data as $applicant)
                <tr>
                    <td rowspan="{{ $applicant->count() }}"><strong>{{ $serial }}</strong></td>
                    <td rowspan="{{ $applicant->count() }}">
                        {!! wordwrap($applicant->student->name, 50, '<br>', true) !!}
                    </td>
                    <td>{{ $applicant->student->university->name }}</td>
                    </td>
                    <td>
                        <i class="fa-solid fa-phone"></i> {{ $applicant->student->phone }}
                        <br>
                        <i class="fa-solid fa-envelope"></i> {{ $applicant->student->email }}
                    </td>
                    <td>
                        @if ($applicant->status == 'pending')
                            <span class="badge bg-warning">{{ __('label.company.applyJob.pending') }}</span>
                        @elseif ($applicant->status == 'approved')
                            <span class="badge bg-success">{{ __('label.company.applyJob.approved') }}</span>
                        @elseif ($applicant->status == 'rejected')
                            <span class="badge bg-danger">{{ __('label.company.applyJob.rejected') }}</span>
                        @endif
                    </td>
                    @if (isset($data) && $data === $pending)
                        <td class="text-center">
                            @if ($applicant->status == 1)
                                <a href="{{ route('company.updateStatus', ['id' => $applicant->id, 'status' => 2]) }}"
                                    class="btn btn-primary">{{ __('label.company.applyJob.approve') }}</a>
                                <a href="{{ route('company.updateStatus', ['id' => $dataItem->id, 'status' => 3]) }}"
                                    class="btn btn-danger">{{ __('label.company.applyJob.reject') }}</a>
                            @elseif ($applicant->status == 2)
                                <span class="badge bg-success">{{ __('label.company.applyJob.approved') }}</span>
                            @elseif ($applicant->status == 3)
                                <span class="badge bg-danger">{{ __('label.company.applyJob.rejected') }}</span>
                            @endif
                        </td>
                    @endif
                    <td>
                        <a href="{{ route('company.getResume', ['job_id' => $applicant->job_id, 'student_id' => $applicant->student_id]) }}"
                            class="btn btn-primary">{{ __('label.company.resume.view') }}</a>
                    </td>
                </tr>
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
