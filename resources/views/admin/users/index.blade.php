@extends('management.layout.main')

@section('title', 'Danh sách tài khoản')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách tài khoản</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-sharp fa-solid fa-filter me-2"></i>Lọc
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <form method="GET" action="{{ route('admin.users.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6">
                                            <label class="form-label">Tên đăng nhập hoặc email</label>
                                            <input type="text" class="form-control mb-xl-0 mb-3" name="search"
                                                value="{{ request()->search }}" placeholder="Tìm kiếm...">
                                        </div>

                                        <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                            <label class="form-label">Vai trò</label>
                                            <select name="role" class="form-control default-select h-auto wide">
                                                <option value="all">Chọn vai trò</option>
                                                <option value="{{ ROLE_SUB_ADMIN }}"
                                                    {{ request()->role == ROLE_SUB_ADMIN ? 'selected' : '' }}>Sub Admin
                                                </option>
                                                <option value="{{ ROLE_UNIVERSITY }}"
                                                    {{ request()->role == ROLE_UNIVERSITY ? 'selected' : '' }}>Trường
                                                    học</option>
                                                <option value="{{ ROLE_COMPANY }}"
                                                    {{ request()->role == ROLE_COMPANY ? 'selected' : '' }}>Doanh
                                                    nghiệp</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                            <label class="form-label">Trạng thái</label>
                                            <select name="active" class="form-control default-select h-auto wide">
                                                <option value="all" selected>Chọn trạng thái</option>
                                                <option value="{{ ACTIVE }}"
                                                    {{ request()->active === strval(ACTIVE) ? 'selected' : '' }}>Kích hoạt</option>
                                                <option value="{{ INACTIVE }}"
                                                    {{ request()->active == INACTIVE ? 'selected' : '' }}>Chưa kích hoạt
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-xl-2 col-sm-6">
                                            <label class="form-label">Ngày tham gia</label>
                                            <div class="input-hasicon mb-sm-0 mb-3">
                                                <input type="date" name="date" class="form-control"
                                                    value="{{ request()->date }}">
                                                <div class="icon"><i class="far fa-calendar"></i></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-sm-6 align-self-end">
                                            <div>
                                                <button class="btn btn-primary me-2" title="Click here to Search"
                                                    type="submit">
                                                    <i class="fa-sharp fa-solid fa-filter me-2"></i>Tìm kiếm
                                                </button>
                                                <button class="btn btn-danger light" title="Click here to remove filter"
                                                    type="button"
                                                    onclick="window.location.href='{{ route('admin.users.index') }}'">
                                                    Xóa
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card quick_payment">
                        <div class="card-header border-0 pb-2 d-flex justify-content-between">
                            <h2 class="card-title">Danh sách tài khoản</h2>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-success">Thêm mới</a>
                        </div>
                        <div class="card-body p-0">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên đăng nhập</th>
                                                <th>Email</th>
                                                <th>Vai trò</th>
                                                <th>Trạng thái</th>
                                                <th>Ngày tham gia</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $user)
                                                <tr>
                                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                                    <td>
                                                        <span class="w-space-no">{{ $user->user_name }}</span>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if ($user->role == ROLE_SUB_ADMIN)
                                                            <span class="badge bg-info">Sub Admin</span>
                                                        @elseif($user->role == ROLE_UNIVERSITY)
                                                            <span class="badge bg-secondary">Trường học</span>
                                                        @elseif($user->role == ROLE_COMPANY)
                                                            <span class="badge bg-warning">Doanh nghiệp</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($user->active == ACTIVE)
                                                                <span class="badge bg-success">Kích hoạt</span>
                                                            @else
                                                                <span class="badge bg-danger">Chưa kích hoạt</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $user->created_at->format('d/m/Y') }}
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                    class="fa fa-pencil"></i></a>
                                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Không có người dùng nào.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                {{ $users->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
