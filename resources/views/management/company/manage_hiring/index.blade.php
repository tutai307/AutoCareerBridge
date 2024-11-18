@extends('management.layout.main')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="page-titles">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Doanh nghiệp</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lí nhân viên</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="col-xl-12">
        <div class="filter cm-content-box box-primary">
            <div class="cm-content-body form excerpt" style="">
                <form action="/company/manage-hiring" method="GET">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-xl-3 col-sm-6">
                                <label class="form-label">Tên</label>
                                <input type="text" class="form-control mb-xl-0 mb-3" value="{{ request('searchName') }}" name="searchName" id="searchName" placeholder="Name">
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control mb-xl-0 mb-3" value="{{ request('searchEmail') }}" name="searchEmail" id="searchEmail" placeholder="Email">
                            </div>
                            <div class="col-xl-3 col-sm-6 align-self-end">
                                <div>
                                    <button class="btn btn-primary me-2" title="Click here to Search" id="searchButton"><i class="fa-sharp fa-solid fa-filter me-2"></i>Tìm kiếm</button>
                                    <a href="/company/manage-hiring"><button class="btn btn-danger light" title="Click here to remove filter" type="button" id="removeFilter">Xóa tìm kiếm</button></a>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="col-lg-12">
        <div class="text-end">
            <button type="button" class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                Thêm mới
            </button>
        </div>
    </div>



    <!-- Modal Add -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Thêm mới nhân viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/company/create-hiring" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="Name" class="form-label">Tên đầy đủ</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Tên" value="{{ old('full_name') }}">
                            @if ($errors->has('full_name'))
                            <div class="text-danger">{{ $errors->first('full_name') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="Name" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Tên" value="{{ old('user_name') }}">
                            @if ($errors->has('user_name'))
                            <div class="text-danger">{{ $errors->first('user_name') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                            @if ($errors->has('password'))
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu">
                            @if ($errors->has('password_confirmation'))
                            <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Cập nhật nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/company/update-hiring" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="user_id" name="user_id" value="">
                    <div class="mb-3">
                        <label for="Name" class="form-label">Tên đầy đủ</label>
                        <input type="text" class="form-control" name="full_name_update" id="full_name_update" placeholder="Tên" value="{{ old('full_name_update') }}">
                        @error('full_name_update')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Name" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="name_update" id="name_update" placeholder="Tên" value="{{ old('name_update') }}">
                        @error('name_update')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email_update" id="email_update" placeholder="name@example.com" value="{{ old('email_update') }}">
                        @error('email_update')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
<div id="card-body" class="card-body">
    @include('management.company.manage_hiring.table')

</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@if( $errors->has('user_name') || $errors->has('email') || $errors->has('password'))
<script>
    $(document).ready(function() {
        $('#addEmployeeModal').modal('show');
    });
</script>
@endif

@if( $errors->has('full_name_update') || $errors->has('name_update') || $errors->has('email_update') || $errors->has('password_update'))
<script>
    $(document).ready(function() {
        $('#editEmployeeModal').modal('show');
    });
</script>
@endif
<script>
    $(document).ready(function() {
        $('.editBtn').on('click', function() {
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: '/company/edit-hiring/' + id,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#email_update').val(data.email);
                    $('#full_name_update').val(data.hirings[0].full_name);
                    $('#name_update').val(data.user_name);
                    $('#user_id').val(data.id);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>

@endsection