@extends('home.layouts.app')
@section('title', 'Quản lý CV')
{{-- Có thể thêm CSS tùy chỉnh nếu muốn --}}
@push('styles')
    <style>
        .card-header {
            font-weight: bold;
        }

        .job-suggestion-item {
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .job-suggestion-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .action-buttons a,
        .action-buttons button {
            margin-right: 5px;
            /* Khoảng cách giữa các nút hành động */
            margin-bottom: 5px;
            /* Đảm bảo nút không dính vào nhau trên màn hình nhỏ */
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4 mb-5"> {{-- Thêm mb-5 để có khoảng cách dưới cùng --}}

        <div class="row g-4"> {{-- g-4 tạo khoảng cách giữa các cột --}}

            {{-- Card 1: Quản lý CV --}}
            <div class="col-12">
                <div class="card"> {{-- Thêm shadow-sm cho đẹp --}}
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <label class="h6 animated slideInDown"><i class="fas fa-file-alt me-2"></i>Quản lý CV</label>
                        <!-- Nút mở modal -->
                        <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#uploadCVModal">
                            Nộp CV mới
                        </button>

                        <!-- Modal Upload CV -->
                        <div class="modal fade" id="uploadCVModal" tabindex="-1" aria-labelledby="uploadCVLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadCVLabel">Nộp CV ứng tuyển</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Đóng"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Tên CV</label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cv_file" class="form-label">Tải lên CV (.pdf, .doc, .docx)</label>
                                            <input type="file" name="cv_file" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Lưu CV</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Huỷ</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        @if (isset($resumes) && $resumes->count() > 0)
                            <div class="row">
                                @foreach ($resumes as $resume)
                                    <div class="col-md-4 col-12 mb-4">
                                        <div class="box-cv shadow rounded-3" style="max-width: 320px;">
                                            {{-- Ảnh đại diện CV --}}
                                            <img src="{{ asset('storage/home/default_cv.jpg') }}"
                                                class="img-responsive rounded-top"
                                                style="width: 100%; height: 300px; object-fit: cover;">

                                            <div class="box-bg p-3 bg-light rounded-bottom">
                                                {{-- Nút Đặt làm CV chính / CV chính --}}
                                                <div class="cv-main mb-2 d-flex justify-content-between align-items-center">
                                                    @if ($resume->is_main)
                                                        <span class="btn btn-sm btn-dark text-white">
                                                            <i class="fas fa-star text-warning"></i> CV chính
                                                        </span>
                                                    @else
                                                        <form action="{{ route('home.manageCV.setMain', ['resume_id' => $resume->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-primary"
                                                                style="transition: color 0.3s;"
                                                                onmouseover="this.style.color='white'; this.querySelector('i').style.color='yellow'"
                                                                onmouseout="this.style.color=''; this.querySelector('i').style.color=''">
                                                                <i class="fas fa-star"></i> Đặt làm CV chính
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>

                                                {{-- Tên và hành động --}}
                                                <div class="box-info">
                                                    <h5 class="title-cv d-flex justify-content-between align-items-center">
                                                        <a href="{{ Storage::url($resume->file_path) }}" target="_blank">
                                                            {{ $resume->title }}
                                                        </a>
                                                        <button class="btn btn-link p-0 border-0" data-bs-toggle="modal" data-bs-target="#editModal{{ $resume->id }}">
                                                            <i class="fas fa-pen text-primary"></i>
                                                        </button>

                                                        <!-- Modal đổi tên -->
                                                        <div class="modal fade" id="editModal{{ $resume->id }}" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="{{ route('home.manageCV.edit') }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                                                                        <div class="modal-header">
                                                                            <label class="modal-title small">Đổi tên CV</label>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="title" class="form-label small">Tên CV(Thường là vị trí ứng tuyển)</label>
                                                                                <input type="text" class="form-control form-control-sm" id="title" name="title" value="{{ $resume->title }}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                                            <button type="submit" class="btn btn-sm btn-primary">Lưu thay đổi</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </h5>
                                                    <p class="update_at text-muted small">
                                                        Cập nhật: {{ $resume->updated_at->format('d-m-Y H:i A') }}
                                                    </p>

                                                    {{-- Hành động --}}
                                                    <ul class="list-inline mt-2">
                                                        <li class="list-inline-item">
                                                            <a href="{{ Storage::url($resume->file_path) }}" download
                                                                class="btn btn-sm btn-success">
                                                                <i class="fas fa-download"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $resume->id }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal xóa --}}
                                    <div class="modal fade" id="deleteModal{{ $resume->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('home.manageCV.delete')}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="resume_id" value="{{$resume->id}}">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Xóa CV</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body small">
                                                        Bạn có chắc chắn muốn xóa CV <strong>{{ $resume->title }}</strong>
                                                        không?
                                                    </div>
                                                    <div class="modal-footer small">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Hủy</button>
                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-muted">
                                Bạn chưa tải lên CV nào.
                                <span class="text-primary">Tải lên ngay!</span>
                            </p>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Card 2: Quản lý Hồ sơ (Việc làm đã nộp) --}}
            <div class="col-12"> {{-- Chia cột trên màn hình lớn --}}
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-info text-white">
                        <label class="h6 text-white animated slideInDown"><i class="fas fa-briefcase me-2"></i>Việc làm đã ứng tuyển</label>
                    </div>
                    <div class="card-body">
                        @if (isset($applications) && $applications->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($applications as $application)
                                    <div class="job-item p-4 mb-4">
                                        <div class="row g-4">
                                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                <img class="flex-shrink-0 img-fluid border rounded"
                                                    src="{{ asset($application->job->company->avatar_path) }}" alt=""
                                                    style="width: 80px; height: 80px;">
                                                <div class="text-start ps-4">
                                                    <h5 class="mb-3">{{ $application->job->name }}</h5>
                                                    <span class="text-truncate me-3">
                                                        <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                                        {{ $application->job->company->addresses[0]->province->name ?? 'Chưa cập nhật' }}
                                                    </span>
                                                    <span class="text-truncate me-3">
                                                        <i class="fas fa-building text-primary me-2"></i>
                                                        {{ $application->job->company->name }}
                                                    </span>
                                                    <span class="text-truncate me-3">
                                                        <i class="fas fa-tools text-primary me-2"></i>
                                                        @foreach ($application->job->skills as $skill)
                                                            {{ $skill->name }}@if (!$loop->last), @endif
                                                        @endforeach
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                                <div class="d-flex mb-3">
                                                    <span class="badge bg-{{ $application->status == 'pending' ? 'warning' : ($application->status == 'approved' ? 'success' : 'danger') }} p-2">
                                                        {{ $application->status == 'pending' ? 'Đang chờ' : ($application->status == 'approved' ? 'Phù hợp' : 'Không phù hợp') }}
                                                    </span>
                                                </div>
                                                <small class="text-truncate">
                                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                                    Ngày nộp: {{ \Carbon\Carbon::parse($application->created_at)->format('d/m/Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-muted">Bạn chưa ứng tuyển vào công việc nào.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Card 3: Gợi ý việc làm phù hợp --}}
            <div class="col-12"> {{-- Chia cột trên màn hình lớn --}}
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-success text-white">
                        <label class="h6 text-white animated slideInDown"><i class="fas fa-lightbulb me-2"></i>Việc làm
                            gợi ý cho bạn</label>
                    </div>
                    <div class="card-body">
                        @if (isset($suitableJobs) && $suitableJobs->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($suitableJobs as $job)
                                    <div class="job-item p-4 mb-4">
                                        <div class="row g-4">
                                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                <img class="flex-shrink-0 img-fluid border rounded"
                                                    src="{{ asset($job->company->avatar_path) }}" alt=""
                                                    style="width: 80px; height: 80px;">
                                                <div class="text-start ps-4">
                                                    <h5 class="mb-3">{{ $job->name }}</h5>
                                                    <span class="text-truncate me-3">
                                                        <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                                        {{ $job->company->addresses[0]->province->name ?? 'Chưa cập nhật' }}
                                                    </span>
                                                    <span class="text-truncate me-3">
                                                        <i class="fas fa-building text-primary me-2"></i>
                                                        {{ $job->company->name }}
                                                    </span>
                                                    <span class="text-truncate me-3">
                                                        <i class="fas fa-tools text-primary me-2"></i>
                                                        @foreach ($job->skills as $skill)
                                                            {{ $skill->name }}@if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                </div>
                                            </div>
                                            <div
                                                class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                                <div class="d-flex mb-3">
                                                    <a href="#" class="btn btn-light btn-square me-3"
                                                        href="">
                                                        <i class="far fa-heart text-primary"></i>
                                                    </a>
                                                    <a href="{{route('home.detailJob', ['slug' => $job->slug])}}" class="btn btn-primary">Ứng tuyển ngay</a>
                                                </div>
                                                <small class="text-truncate">
                                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                                    Hạn nộp: {{ \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-muted">Hiện chưa có việc làm phù hợp nào cho bạn.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    {{-- Có thể thêm JS nếu cần, ví dụ cho tooltip hoặc modal xác nhận xóa phức tạp hơn --}}
    <script>
        // Kích hoạt tooltip của Bootstrap (nếu bạn dùng title cho nút)
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endpush
