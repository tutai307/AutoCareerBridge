<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu của bạn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            padding: 10px 0;
        }

        .header h1 {
            color: #23c0e9;
        }

        .content {
            margin: 20px 0;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
        }

        .button {
            text-align: center;
            margin-top: 20px;
        }

        .button a {
            background-color: #23c0e9;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
        }

        .button a:hover {
            background-color: #27b1ff;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Đặt lại mật khẩu của bạn</h1>
        </div>
        <div class="content">
            <p>Xin chào,</p>
            <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Để tiếp tục, vui lòng nhấp vào nút
                bên dưới:</p>
        </div>
        <div class="button">
            <a href="{{ route('management.viewChangePassword', ['token'=>$user->remember_token]) }}" target="_blank">Đặt lại mật khẩu</a>
        </div>
        <div class="content">
            <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
            <p>Trân trọng,</p>
            <p>Đội ngũ Hỗ trợ</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Công ty AutoCareerBridge. Tất cả các quyền được bảo lưu.</p>
        </div>
    </div>
</body>

</html>