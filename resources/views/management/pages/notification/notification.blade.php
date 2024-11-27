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
            position: relative;
        }

        .list-group-item.read {
            background: white;
            color: #6c757d;
            opacity: 0.5;
        }

        .list-group-item:hover {
            background: #e0f7fa;
        }

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

        #loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
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
                <a href="{{route('notifications.seen')}}" class="text-secondary" id="mark-all-read">Đánh dấu tất cả đã đọc</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush" id="notification-list">
                    @forelse ($notifications as $notification)
                        <li class="list-group-item {{ $notification->is_seen == 1 ? 'read' : '' }}">
                            <div>
                                <h5 class="mb-1">
                                    <a href="{{ $notification->link ?? '#' }}"
                                       class="notification-link" onclick="changeStatus({{ $notification->id }})">{{ $notification->title }}</a>
                                </h5>
                                <small class="text-muted">{{ $notification->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <span class="delete-notification" data-id="{{ $notification->id }}">&times;</span>
                        </li>
                    @empty
                        <li class="list-group-item text-center">
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
        let page = 1;
        const notificationList = document.getElementById('notification-list');
        const loadingIndicator = document.getElementById('loading'); // Spinner

        // Xóa thông báo khi nhấn vào dấu "x"
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-notification')) {
                const notificationId = e.target.getAttribute('data-id');
                fetch(`/notifications/destroy/${notificationId}`, {
                    method: 'DELETE',
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                }).then(response => response.json())
                    .then(data => {
                        if (data.error) {

                            return Toast.fire({
                                icon: "error",
                                title: data.error
                            });
                        }
                        e.target.closest('.list-group-item').remove();
                    })
                    .catch(error => {
                        Toast.fire({
                            icon: "error",
                            title: error.message
                        });
                    })
                ;
            }
        });

        // Tải thêm thông báo khi cuộn xuống cuối
        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                page++;
                if (page > {{$notifications->lastPage()}}) return

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
                                listItem.className = `list-group-item ${notification.is_seen ? 'read' : ''}`;
                                listItem.innerHTML = `
                                <div>
                                    <h5 class="mb-1"><a href="${notification.link}" class="notification-link">${notification.title}</a></h5>
                                    <small class="text-muted">${new Date(notification.created_at).toLocaleString()}</small>
                                </div>
                                <span class="delete-notification" data-id="${notification.id}">&times;</span>
                            `;
                                notificationList.appendChild(listItem);
                            });
                        }

                        // Ẩn spinner khi tải dữ liệu xong
                        loadingIndicator.style.display = 'none';
                    })
                    .catch(() => {
                        // Ẩn spinner nếu có lỗi
                        loadingIndicator.style.display = 'none';
                        alert('Có lỗi xảy ra trong quá trình tải dữ liệu!');
                    });
            }
        });

        async function changeStatus(id){
            fetch(`/notifications/seen?id=${id}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                })
                .catch(err =>{
                    console.error(err)
                })
        }
    </script>
@endsection
