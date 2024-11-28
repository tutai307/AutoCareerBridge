@extends('management.layout.main')
@section('content')
    <style>
        .list-group-item {
            border: none;
            padding: 20px;
            background: #f9f9f9; /* Nền xám nhạt cho thông báo chưa đọc */
            margin-bottom: 5px;
            border-radius: 8px;
            transition: background 0.3s ease;
            color: #495057; /* Màu xám đậm hơn cho thông báo chưa đọc */
        }

        .list-group-item.read {
            background: white; /* Nền trắng cho thông báo đã đọc */
            color: #6c757d; /* Màu xám nhạt cho thông báo đã đọc */
            opacity: 0.5; /* Làm cho chữ mờ đi khi thông báo đã đọc */
        }

        .list-group-item:hover {
            background: #e0f7fa;
        }

        .badge {
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 12px;
        }

        .bg-primary {
            background-color: #007bff;
            color: white;
        }

        .bg-secondary {
            background-color: #6c757d;
            color: white;
        }

        #mark-all-read {
            text-decoration: none; /* Mặc định không có gạch dưới */
        }

        #mark-all-read:hover {
            text-decoration: underline; /* Thêm gạch dưới khi di chuột vào */
        }

        /* Định dạng cho link */
        .notification-link {
            text-decoration: none;
            color: #007bff;
        }

        .notification-link:hover {
            text-decoration: underline;
        }

    </style>
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-titles">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Trung tâm thông báo</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Danh sách thông báo</h4>
                <a href="javascript:void(0)" class="text-secondary" id="mark-all-read">Đánh dấu tất cả đã đọc</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1"><a href="#" class="notification-link">Cập nhật hệ thống</a></h5>
                            <small class="text-muted">27/11/2024 09:00</small>
                        </div>
                    </li>
                    <li class="list-group-item read d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1"><a href="#" class="notification-link">Chào mừng!</a></h5>
                            <small class="text-muted">25/11/2024 14:30</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1"><a href="#" class="notification-link">Lịch bảo trì hệ thống</a></h5>
                            <small class="text-muted">24/11/2024 16:00</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection
