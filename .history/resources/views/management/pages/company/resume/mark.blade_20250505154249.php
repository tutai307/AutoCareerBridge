@extends('management.layout.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Cột trái (8 phần) --}}
        <div class="col-md-8">
            {{-- Phần xem CV --}}
            <div class="card overflow-y-auto" style="max-height: 100vh;">
                <div class="card-header">
                    <h5 class="mb-0">CV của ứng viên - {{ $resume->title }}</h5>
                </div>
                <div class="card-body">
                    {{-- Giả sử $resume->cv_path hoặc $student->cv->path chứa đường dẫn tới file CV --}}
                    {{-- Thay thế bằng đường dẫn chính xác và cách hiển thị phù hợp (ví dụ: iframe cho PDF) --}}
                    @php
                        // Ví dụ: giả sử đường dẫn được lưu trong $resume->cv_path
                        // và nó là đường dẫn tương đối trong thư mục public/storage
                        $cvPath = isset($resume->file_path) ? asset('storage/' . $resume->file_path) : null;
                        // Hoặc nếu lưu trong student:
                        // $cvPath = isset($student->cv->path) ? asset('storage/' . $student->cv->path) : null;
                    @endphp

                    @if($cvPath)
                        {{-- Sử dụng iframe để nhúng PDF --}}
                        {{-- Đảm bảo bạn có cơ chế lưu trữ và truy cập file CV phù hợp --}}
                        <iframe src="{{ $cvPath }}" width="100%" height="1000px" style="border: none;">
                            Trình duyệt của bạn không hỗ trợ hiển thị PDF. <a href="{{ $cvPath }}" target="_blank">Tải CV về</a>.
                        </iframe>
                        {{-- Hoặc bạn có thể sử dụng một thư viện xem PDF JS nếu cần --}}
                    @else
                        <p class="text-muted ms-3 mt-3">Không tìm thấy file CV.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Cột phải (4 phần) --}}
        <div class="col-md-4">
            {{-- Thông tin ứng viên --}}
            <div class="card mb-4 overflow-y-auto" style="max-height: 100vh;">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin ứng viên</h5>
                </div>
                <div class="card-body">
                    {{-- Hiển thị thông tin từ biến $student --}}
                    @if($student)
                        <div class="d-flex flex-column gap-3 mb-3">
                            <div class="d-flex justify-content-between gap-2">
                                <form action="{{ route('company.markResume', ['job_id' => $job_id, 'student_id' => $student->id]) }}" method="POST" class="w-50">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-check me-2"></i>Phù hợp
                                    </button>
                                </form>

                                <form action="{{ route('company.markResume', ['job_id' => $resume->application->job_id, 'student_id' => $student->id]) }}" method="POST" class="w-50">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="fas fa-times me-2"></i>Từ chối
                                    </button>
                                </form>
                            </div>

                            <div class="d-flex justify-content-between gap-2">
                                <div class="w-50">
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#scoreModal">
                                        <i class="fas fa-star me-2"></i>Chấm điểm
                                    </button>

                                    <!-- Modal chấm điểm -->
                                    <div class="modal modal-xl fade" id="scoreModal" tabindex="-1" aria-labelledby="scoreModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="scoreModalLabel">Chấm điểm CV</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('company.markResumeScore', ['job_id' => $job_id, 'student_id' => $student->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="score" class="form-label">Điểm đánh giá (0-100%)</label>
                                                            <input type="number" step="0.01" class="form-control" id="score" name="score" min="0" max="100" required value="{{ $resume->application->score ?? '' }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="review" class="form-label">Nhận xét</label>
                                                            <textarea class="form-control" id="review" name="review" rows="10" required>{{ $resume->application->review ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Lưu đánh giá</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('company.evaluate', ['job_id' => $job_id, 'student_id' => $student->id]) }}" method="POST" class="w-50">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info w-100 text-white">
                                        <i class="fas fa-robot me-2"></i>Đánh giá AI
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p><strong>Họ tên:</strong> {{ $student->name ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $student->email ?? 'N/A' }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $student->phone ?? 'N/A' }}</p>
                        {{-- Giả sử có quan hệ major --}}
                        <p><strong>Chuyên ngành:</strong> {{ $student->major->name ?? 'N/A' }}</p>
                        {{-- Giả sử có thông tin kỹ năng --}}
                        <p><strong>Kỹ năng:</strong>
                            @forelse($student->skills ?? [] as $skill)
                                <span class="badge bg-secondary">{{ $skill->name }}</span>
                            @empty
                                N/A
                            @endforelse
                        </p>
                        <p><strong>Thư giới thiệu:</strong><br>
                            {!! nl2br(e($application->cover_letter ?? 'N/A')) !!}
                    @else
                        <p class="text-muted">Không có thông tin ứng viên.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal chi tiết đánh giá AI (hiện tự động nếu có score và review trong session) --}}
@if(session('score') && session('review'))
    <div class="modal modal-xl fade" id="aiScoreModal" tabindex="-1" aria-labelledby="aiScoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered animate__animated animate__fadeInDown">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-gradient-info text-white" style="background: linear-gradient(90deg,#36cfc9,#1890ff);">
                    <h5 class="modal-title" id="aiScoreModalLabel">
                        <i class="fas fa-robot me-2"></i>Đánh giá AI về CV ứng viên
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-star text-warning fs-2 me-2"></i>
                        <span class="fs-4 fw-bold text-success">{{ session('score') }}%</span>
                    </div>
                    <div class="alert alert-info border-0 shadow-sm" style="white-space: pre-line;">
                        <strong>Nhận xét AI:</strong><br><span id="ai-review"></span>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary me-2" id="skip-typewriter">Bỏ qua</button>
                    <button type="button" class="btn btn-info text-white" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var aiScoreModal = new bootstrap.Modal(document.getElementById('aiScoreModal'));
            aiScoreModal.show();

            // Hiệu ứng gõ chữ cho nhận xét AI
            var reviewText = @json(session('review'));
            var reviewContainer = document.getElementById('ai-review');
            var i = 0;
            var typing = true;
            var typewriterTimeout;

            function typeWriter() {
                if (i < reviewText.length && typing) {
                    reviewContainer.innerHTML += reviewText.charAt(i) === '\n' ? '<br>' : reviewText.charAt(i);
                    i++;
                    typewriterTimeout = setTimeout(typeWriter, 20); // tốc độ gõ
                }
            }
            if (reviewContainer && reviewText) {
                typeWriter();
            }

            // Xử lý nút "Bỏ qua"
            var skipBtn = document.getElementById('skip-typewriter');
            if (skipBtn) {
                skipBtn.addEventListener('click', function() {
                    typing = false;
                    clearTimeout(typewriterTimeout);
                    // Hiện toàn bộ nhận xét ngay lập tức
                    reviewContainer.innerHTML = reviewText.replace(/\n/g, '<br>');
                });
            }
        });
    </script>
@endif

@endsection
