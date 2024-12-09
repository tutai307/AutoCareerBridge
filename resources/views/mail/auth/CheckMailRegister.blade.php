<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận email đăng ký của bạn</title>
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
            color: #007bff;
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
            cursor: pointer;
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
            <h1>Xác nhận Email của bạn</h1>
        </div>
        <div class="content">
            <p>Xin chào,</p>
            <p>Cảm ơn bạn đã đăng ký tài khoản! Để hoàn tất quá trình đăng ký, vui lòng xác nhận email của bạn bằng cách
                nhấp vào nút bên dưới:</p>
        </div>
        <div class="button">
            <a href="{{ route('management.confirmMailRegister', ['token'=>$user->remember_token]) }}" target="_blank">Xác nhận Email</a>
        </div>
        <div class="content">
            <p>Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này.</p>
            <p>Trân trọng</p>
            <p>Cảm ơn</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Công ty AutoCareerBridge. Tất cả các quyền được bảo lưu.</p>
        </div>
    </div>
</body>

</html>
