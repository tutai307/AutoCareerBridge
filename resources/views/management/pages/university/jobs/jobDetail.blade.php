@extends('management.layout.main')
@section('content')
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-titles">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chi tiết bài đăng</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Chi tiết bài đăng -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Chi tiết bài đăng</h5>
                </div>
                <form action="{{route('university.job.apply')}}" id="jobForm" method="POST">
                    <div class="card-body">

                        @csrf
                        @method('POST')
                        <div class="row">
                            <!-- Cột bên trái -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tiêu đề bài đăng</label>
                                    <input type="text" class="form-control" name="name" value="{{$data->name}}"
                                           disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Doanh nghiệp</label>
                                    <div class="d-flex flex-column">
                                        <!-- Trường Doanh nghiệp -->
                                        <input type="text" class="form-control mb-2" name="company_name"
                                               value="{{$data->company_name}}" disabled>
                                        <!-- Ảnh Doanh nghiệp -->
                                        <div>
                                            <img id="company_avatar_path"
                                                 src="{{$data->company_avatar_path}}"
                                                 alt="Doanh nghiệp" class="img-fluid" style="max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày hết hạn</label>
                                    <input type="text" class="form-control" name="end_date" value="{{$data->end_date}}"
                                           disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Skill yêu cầu</label>
                                    <input type="text" class="form-control" name="skills" value="{{$data->skills}}"
                                           disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Chuyên ngành yêu cầu</label>
                                    <input type="text" class="form-control" name="major_name"
                                           value="{{$data->major_name}}"
                                           disabled>
                                </div>
                            </div>

                            <!-- Cột bên phải -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nội dung bài đăng</label>
                                    <div class="content"
                                         style="max-height: 630px; overflow-y: auto; background-color: #E6EBEE; border-radius: 10px; padding: 10px; color: #333333; font-weight: normal;">
                                        <!-- Nội dung HTML của bạn sẽ được đưa vào đây -->
                                        <div class="mb-3 detailJobs">
                                            {!! $data->detail !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <input type="hidden" name="checkApply" value="{{$checkApply}}">
                    <div class="card-footer text-end" id="buttonSubmit">
                        @if (\Carbon\Carbon::parse($data->end_date)->isPast())
                            <p class="text-danger">Đã hết hạn ứng tuyển</p>
                        @else
                            @if(!$checkApply)
                                <button type="button" class="btn btn-light"
                                        onclick="window.location.href='{{route('notifications')}}'" id="btnReject">Bỏ
                                    qua
                                </button>
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Ứng tuyển</button>
                            @elseif($checkApply->status == 1)
                                <p class="text-warning">Đã ứng tuyển</p>
                            @elseif($checkApply->status == 2)
                                <p class="text-success">Đã được chấp nhận</p>
                            @elseif($checkApply->status == 3)
                                <p class="text-danger">Đã bị từ chối</p>
                            @endif

                        @endif
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
