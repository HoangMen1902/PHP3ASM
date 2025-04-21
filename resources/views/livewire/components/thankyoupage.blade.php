<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cảm ơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* nền trắng */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .thankyou-box {
            background: #fff;
            padding: 50px 40px;
            border-radius: 15px;
            text-align: center;
            max-width: 1200px;
            width: 100%;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .checkmark-circle {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 6px solid #28a745;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            animation: pop 0.6s ease;
        }

        .checkmark-circle i {
            font-size: 4rem;
            color: #28a745;
        }

        .thankyou-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .thankyou-message {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.8;
        }

        .home-button {
            margin-top: 35px;
            padding: 12px 35px;
            font-size: 1.1rem;
            border-radius: 50px;
        }

        @keyframes pop {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body>

    <div class="thankyou-box">
        <div class="checkmark-circle">
            <i class="bi bi-check-lg"></i>
        </div>
        <div class="thankyou-title">Cảm ơn bạn đã đặt hàng!</div>
        <div class="thankyou-message">
            Cảm ơn vì đã chọn chúng tôi trong hàng ngàn lựa chọn ngoài kia!<br>
            Đơn hàng của bạn đã được ghi nhận và đang được xử lý nhanh chóng.<br>
            Chúc bạn một ngày thật tuyệt vời!
        </div>

        <a href="/" class="btn btn-success home-button">Về trang chủ</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>