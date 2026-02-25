<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Registration Form</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            border: 2px solid #c0392b;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #c0392b;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        h1 {
            color: #c0392b;
            font-size: 28px;
            margin: 5px 0;
        }
        .district-box {
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 30px;
            display: inline-block;
            margin-bottom: 10px;
        }
        .reg-no {
            background: #2c3e50;
            color: white;
            padding: 8px;
            border-radius: 30px;
            margin: 10px 0;
        }
        .field-row {
            margin-bottom: 8px;
            padding: 5px;
            background: #f8f9fa;
            display: flex;
        }
        .field-label {
            font-weight: bold;
            width: 150px;
            color: #2c3e50;
        }
        .field-value {
            flex: 1;
            border-bottom: 1px solid #c0392b;
            padding: 2px 5px;
        }
        .cnic-box {
            display: flex;
            align-items: center;
            gap: 2px;
        }
        .cnic-digit {
            width: 20px;
            height: 25px;
            border: 1px solid #c0392b;
            text-align: center;
            line-height: 25px;
            font-weight: bold;
        }
        .payment-box {
            background: #fff5f0;
            border: 1px solid #c0392b;
            padding: 10px;
            margin: 15px 0;
        }
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #c0392b;
            font-size: 10px;
            text-align: center;
        }
        .total-amount {
            background: #c0392b;
            color: white;
            padding: 5px 15px;
            border-radius: 30px;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="district-box">
            District: <strong>{{ $user->city ?? '' }}</strong>
        </div>
        <h1>CHRIST LAND CITY</h1>
        <p>Registration Form - 04 MARLA HOUSING PROJECT</p>
    </div>

    <div class="reg-no">
        Reg No: {{ $application->registration_no ?? '' }} | Security Code: {{ $application->security_code ?? '' }}
    </div>

    @php
        $cnic = preg_replace('/\D/', '', $application->cnic ?? '');
    @endphp

    <div class="field-row">
        <span class="field-label">Name:</span>
        <span class="field-value">{{ $user->name ?? '' }}</span>
    </div>

    <div class="field-row">
        <span class="field-label">CNIC:</span>
        <div class="cnic-box">
            @for($i = 0; $i < 5; $i++)
                <span class="cnic-digit">{{ $cnic[$i] ?? '' }}</span>
            @endfor
            <span>-</span>
            @for($i = 5; $i < 12; $i++)
                <span class="cnic-digit">{{ $cnic[$i] ?? '' }}</span>
            @endfor
            <span>-</span>
            <span class="cnic-digit">{{ $cnic[12] ?? '' }}</span>
        </div>
    </div>

    <div class="field-row">
        <span class="field-label">Guardian Name:</span>
        <span class="field-value">{{ $application->guardian_name ?? '' }}</span>
    </div>

    <div class="field-row">
        <span class="field-label">Current Address:</span>
        <span class="field-value">{{ $application->current_mailing_address ?? '' }}</span>
    </div>

    <div class="field-row">
        <span class="field-label">Permanent Address:</span>
        <span class="field-value">{{ $application->permanent_mailing_address ?? '' }}</span>
    </div>

    <div class="field-row">
        <span class="field-label">Occupation:</span>
        <span class="field-value">{{ $application->occupation ?? '' }}</span>
    </div>

    <div class="field-row">
        <span class="field-label">Email:</span>
        <span class="field-value">{{ $user->email ?? '' }}</span>
    </div>

    <div class="field-row">
        <span class="field-label">Mobile:</span>
        <span class="field-value">{{ $application->mobile_number ?? '' }}</span>
    </div>

    <div class="payment-box">
        <h3 style="color: #c0392b; margin-top: 0;">Payment Details</h3>
        <p><strong>Bank:</strong> Askari Bank Ltd</p>
        <p><strong>Account Title:</strong> Amir Sultan</p>
        <p><strong>Account No:</strong> 3010380 00 25 96</p>
        <p><strong>Amount:</strong> 11,000 PKR</p>
        <p><strong>Payment Date:</strong> {{ $application->payment_date ?? '' }}</p>
        <div class="total-amount">Total PKR: 11,000</div>
    </div>

    <div class="field-row">
        <span class="field-label">Booked By:</span>
        <span class="field-value">{{ $application->booked_by ?? '' }}</span>
    </div>

    <div class="field-row">
        <span class="field-label">Booking Date:</span>
        <span class="field-value">{{ $application->booking_date ?? '' }}</span>
    </div>

    <div class="footer">
        <p>Raja Javed Plaza, First Floor, Main GT Road, Opp. Gate # 02, DHA Phase 2, Islamabad</p>
        <p>📞 +92 330 7778851 | +92 303 0366668 | ✉️ amirsultanpak74@gmail.com</p>
        <p style="font-size: 8px; margin-top: 10px;">Note: Company reserves the right to reject application</p>
    </div>
</div>
</body>
</html>
