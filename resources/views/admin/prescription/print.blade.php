<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đơn thuốc #{{ $prescription->prescription_code }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            max-width: 800px;
            margin: auto;
        }

        body,
        table {
            line-height: 0.8;
        }


        .header {
            width: 100%;
        }

        .header div {
            display: inline-block;
            width: 49%;
            vertical-align: top;
        }


        .title {
            text-transform: uppercase
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .sign {
            margin-top: 20px;
            text-align: right;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="header">
        <div>
            <h5 class="title">Phòng khám đa khoa Healing Care</h5>
            <h5 class="title">TT Y Tế Thành Phố</h5>
            <small>Số điện thoại: 0123.456.789</small>
        </div>
        <div style="text-align: right">
            <h5>Mã số bệnh nhân</h5>
            <small>{{ $prescription->medical_certificate->patient->patient_code }}</small>
        </div>
    </div>
    <div style="text-align: center">
        <h2>ĐƠN THUỐC</h2>
    </div>

    <div class="info">
        <p><strong>Họ và tên:</strong> {{ $prescription->medical_certificate->patient->name }}
            <span style="font-style: italic"><strong>Tuổi:</strong>
                {{ \Carbon\Carbon::parse($prescription->medical_certificate->patient->dob)->age }}
            </span>
        </p>
        <p><strong>Địa chỉ:</strong> {{ $prescription->medical_certificate->patient->address }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên thuốc</th>
                <th>Liều lượng</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prescription->medicines as $index => $medicine)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $medicine->name }}</strong></td>
                    <td>{{ $medicine->pivot->dosage }}</td>
                    <td>{{ $medicine->pivot->quantity }} {{ $medicine->base_unit }}</td>
                    <td>{{ number_format($medicine->pivot->price, 0, ',', '.') }} VND</td>
                    <td>{{ number_format($medicine->pivot->subtotal, 0, ',', '.') }} VND</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Lời dặn:</strong> {{ $prescription->note }}</p>
    <p><strong>Ngày khám:</strong> {{ $prescription->created_at->format('d/m/Y') }}</p>
    <p><strong>Tổng tiền:</strong> {{ number_format($prescription->total_payment, 0, ',', '.') }} VNĐ</p>

    <div class="sign">
        <p>Ngày {{ now()->format('d') }} tháng {{ now()->format('m') }} năm {{ now()->format('Y') }}</p>
        <p>Bác sĩ khám bệnh</p>
        <p>(Ký, ghi rõ họ tên)</p>
        <br><br>
        <p><strong>BSCKI. {{ $prescription->doctor->name }}</strong></p>
    </div>
    <div class="footer">
        <p> - Khám lại xin mang theo đơn này.</p>
        <p> - Tên bố hoặc mẹ của trẻ hoặc người đưa đến khám, chữa bệnh:</p>
        <p> - Số điện thoại liên hệ:</p>
        <small style="font-style: italic"> Sử dụng mã số bệnh nhân để tra cứu thông tin khám, chữa bệnh trên website <a
                href="https://unicaremedic.ntu264.vpsttt.vn">Healing Care</a> https://unicaremedic.ntu264.vpsttt.vn
        </small>
    </div>
</body>

</html>
