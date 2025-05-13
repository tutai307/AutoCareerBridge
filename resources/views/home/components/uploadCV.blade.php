<!-- Modal -->
<form action="{{route('home.applyJob')}}" method="POST">
    @csrf
    <input type="hidden" name="job_id" value="{{ $job->id }}">
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Ứng tuyển <strong class="text-primary">{{ $job->name }}</strong>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          <!-- Chọn CV -->
          <div class="mb-3">
            <label class="form-label fw-bold">Chọn CV để ứng tuyển</label>
            <div class="border rounded-3 p-3 mb-2 cv-option active" data-bs-toggle="collapse" data-bs-target="#cv1Content">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="cvOption" id="cv1" checked>
                <input type="hidden" name="resume_id" value="{{ $resumes->where('is_main', true)->first()->id }}" id="main_cv_id">
                <label class="form-check-label" for="cv1">
                  <strong class="text-primary">CV ứng tuyển gần nhất:</strong> {{ $resumes->where('is_main', true)->first()->title }}
                </label>
              </div>
            </div>
            <div class="collapse show" id="cv1Content">
              <div class="ms-4 small border-start ps-3">
                @php
                    $user = Auth::guard('student')->user();
                @endphp
                <div><strong>Họ và tên:</strong> {{ $user->name }}</div>
                <div><strong>Email:</strong> {{ $user->email }}</div>
                <div><strong>Số điện thoại:</strong> {{ $user->phone }}</div>
              </div>
            </div>

            <div class="border rounded-3 p-3 mb-2 cv-option" data-bs-toggle="collapse" data-bs-target="#cv2Content">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="cvOption" id="cv2">
                    <label class="form-check-label" for="cv2">Chọn CV khác trong thư viện CV của tôi</label>
                </div>
            </div>
            <div class="collapse" id="cv2Content">
              <div class="ms-4 small border-start ps-3">
                @if($resumes->count() > 0)
                  @foreach($resumes as $resume)
                    <div class="d-flex align-items-center mb-3 p-2 border rounded hover-shadow">
                      <div class="form-check flex-grow-1">
                        <input class="form-check-input" type="radio" name="resume_id" id="cv_{{$resume->id}}" value="{{$resume->id}}">
                        <label class="form-check-label d-flex align-items-center" for="cv_{{$resume->id}}">
                          <i class="fas fa-file-pdf text-danger me-2"></i>
                          <div>
                            <div class="fw-bold">{{$resume->title}}</div>
                            <small class="text-muted">Cập nhật: {{ \Carbon\Carbon::parse($resume->updated_at)->format('d/m/Y') }}</small>
                          </div>
                        </label>
                      </div>
                      @if($resume->is_main)
                        <span class="badge bg-primary ms-2">CV Chính</span>
                      @endif
                    </div>
                  @endforeach
                @else
                  <div class="text-center text-muted py-3">
                    <i class="fas fa-folder-open mb-2" style="font-size: 2rem;"></i>
                    <p class="mb-0">Bạn chưa có CV nào trong thư viện</p>
                  </div>
                @endif
              </div>
            </div>
          </div>

          <!-- Thư giới thiệu -->
          <div class="mb-3">
            <label class="form-label fw-bold text-primary">Thư giới thiệu:</label>
            <label class="small">Một thư giới thiệu ngắn gọn, chỉn chu sẽ giúp bạn trở nên chuyên nghiệp và gây ấn tượng hơn với nhà tuyển dụng.</label>
            <textarea class="form-control" name="cover_letter" rows="5"></textarea>
          </div>

          <!-- Lưu ý -->
          <div class="alert alert-warning small">
            <strong>🔺 Lưu ý:</strong><br>
            1. Auto Career Bridge khuyên tất cả các bạn hãy luôn cẩn trọng trong quá trình tìm việc và chủ động nghiên cứu về thông tin công ty, vị trí việc làm trước khi ứng tuyển. <br>
            2. Ứng viên cần có trách nhiệm với hành vi ứng tuyển của mình. Nếu bạn gặp phải tin tuyển dụng hoặc nhận được liên lạc đáng ngờ, hãy báo cáo qua email <a href="mailto:tutai.dev@gmail.com">tutai.dev@gmail.com</a>. <br>
            3. Tìm hiểu thêm kinh nghiệm phòng tránh lừa đảo <a href="#">tại đây</a>.
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Nộp hồ sơ ứng tuyển</button>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const radioButtons = document.querySelectorAll('input[name="cvOption"]');
    const cvOptions = document.querySelectorAll('.cv-option');

    // Khởi tạo với trạng thái ban đầu
    updateActiveClass();

    // Thêm sự kiện cho các nút radio
    radioButtons.forEach(radio => {
      radio.addEventListener('change', updateActiveClass);
    });

    // Thêm sự kiện click cho các div cv-option
    cvOptions.forEach((option, index) => {
      option.addEventListener('click', function() {
        radioButtons[index].checked = true;
        updateActiveClass();
      });
    });

    function updateActiveClass() {
      cvOptions.forEach((option, index) => {
        if (radioButtons[index].checked) {
          option.classList.add('active');
          option.classList.add('border-primary');
        } else {
          option.classList.remove('active');
          option.classList.remove('border-primary');
        }
      });
    }
  });
</script>

