        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="{{ route('home.index') }}"
                class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">AutoCB</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav me-auto p-4 p-lg-0">
                    <a href="{{ route('home.index') }}#"
                        class="nav-item nav-link {{ Request::is('home/index*') ? 'active' : '' }} ">Trang chủ</a>
                    <a href="{{ Request::is('home/index*') ? '#about' : route('home.index') . '#about' }}"
                        class="nav-item nav-link {{ Request::is('*#about') ? 'active' : '' }}">Giới thiệu</a>
                    <div class="nav-item dropdown">
                        <a href="{{ route('home.index') }}#search" class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown">Việc làm</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="{{ route('home.index') }}#search" class="dropdown-item">Tìm kiếm việc làm</a>
                            <a href="{{ route('home.index') }}#about" class="dropdown-item">Đề xuất</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="category.html" class="dropdown-item">Job Category</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="404.html" class="dropdown-item">404</a>
                        </div>
                    </div>
                    @if (Auth::guard('student')->check())
                        <a href="{{ route('home.manageCV') }}" class="nav-item nav-link">Hồ sơ & CV</a>
                    @else
                        <a href="{{ route('home.showLoginForm') }}" class="nav-item nav-link">Hồ sơ & CV</a>
                    @endif
                </div>
                @if (Auth::guard('student')->check())
                    <div class="d-flex align-items-center">
                        <!-- Notification Dropdown -->
                        <div class="position-relative me-3">
                            <a href="#" class="position-relative" data-bs-toggle="dropdown" id="notificationDropdown">
                                <i class="far fa-bell fa-lg" style="color: var(--bs-primary)"></i>
                                <span class="position-absolute translate-middle badge rounded-pill bg-danger notification-count"
                                      style="top: 35%;">0</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropleft notification-list"
                                style="width: 450px; max-height: 500px; overflow-y: auto;">
                                <li class="dropdown-header d-flex justify-content-between align-items-center p-2">
                                    <span class="fw-bold">Thông báo</span>
                                    <a href="#" class="text-primary text-decoration-none small mark-all-read">
                                        Đánh dấu đã đọc
                                    </a>
                                </li>
                                <div id="notificationItems">
                                    {{-- Thông báo sẽ được load động ở đây --}}
                                </div>
                            </ul>
                        </div>
                        <!-- User Dropdown -->
                        <div class="nav-item dropdown">
                            <a href="#" class="btn btn-primary rounded-0 py-2 px-4 d-flex align-items-center justify-content-center"
                                data-bs-toggle="dropdown">
                                {{ Auth::guard('student')->user()->name }}
                            </a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ route('manageAccount.index') }}" class="dropdown-item">
                                    <i class="fas fa-user-cog me-2"></i>Quản lý tài khoản
                                </a>
                                <form action="{{ route('home.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('home.showLoginForm') }}" class="btn btn-primary rounded-0 py-2 px-4 d-flex align-items-center justify-content-center">Đăng nhập<i
                            class="fa fa-arrow-right ms-3"></i></a>
                @endif
            </div>
        </nav>
        <!-- Navbar End -->

        @section('styles')
            <style>
                .notification-item {
                    transition: background-color 0.3s;
                }

                .notification-item.unread {
                    background-color: #f8f9fa;
                }

                .notification-item:hover {
                    background-color: #f1f1f1;
                    cursor: pointer;
                }

                .notification-time {
                    font-size: 0.8rem;
                    color: #6c757d;
                }

                .notification-content {
                    color: #666;
                    font-size: 0.9rem;
                }

                @media (max-width: 992px) {
                    .notification-list {
                        width: 300px !important;
                    }
                }

                /* Animation cho badge */
                @keyframes notification-pulse {
                    0% { transform: scale(1); }
                    50% { transform: scale(1.2); }
                    100% { transform: scale(1); }
                }

                .notification-count:not(:empty) {
                    animation: notification-pulse 1s infinite;
                }
            </style>
        @endsection

        @section('scripts')
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const notificationCount = document.querySelector('.notification-count');
                const notificationItems = document.getElementById('notificationItems');
                const markAllReadBtn = document.querySelector('.mark-all-read');
                let previousUnreadNotificationIds = new Set(); // Lưu ID của thông báo chưa đọc từ lần fetch trước (dùng Set để hiệu quả)

                function formatDate(dateString) {
                    const date = new Date(dateString);
                    const now = new Date();
                    const diff = now - date;

                    // Nếu thời gian < 24h, hiển thị "x giờ trước"
                    if (diff < 24 * 60 * 60 * 1000) {
                        const hours = Math.floor(diff / (60 * 60 * 1000));
                        if (hours < 1) {
                            const minutes = Math.floor(diff / (60 * 1000));
                            return `${minutes} phút trước`;
                        }
                        return `${hours} giờ trước`;
                    }

                    // Ngược lại hiển thị ngày tháng
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
                    const year = date.getFullYear();
                    return `${day}/${month}/${year}`;
                }

                function loadNotifications() {
                    fetch('/student/notifications')
                        .then(response => response.json())
                        .then(data => {
                            notificationCount.textContent = data.unreadCount || '';

                            const currentUnreadNotifications = data.notifications.filter(n => !n.is_read);
                            const currentUnreadIds = new Set(currentUnreadNotifications.map(n => n.id));

                            let hasNewUnread = false;
                            let latestNewNotification = null;

                            currentUnreadIds.forEach(id => {
                                if (!previousUnreadNotificationIds.has(id)) {
                                    hasNewUnread = true;
                                    // Tìm thông báo mới nhất trong số các thông báo mới chưa đọc
                                    const newNotification = currentUnreadNotifications.find(n => n.id === id);
                                    if (!latestNewNotification || new Date(newNotification.created_at) > new Date(latestNewNotification.created_at)) {
                                        latestNewNotification = newNotification;
                                    }
                                }
                            });

                            // Chỉ hiển thị toast nếu có thông báo *mới* chưa đọc
                            if (hasNewUnread && latestNewNotification) {
                                toastr.info(latestNewNotification.content, latestNewNotification.title);
                            }

                            // Cập nhật lại danh sách ID chưa đọc cho lần kiểm tra sau
                            previousUnreadNotificationIds = currentUnreadIds;

                            if (data.notifications.length === 0) {
                                notificationItems.innerHTML = `
                                    <li class="dropdown-item text-center text-muted py-3">
                                        Không có thông báo mới
                                    </li>
                                `;
                                return;
                            }

                            notificationItems.innerHTML = data.notifications.map(notification => `
                                <div class="notification-item ${notification.is_read ? '' : 'unread'}"
                                     data-notification-id="${notification.id}">
                                    <a href="${notification.action_url || '#'}"
                                       class="dropdown-item px-3 py-2 border-bottom text-wrap ${notification.is_read ? '' : 'bg-light'}"
                                       ${notification.action_url ? '' : 'onclick="return false;"'}>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="fw-bold text-break">${notification.title}</div>
                                            ${!notification.is_read ? `
                                                <span class="mark-read" data-id="${notification.id}"
                                                      data-bs-toggle="tooltip" title="Đánh dấu đã đọc">
                                                    <i class="fa fa-check text-primary"></i>
                                                </span>
                                            ` : ''}
                                        </div>
                                        <div class="notification-content text-break mt-1">
                                            ${notification.content}
                                        </div>
                                        <div class="notification-time mt-2">
                                            ${(notification.created_at)}
                                        </div>
                                    </a>
                                </div>
                            `).join('');

                            // Khởi tạo tooltips
                            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                            tooltipTriggerList.map(function (tooltipTriggerEl) {
                                return new bootstrap.Tooltip(tooltipTriggerEl);
                            });
                        })
                        .catch(error => {
                            console.error('Error loading notifications:', error);
                            notificationItems.innerHTML = `
                                <li class="dropdown-item text-center text-danger py-3">
                                    Đã có lỗi xảy ra khi tải thông báo
                                </li>
                            `;
                            toastr.error('Đã có lỗi xảy ra khi tải thông báo', 'Lỗi');
                        });
                }

                // Load notifications khi mở dropdown
                document.getElementById('notificationDropdown').addEventListener('click', function(e) {
                    e.preventDefault();
                    loadNotifications();
                });

                // Đánh dấu một thông báo là đã đọc
                document.addEventListener('click', function(e) {
                    const markReadBtn = e.target.closest('.mark-read');
                    if (markReadBtn) {
                        e.preventDefault();
                        e.stopPropagation();

                        const notificationId = markReadBtn.dataset.id;
                        fetch('/student/notifications/mark-read', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ notification_id: notificationId })
                        })
                        .then(response => response.json())
                        .then(() => loadNotifications()) // Tải lại thông báo sau khi đánh dấu
                        .catch(error => console.error('Error marking notification as read:', error));
                    }
                });

                // Đánh dấu tất cả là đã đọc
                markAllReadBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    fetch('/student/notifications/mark-read', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        } // Không cần body khi đánh dấu tất cả
                    })
                    .then(response => response.json())
                    .then(() => loadNotifications()) // Tải lại thông báo
                    .catch(error => console.error('Error marking all notifications as read:', error));
                });

                // Auto-refresh thông báo mỗi 5 phút
                setInterval(loadNotifications, 300000); // 5 phút = 300000 ms

                // Load thông báo lần đầu khi trang được tải
                loadNotifications();
            });
            </script>
        @endsection
