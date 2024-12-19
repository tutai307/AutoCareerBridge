@php
    if ($sendTo == ROLE_COMPANY) {
        $fromName = $university->name;
        $toName = $company->name;
    } elseif ($sendTo == ROLE_UNIVERSITY) {
        $fromName = $company->name;
        $toName = $university->name;
    }
@endphp

@if ($status == STATUS_PENDING)
    @php
        $statusText = 'đã gửi yêu cầu hợp tác đến bạn';
    @endphp
@elseif($status == STATUS_APPROVED)
    @php
        $statusText = 'đã chấp nhận yêu cầu hợp tác của bạn';
    @endphp
@elseif($status == STATUS_REJECTED)
    @php
        $statusText = 'đã từ chối yêu cầu hợp tác của bạn';
    @endphp
@endif

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo về yêu cầu hợp tác giữa công ty {{ $company->name }} và trường {{ $university->namename }} </title>
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
            <h1>Thông báo về yêu cầu hợp tác giữa công ty {{ $company->name }} và trường
                {{ $university->name }}</h1>
        </div>
        <div class="content">
            <p>Xin chào, {{ $toName }}.</p>
            <p><b>{{ $fromName }}</b> {{ $statusText }}</p>
            <p>Để theo dõi Thông tin chi tiết, vui lòng nhấn vào nút bên dưới.</p>
        </div>
        <div class="button">
            <a href="{{ $link }}" target="_blank">Nhấn vào đây!</a>
        </div>
        <div class="content">
            <p>Nếu bạn cần bất kỳ sự trợ giúp nào hoặc có thắc mắc, vui lòng liên hệ với chúng tôi qua email hoặc số
                điện thoại có trên trang web.</p>
            <p>Trân trọng,</p>
            <p>Đội ngũ {{ env('APP_NAME') }}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. Tất cả các quyền được bảo lưu.</p>
        </div>
    </div>
</body>

</html>
