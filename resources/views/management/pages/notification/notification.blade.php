@extends('management.layout.main')
@section('content')
    <style>
        #mark-all-read {
            text-decoration: none;
        }

        #mark-all-read:hover {
            text-decoration: underline;
        }

        /* Định vị dấu x để xóa thông báo */
        .delete-notification {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            cursor: pointer;
            color: #dc3545;
        }

        .delete-notification:hover {
            color: #c82333;
        }

        #loading {
            display: none;
            /* Ẩn spinner khi chưa tải */
            position: absolute;
            /* Đặt spinner ra ngoài vị trí mặc định */
            left: 50%;
            /* Đặt nó cách từ trái sang 50% */
            transform: translate(-50%, -50%);
            /* Dịch chuyển spinner về chính giữa */
            z-index: 1000;
            /* Đảm bảo spinner nằm trên các phần tử khác */
        }

        .table-container {
            max-height: 550px;
            overflow-y: auto;
        }

        .table-container table {
            width: 100%;
        }

        .table-header th {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .card-body {
            padding-top: 0;
        }
    </style>
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-titles">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('company.home') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Danh sách thông báo</li>
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
                <a href="{{ route('notifications.seen') }}" class="btn btn-primary" id="mark-all-read">Đánh dấu tất cả đã
                    đọc</a>
            </div>
            <div class="card-body table-container ">
                <table class="table table-striped table-sticky">
                    <thead class="table-header">
                        <tr>
                            <th>#</th>
                            <th>Tiêu đề</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="notification-list">
                        @forelse ($notifications as $key => $noty)
                            <tr>
                                <td>{{ $key + 1 + ($notifications->currentPage() - 1) * $notifications->perPage() }}</td>
                                <td><a href="{{ url($noty->link) }}">{{ $noty->title }}</a></td>
                                <td>{{ $noty->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if ($noty->is_seen == 1)
                                        <span class="badge bg-success">Đã đọc</span>
                                    @else
                                        <span class="badge bg-danger">Chưa đọc</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove" data-type="POST"
                                        href="javascript:void(0)"
                                        data-url="{{ route('notifications.destroy', $noty->id) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Không có thông báo nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="loading" style="display: none; text-align: center;">
                    <span>Đang tải...</span>
                </div>

            </div>
        </div>
    </div>

    <script>
        let page = 1; // Trang hiện tại
        const notificationList = document.getElementById('notification-list');
        const tableContainer = document.querySelector('.table-container'); // Container cuộn
        const loadingIndicator = document.getElementById('loading');

        // Xử lý sự kiện cuộn
        tableContainer.addEventListener('scroll', () => {
            // Kiểm tra xem đã cuộn đến cuối container hay chưa
            if (tableContainer.scrollTop + tableContainer.clientHeight >= tableContainer.scrollHeight) {
                page++;

                // Dừng nếu vượt qua trang cuối cùng
                if (page > {{ $notifications->lastPage() }}) return;

                // Hiển thị spinner
                loadingIndicator.style.display = 'block';

                fetch(`/notifications?page=${page}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.length > 0 && data.length) {
                            data.length > 0 && data.forEach((notification, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                            <td>${index + 1 + (page - 1) * {{ $notifications->perPage() }}}</td>
                            <td><a href="${notification.link}">${notification.title}</a></td>
                            <td>${new Date(notification.created_at).toLocaleDateString()}</td>
                            <td>
                                ${
                                    notification.is_seen
                                        ? '<span class="badge bg-success">Đã đọc</span>'
                                        : '<span class="badge bg-danger">Chưa đọc</span>'
                                }
                            </td>
                            <td class="text-center">
                                <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove" href="javascript:void(0)" onclick="delNotification(event, ${notification.id})">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        `;
                                notificationList.appendChild(row);
                            });
                        }

                        // Ẩn spinner
                        loadingIndicator.style.display = 'none';
                    })
                    .catch(() => {
                        loadingIndicator.style.display = 'none';
                        alert('Có lỗi xảy ra khi tải dữ liệu!');
                    });
            }
        });
    </script>
@endsection
