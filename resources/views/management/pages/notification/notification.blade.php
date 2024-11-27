@extends('management.layout.main')
@section('content')
    <style>
        .list-group-item {
            border: none;
            padding: 20px;
            background: #f9f9f9;
            margin-bottom: 5px;
            border-radius: 8px;
            transition: background 0.3s ease;
            color: #495057;
            position: relative; /* Thêm để đặt dấu "x" bên trong */
        }

        .list-group-item.read {
            background: white;
            color: #6c757d;
            opacity: 0.5;
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
            text-decoration: none;
        }

        #mark-all-read:hover {
            text-decoration: underline;
        }

        .notification-link {
            text-decoration: none;
            color: #007bff;
        }

        .notification-link:hover {
            text-decoration: underline;
        }

        /* Xóa thông báo (nút "x") */
        .delete-notification {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #dc3545;
            cursor: pointer;
            font-size: 20px;
        }

        .delete-notification:hover {
            color: #c82333;
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
                <ul class="list-group list-group-flush" id="notification-list">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1"><a href="#" class="notification-link">Cập nhật hệ thống</a></h5>
                            <small class="text-muted">27/11/2024 09:00</small>
                        </div>
                        <span class="delete-notification">&times;</span>
                    </li>
                    <li class="list-group-item read d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1"><a href="#" class="notification-link">Chào mừng!</a></h5>
                            <small class="text-muted">25/11/2024 14:30</small>
                        </div>
                        <span class="delete-notification">&times;</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1"><a href="#" class="notification-link">Lịch bảo trì hệ thống</a></h5>
                            <small class="text-muted">24/11/2024 16:00</small>
                        </div>
                        <span class="delete-notification">&times;</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Xóa thông báo khi nhấn vào dấu "x"
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-notification')) {
                const notificationItem = e.target.closest('.list-group-item');
                notificationItem.remove();
            }
        });

        // Kéo thông báo sang phải để xóa
        document.querySelectorAll('.list-group-item').forEach(item => {
            let isDragging = false;
            let startX = 0;

            item.addEventListener('mousedown', e => {
                isDragging = true;
                startX = e.clientX;
            });

            item.addEventListener('mousemove', e => {
                if (isDragging) {
                    const offset = e.clientX - startX;
                    item.style.transform = `translateX(${offset}px)`;
                }
            });

            item.addEventListener('mouseup', e => {
                if (isDragging) {
                    const offset = e.clientX - startX;
                    if (offset > 100) {
                        item.remove();
                    } else {
                        item.style.transform = 'translateX(0)';
                    }
                    isDragging = false;
                }
            });
        });
    </script>
@endsection
