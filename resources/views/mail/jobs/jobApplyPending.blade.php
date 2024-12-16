<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo từ {{ $university->name }} về việc ứng tuyển công việc {{ $job->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #23c0e9;
        }

        .header {
            text-align: center;
            padding: 10px 0;
        }

        .header h1 {
            color: #23c0e9;
            font-size: 24px;
            margin: 0;
        }

        .content {
            margin: 20px 0;
            line-height: 1.6;
        }

        .content p {
            font-size: 16px;
        }

        .button {
            text-align: center;
            margin: 20px 0;
            cursor: pointer;
        }

        .button a {
            display: inline-block;
            background-color: #23c0e9;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .button a:hover {
            background-color: #27b1ff;
            cursor: pointer;
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
            <h1>Thông báo về việc ứng tuyển công việc {{ $job->name }} của nhà trường {{ $university->name }}</h1>
        </div>
        <div class="content">
            <p>Xin chào {{ $company->name }},</p>
            <p>Chúng tôi xin thông báo rằng nhà trường <b>{{ $university->name }}</b> đã chính thức ứng tuyển vào công
                việc: <b>{{ $job->name }}</b> của bạn.</p>
            <p>Bạn có thể xem thông tin chi tiết về ứng tuyển của nhà trường qua nút bên dưới.</p>
        </div>
        <div class="button">
            <a href="" target="_blank">Xem thông tin ứng tuyển</a>
        </div>
        <div class="content">
            <p>Nếu bạn có bất kỳ câu hỏi nào hoặc cần hỗ trợ, vui lòng liên hệ với chúng tôi qua email hoặc số điện
                thoại được cung cấp trên trang web.</p>
            <p>Trân trọng,</p>
            <p>Đội ngũ {{ config('app.name') }}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Tất cả các quyền được bảo lưu.</p>
        </div>
    </div>
</body>

</html>
