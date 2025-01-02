<?php

return [
    'login_success' => 'Đăng nhập thành công',
    'update_info' => 'Vui lòng cập nhật thông tin',
    'register_success' => 'Đăng ký thành công',
    'email_exist' => 'Email đà đăng ký',

    'date_start_than_end' => 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc',
    'date_end_than_start' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu',

    'job' => [
        'not_found' => 'Không tìm thấy dữ liệu',
        'apply_success' => 'Ứng tuyển thành công',
        'apply_fail' => 'Ứng tuyển thất bại',
        'already_apply' => 'Đã ứng tuyển rồi, vui lòng không thực hiện lại.',
    ],

    'admin' => [
        'not_found' => 'Không tìm thấy dữ liệu',
        'add_success' => 'Thêm thành công',
        'update_success' => 'Cập nhật thành công',

        'add_fail' => 'Thêm thất bại',
        'update_fail' => 'Cập nhật thất bại',
        'delete_success' => 'Xóa thành công',
        "workshop" => [
            'has_company' => 'Workshop đang có công ty tham gia',
        ],
        'fields' => [
            'change_status' => 'Cập nhật trạng thái thành công',
            'has_majors' => 'Lĩnh vực đã tồn tại chuyên ngành nên không thể xóa',
            'has_company' => 'Lĩnh vực này đang được sử dụng bởi công ty',
        ],

        'majors' => [
            'has_university' => 'Chuyên ngành này đang được sử dụng bởi trường đại học',
        ],
    ],
    'university' => [
        'collaboration' => [
            'not_found' => 'Không tìm thấy dữ liệu',
            'not_permission' => 'Bạn không có quyền thực hiện hành động này',
            'revoke_success' => 'Thu hồi yêu cầu thành công',
            'change_status_success' => 'Cập nhật trạng thái thành công',
            'change_status_fail' => 'Cập nhật trạng thái thất bại',
            'university_not_found' => 'Trường không tồn tại',
            'company_not_found' => 'Công ty không tồn tại',
        ],
    ],
    'company' => [
        'collaboration' => [
            'not_found' => 'Không tìm thấy dữ liệu',
            'not_permission' => 'Bạn không có quyền thực hiện hành động này',
            'revoke_success' => 'Thu hồi yêu cầu thành công',
            'change_status_success' => 'Cập nhật trạng thái thành công',
            'change_status_fail' => 'Cập nhật trạng thái thất bại'
        ]
    ],
    'errors' => [
        'back' => 'Quay lại trang trước đó',
        '400' => [
            'bad_request' => '🚫 Yêu cầu không hợp lệ',
            'detail' => '⚠️ Yêu cầu của bạn dẫn đến lỗi',
        ],
        '403' => [
            'forbidden' => '🚷 Bạn không có quyền truy cập',
            'detail' => '🔒 Vui lòng liên hệ với quản trị viên để cấp quyền',
        ],
        '404' => [
            'not_found' => '❓ Xin lỗi, Không tìm thấy trang',
            'detail' => '🔍 Trang bạn đang tìm kiếm không tồn tại!',
        ],
        '500' => [
            'internal_server_error' => '💥 Lỗi máy chủ nội bộ!',
            'detail' => '🔥 Lỗi máy chủ 500. Máy chủ của chúng tôi đang gặp sự cố vui lòng thử lại sau.',
        ],
        '503' => [
            'service_unavailable' => '⛔ Dịch vụ không khả dụng!',
            'detail' => '📡 Lỗi máy chủ 503. Máy chủ của chúng tôi đang gặp sự cố, vui lòng thử lại sau.',
        ]
    ],
];
