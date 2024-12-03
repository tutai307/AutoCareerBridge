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
            display: none; /* Ẩn spinner khi chưa tải */
            position: absolute; /* Đặt spinner ra ngoài vị trí mặc định */
            left: 50%; /* Đặt nó cách từ trái sang 50% */
            transform: translate(-50%, -50%); /* Dịch chuyển spinner về chính giữa */
            z-index: 1000; /* Đảm bảo spinner nằm trên các phần tử khác */
        }


    </style>
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-titles">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Trung tâm thông báo</li>
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
                <a href="{{route('notifications.seen')}}" class="text-secondary" id="mark-all-read">Đánh dấu tất cả đã
                    đọc</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush" id="notification-list">
                    @forelse ($notifications as $notification)
                        <li class="list-group-item-1 {{ $notification->is_seen == 1 ? 'read' : '' }}">
                            <div>
                                <h5 class="mb-1">
                                    <a href="{{ $notification->link ?? '#' }}" class="notification-link"
                                       onclick="changeStatus({{ $notification->id }})">{{ $notification->title }}</a>
                                </h5>
                                <small class="text-muted">{{ $notification->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <a class="delete-notification" href="#" onclick="delNotification(event, {{ $notification->id }})">&times;</a>
                        </li>
                    @empty
                        <li class="list-group-item-1 text-center">
                            <h5 class="mb-1 text-muted">Không có thông báo</h5>
                        </li>
                    @endforelse
                </ul>
                <div id="loading">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        function delNotification(event, notificationId) {
            fetch(`/notifications/destroy/${notificationId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => response.json())
                .then(data => {
                    if (data.error) {
                        return Toast.fire({
                            icon: "error",
                            title: data.error
                        });
                    }
                    // Xoá thông báo khỏi giao diện sau khi xóa thành công
                    event.target.closest('.list-group-item-1').remove();
                })
                .catch(error => {
                    Toast.fire({
                        icon: "error",
                        title: error.message
                    });
                });
        }

        let page = 1;
        var notificationList = document.getElementById('notification-list');
        const loadingIndicator = document.getElementById('loading');


        // Tải thêm thông báo khi cuộn xuống cuối
        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                page++;
                if (page > {{$notifications->lastPage()}}) return;

                // Hiển thị spinner khi bắt đầu tải dữ liệu
                loadingIndicator.style.display = 'block';

                fetch(`/notifications?page=${page}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.length) {
                            data.forEach(notification => {
                                const listItem = document.createElement('li');
                                listItem.className = `list-group-item-1 ${notification.is_seen ? 'read' : ''}`;
                                listItem.innerHTML = `
                                <div>
                                    <h5 class="mb-1"><a href="${notification.link}" class="notification-link" onclick="changeStatus(${ notification.id })">${notification.title}</a></h5>
                                    <small class="text-muted">${new Date(notification.created_at).toLocaleString()}</small>
                                </div>
                                <a class="delete-notification" href="#" onclick="delNotification(event, ${notification.id})">&times;</a>
                            `;
                                notificationList.appendChild(listItem);
                            });
                        }

                        // Ẩn spinner khi tải dữ liệu xong
                        loadingIndicator.style.display = 'none';
                    })
                    .catch(() => {
                        loadingIndicator.style.display = 'none';
                        alert('Có lỗi xảy ra trong quá trình tải dữ liệu!');
                    });
            }
        });

    </script>
@endsection
