<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt lịch hẹn khám thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .header {
            background-color: #247cff;
            color: #fff;
            padding: 15px;
            text-align: left;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .header-left {
            width: 100%;
        }

        .header-right {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }

        .contact-info {
            width: 100%;
            text-align: right;
        }

        .section-title {
            background-color: #247cff;
            color: #fff;
            padding: 5px 10px;
            font-weight: bold;
        }

        .info-block {
            margin-bottom: 20px;
        }

        .info-block p {
            margin: 5px 0;
        }

        .footer {
            background-color: #247cff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        a {
            color: #247cff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <div class="header-left">
                    <h2 style="margin: 0;">Healing Care</h2>
                    <div>Công Ty Cổ Phần Y Tế HEALING CARE</div>
                </div>
                <div class="header-right">
                    <div class="contact-info">
                        <p>📞 <strong>0123.456.789</strong> (Free Hotline)</p>
                        <p>🌐 <a style="color:white" href="https://healingcare.healingdc.id.vn/">Healing Care Website</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <p>Bạn đã đăng ký thành công lịch hẹn khám tại Healing Care.</p>
            <p>Chúng tôi sẽ liên hệ sớm nhất với bạn để hoàn thành lịch hẹn khám.</p>
            <p>Nếu có vấn đề gì muốn hủy lịch hẹn. Vui lòng nhấn vào link này:
                <a href="https://healingcare.healingdc.id.vn/cancel-appointment/{{ $token }}"
                    onclick="return confirm('Bạn có chắc chắn muốn hủy lịch hẹn này không?')">
                    Hủy lịch hẹn
                </a>
            </p>
        </div>

        <div class="info-block">
            <div class="section-title">HỆ THỐNG PHÒNG KHÁM HEALING CARE</div>
            <p><strong>Phòng khám TP. Hồ Chí Minh:</strong> 184 Lê Đại Hành, P15, Q11, TP HCM</p>
        </div>

        <div class="footer">
            <p>Healing Care - Công Ty Cổ Phần Y Tế HEALING CARE.</p>
        </div>
    </div>
</body>

</html>
