@extends('management.layout.main')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Quản lý hồ sơ</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="profile-info">
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">Nhân viên quản trị</h4>
                                <p>Email</p>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0">Nguyễn Ngọc Tú Tài</h4>
                                <p>tainnjvb@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="clearfix">
                <div class="card card-bx profile-card author-profile m-b30">
                    <div class="card-body">
                        <div class="p-5">
                            <div class="author-profile">
                                <div class="author-media">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyxUPzKI3yNIPNn2ePoncuxFLMjNhJ20NKBQ&s"
                                        alt="">
                                    <div class="upload-link" title="" data-toggle="tooltip" data-placement="right"
                                        data-original-title="update">
                                        <input type="file" class="update-flie">
                                        <i class="fa fa-camera"></i>
                                    </div>
                                </div>
                                <div class="author-info">
                                    <h6 class="title">Trường Đại Học Công Nghiệp Hà Nội</h6>
                                    <span>haui@edu.comm</span>
                                </div>
                            </div>
                        </div>
                        <div class="info-list">
                            <ul>
                                <li><a href="#">Quy mô</a><span>3500</span></li>
                                <li><a href="#">Chương trình đào tạo</a><span>12</span></li>
                                <li><a href="#">Trạng thái</a><span>Hoạt động</span></li>
                                <li><a href="#">Doanh nghiệp cộng tác</a><span>30</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="input-group mb-3">
                            <div class="form-control rounded text-center">Trang web nhà trường</div>
                        </div>
                        <div class="input-group">
                            <a href="https:/haui.edu.vn/" target="_blank"
                                class="form-control text-primary rounded text-center">https:/haui.edu.vn/</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card profile-card card-bx m-b30">
                <div class="card-header">
                    <h6 class="text-primary card-title">Thông tin hồ sơ trường</h6>
                </div>
                <form class="profile-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 m-b20">
                                <label class="form-label text-primary">Giới thiệu</label>
                                <p>Trường Đại học Công nghiệp Hà Nội có bề dày lịch sử 125 năm xây dựng và phát triển, tiền thân là hai trường: Trường Chuyên nghiệp Hà Nội (thành lập năm 1898) và Trường Chuyên nghiệp Hải Phòng (thành lập năm 1913). Qua nhiều lần sáp nhập, đổi tên, nâng cấp từ trường Trung học Công nghiệp I lên Trường Cao đẳng Công nghiệp Hà Nội và Trường Đại học Công nghiệp Hà Nội. Trải qua hơn 120 năm, ở giai đoạn nào, Trường cũng luôn được đánh giá là cái nôi đào tạo cán bộ kỹ thuật, cán bộ kinh tế hàng đầu của cả nước, nhiều cựu học sinh của Trường đã trở thành lãnh đạo cấp cao của Đảng, Nhà nước đã đi vào lịch sử như: Hoàng Quốc Việt, Nguyễn Thanh Bình, Phạm Hồng Thái, Lương Khánh Thiện...; nhiều cựu học sinh, sinh viên trở thành các cán bộ nòng cốt, nắm giữ các cương vị trọng trách của Đảng, Nhà nước, các Bộ, Ban, Ngành Trung Ương và địa phương.</p>
                            </div>
                            <div class="col-sm-12 m-b20">
                                <label class="form-label text-primary">Mô tả</label>
                                <p style="white-space: pre-wrap;">Tổng số sinh viên đang theo học: 32.000 - 34.000 người                                                                     
Số sinh viên đại học chính quy đang theo học: 25.447 người
Số sinh viên sau đại học (cao học, NCS hoặc tương đương) đang theo học: 558 người
Số sinh viên cao đẳng chính quy đang theo học: 601 người
Tỷ lệ sinh viên chính quy ra trường có việc làm sau 12 tháng kể từ ngày tốt nghiệp: 92,14%
Tỷ lệ sinh viên ĐH chính quy ra trường có việc làm sau 12 tháng kể từ ngày tốt nghiệp: 92,78%
Tỷ lệ sinh viên CĐ chính quy ra trường có việc làm sau 12 tháng kể từ ngày tốt nghiệp: 90,61%
                                </p>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label text-primary">Địa chỉ</label>
                                <p style="white-space: pre-wrap;">Trụ sở chính: Số 298 đường Cầu Diễn, quận Bắc Từ Liêm, thành phố Hà Nội.
Cơ sở 2: Phường Tây Tựu, quận Bắc Từ Liêm, thành phố Hà Nội.
Cơ sở 3: Phường Lê Hồng Phong , xã Phù Vân, thành phố Phủ Lý, tỉnh Hà Nam.
                                </p>
                            </div>
                        </div>
                    </div>
                    {{-- Include update blade --}}

                    <div class="card-footer">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                            data-bs-target=".modal_update_university">Cập nhật thông tin</button>
                    </div>
                    @include('management.university.profile.update')
                </form>
            </div>
        </div>
    </div>
@endsection
