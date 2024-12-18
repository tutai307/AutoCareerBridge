<table class="table">
    <thead>
        <tr>
            <th>Tên Công việc</th>
            <th>Trường học</th>
            <th>Hành động</th>
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
                                <i class="fas fa-external-link-alt" style="margin-right: 5px;"></i>
                                {!! wordwrap($dataItem->name, 50, '<br>', true) !!}
                            </a>
                        </td>
                    @endif

                   <td> <a style="color: #007bff; text-decoration: none; display: flex; align-items: center;" href="{{ route('detailUniversityAdmin', ['slug' => $job->university->slug]) }}">{{ $job->university->name }}</a></td>
                    <td>
                        @if ($job->status == 1)
                            <a href="{{ route('company.updateStatus', ['id' => $job->id, 'status' => 2]) }}"
                                class="btn btn-primary">Phê duyệt</a>
                            <a href="{{ route('company.updateStatus', ['id' => $job->id, 'status' => 3]) }}"
                                class="btn btn-danger">Từ chối</a>
                        @elseif ($job->status == 2)
                            Đã duyệt
                        @elseif ($job->status == 3)
                            Đã từ chối
                        @endif
                    </td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="3" class="text-center">Không có dữ liệu</td>
            </tr>
        @endforelse
    </tbody>
</table>
