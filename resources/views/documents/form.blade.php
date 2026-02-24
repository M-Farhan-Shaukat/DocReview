<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Christ Land City – Registration Form (exact replica)</title>
    <style>
        /* === RESET / BASE === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #b3b3b3;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Inter', 'Times New Roman', sans-serif;
            padding: 30px 15px;
        }

        /* main card – exactly 654px wide as target */
        .paper {
            max-width: 654px;
            width: 100%;
            background: #ffffff;
            box-shadow: 0 20px 40px rgba(0,0,0,0.45);
            position: relative;
            overflow: visible;
            border: 1px solid #9f9f9f;
        }

        /* all images: serve as backgrounds / spacers – hide broken icons */
        img:not([src*="codia"]):not([src]) {
            display: none;
        }

        /* ===== HEADER ZONE – pixel perfect from target ===== */
        .header-zone {
            position: relative;
            width: 100%;
            height: 205px;          /* measured from target */
            background: #fcfbf9;
            border-bottom: 1px solid #d1b47c;
        }

        /* top-most district bar */
        .district-bar {
            position: absolute;
            top: 4px;
            left: 17px;
            display: flex;
            align-items: center;
            gap: 6px;
            z-index: 5;
        }
        .district-bar span {
            font-size: 12px;
            color: #5e5b5b;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        .district-line {
            width: 150px;
            border-bottom: 2px solid #3c3c3c;
            margin-top: 4px;
        }

        /* registration fee (right side) */
        .fee-badge {
            position: absolute;
            top: 6px;
            right: 15px;
            text-align: right;
            font-size: 14px;
            font-weight: 700;
            color: #2d2d2d;
            line-height: 1.3;
            z-index: 5;
        }

        /* main logo (left) */
        .main-logo {
            position: absolute;
            top: 30px;
            left: 20px;
            width: 70px;
            height: auto;
            z-index: 4;
        }

        /* registration form text */
        .reg-form-label {
            position: absolute;
            top: 20px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            color: #6f6c6c;
            letter-spacing: 0.5px;
            z-index: 4;
        }

        /* CHRIST LAND CITY title */
        .city-title {
            position: absolute;
            top: 33px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 34px;
            font-weight: 700;
            color: #b64b4d;        /* deep rose from target */
            font-family: 'Georgia', 'Times New Roman', serif;
            letter-spacing: 0px;
            z-index: 4;
        }

        /* gateway subtitle */
        .gateway-sub {
            position: absolute;
            top: 69px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 13px;
            color: #c5a15b;
            font-weight: 400;
            font-style: italic;
            z-index: 4;
        }

        /* red band with project info */
        .project-band {
            position: absolute;
            top: 92px;
            left: 50%;
            transform: translateX(-50%);
            background: #ac2f31;     /* exact dark red */
            padding: 5px 18px;
            white-space: nowrap;
            border-radius: 0;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
            z-index: 6;
            width: 100%;
            max-width: 580px;
            text-align: center;
        }
        .project-band span {
            font-size: 11px;
            font-weight: 400;
            color: #f0c9ca;
            letter-spacing: 0.2px;
        }

        /* registration no + security code row */
        .code-row {
            position: absolute;
            top: 124px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 30px;
            background: transparent;
            padding: 2px 12px;
            z-index: 6;
            width: auto;
            border: none;
        }
        .code-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            color: #444;
        }
        .code-item .line {
            border-bottom: 2px solid #242121;
            width: 140px;
            height: 6px;
        }

        /* developer & supervision area (two‑column) */
        .dev-super-row {
            position: absolute;
            top: 150px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0 25px 0 20px;
            z-index: 7;
        }
        .dev-block {
            display: flex;
            flex-direction: column;
            max-width: 240px;
        }
        .dev-block .small-muted {
            font-size: 11px;
            color: #b18459;
            font-weight: 400;
        }
        .dev-block .amir-bold {
            font-size: 17px;
            font-weight: 800;
            color: #3f3d3d;
            line-height: 1.2;
            font-family: 'Times New Roman', serif;
        }
        .dev-block .sub-dev {
            font-size: 9px;
            color: #b1585a;
            letter-spacing: 0.3px;
        }
        .super-block {
            text-align: right;
        }
        .super-block .sup-title {
            font-size: 11px;
            font-weight: 600;
            color: #bc7476;
        }
        .super-block .methodist-name {
            font-size: 15px;
            font-weight: 600;
            color: #ac4f52;
            font-family: 'Impact', 'Arial Narrow', sans-serif;
        }
        .super-block .pakistan {
            font-size: 14px;
            color: #ac4f52;
            font-family: 'Impact', 'Arial Narrow', sans-serif;
        }

        /* tiny church logo (simulated) */
        .church-logo-sim {
            display: inline-block;
            width: 32px;
            height: 32px;
            background: #6d2729;
            border-radius: 50%;
            margin-left: 5px;
            vertical-align: middle;
            border: 1px solid #ac8e64;
        }

        /* ===== MAIN CONTENT (background removed, clean) ===== */
        .content-area {
            padding: 10px 22px 20px 22px;
            background: #ffffff;
        }

        /* ----- applicant info block (matching target) ----- */
        .applicant-block {
            background: transparent;
            margin-top: 5px;
            border: none;
            padding: 5px 0 0 0;
        }

        .field-row {
            margin-bottom: 10px;
        }
        .label {
            font-size: 12px;
            font-weight: 500;
            color: #4b4949;
            display: inline-block;
            min-width: 100px;
        }
        .underline {
            border-bottom: 2px solid #232121;
            display: inline-block;
            width: calc(100% - 110px);
            vertical-align: middle;
            margin-left: 5px;
        }

        /* special for CNIC + S/o line */
        .cnic-so-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 5px 0 12px;
            flex-wrap: wrap;
        }
        .cnic-group {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .cnic-group .label {
            min-width: auto;
        }
        .cnic-boxes {
            display: flex;
            gap: 2px;
        }
        .cnic-box {
            width: 28px;
            border-bottom: 2px solid #333;
            margin-right: 2px;
            height: 18px;
        }
        .so-group {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-left: 10px;
        }
        .so-group .label {
            min-width: auto;
        }
        .so-line {
            border-bottom: 2px solid #333;
            width: 200px;
            height: 16px;
        }

        /* address rows */
        .address-line {
            display: flex;
            align-items: center;
            margin: 8px 0;
        }
        .address-line .label {
            width: 140px;
        }
        .addr-underline {
            border-bottom: 2px solid #232121;
            flex: 1;
            height: 6px;
        }

        /* occupation + email row */
        .occ-email-row {
            display: flex;
            align-items: center;
            gap: 20px;
            margin: 12px 0 8px;
            flex-wrap: wrap;
        }
        .occ-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .occ-item .underline-short {
            border-bottom: 2px solid #232121;
            width: 200px;
            height: 8px;
        }
        .email-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .email-item .underline-email {
            border-bottom: 2px solid #232121;
            width: 170px;
            height: 8px;
        }

        /* contact + mobile */
        .contact-row {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-top: 5px;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ----- PAYMENT BLOCK (exact) ----- */
        .payment-block {
            border: 2px solid #b24244;
            margin: 18px 0 12px;
            background: #fffcfc;
        }
        .payment-table {
            width: 100%;
            border-collapse: collapse;
        }
        .payment-table td {
            padding: 4px 8px;
            border: 1px solid #b24244;
            font-size: 11px;
            color: #1f1f1f;
        }
        .payment-table .label-cell {
            background: #b12d30;
            color: #f1cfd0;
            font-weight: 600;
            width: 140px;
        }
        .accent-text {
            color: #b24244;
            font-weight: 600;
        }
        .branch-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .branch-code-box {
            background: #b12d30;
            color: #eec3c4;
            padding: 4px 14px;
            font-weight: 600;
            border: 1px solid #941e20;
        }

        /* DD line */
        .dd-row {
            padding: 8px 12px 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .dd-label {
            font-size: 13px;
            font-weight: 500;
            color: #3d3b3b;
        }
        .dd-underline {
            border-bottom: 2px solid #343232;
            flex: 1;
            height: 6px;
        }

        /* amount in words + total pkr */
        .amount-total-row {
            display: flex;
            padding: 4px 12px 12px;
            gap: 15px;
            flex-wrap: wrap;
        }
        .words-col {
            flex: 2;
        }
        .words-col .label {
            display: block;
        }
        .words-underline {
            border-bottom: 2px solid #232121;
            width: 100%;
            height: 8px;
            margin: 2px 0 10px;
        }
        .dated-line {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }
        .dated-underline {
            border-bottom: 2px solid #232121;
            width: 180px;
            height: 8px;
        }
        .total-col {
            flex: 1;
            text-align: right;
        }
        .total-label {
            font-size: 13px;
            font-weight: 700;
            color: #2d2b2b;
        }
        .pkr-boxes {
            display: flex;
            border: 2px solid #b24244;
            margin-top: 4px;
        }
        .pkr-cell {
            width: 32px;
            height: 24px;
            border-right: 1px solid #b24244;
        }
        .pkr-cell:last-child {
            border-right: none;
        }

        /* ----- DOCUMENTS SECTION ----- */
        .doc-section {
            display: flex;
            align-items: stretch;
            margin: 16px 0 10px;
            border: 2px solid #b24244;
            background: #b12d30;
        }
        .doc-left {
            background: #b12d30;
            padding: 10px 14px;
            width: 190px;
            display: flex;
            align-items: center;
        }
        .doc-left span {
            color: #f2d7d8;
            font-weight: 600;
            font-size: 11px;
            line-height: 1.4;
        }
        .doc-right {
            background: #b12d30;
            flex: 1;
            padding: 6px 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .doc-images-row {
            display: flex;
            gap: 50px;
            margin: 4px 0 2px;
        }
        .doc-img-placeholder {
            width: 70px;
            border-bottom: 3px solid white;
            height: 16px;
        }
        .doc-labels {
            display: flex;
            gap: 35px;
            font-size: 10px;
            color: #f3d6d7;
            font-weight: 500;
        }

        /* ----- BOOKED, DATE, SIGNATURE ----- */
        .booked-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 12px 0 8px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .booked-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .booked-item .line {
            border-bottom: 2px solid #232121;
            width: 130px;
            height: 6px;
        }
        .date-item .line {
            width: 80px;
        }
        .signature-item .line {
            width: 120px;
        }

        .office-only {
            text-align: center;
            font-weight: 700;
            font-size: 14px;
            color: #3f3d3d;
            margin: 5px 0 8px;
            text-decoration: underline;
        }

        /* application # line */
        .app-number-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 8px 0 10px;
        }
        .app-label {
            font-weight: 600;
            font-size: 15px;
            color: #353333;
            white-space: nowrap;
        }
        .app-box {
            border: 2px solid #b24244;
            width: 180px;
            height: 24px;
        }

        /* lower name / sdo / cnic */
        .lower-name-row {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 8px 0 8px;
            flex-wrap: wrap;
        }
        .lower-label {
            font-weight: 600;
            font-size: 13px;
            color: #3f3d3d;
        }
        .name-line {
            border-bottom: 2px solid #232121;
            width: 160px;
            height: 8px;
        }
        .sdo-line {
            border-bottom: 2px solid #232121;
            width: 180px;
            height: 8px;
        }
        .lower-cnic-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 8px 0 12px;
        }
        .cnic-box-group {
            display: flex;
            gap: 2px;
        }
        .cnic-small-box {
            width: 28px;
            border-bottom: 2px solid #333;
            height: 18px;
        }

        /* note text */
        .note-text {
            font-size: 10px;
            color: #4b4848;
            font-weight: 600;
            line-height: 1.4;
            margin: 12px 0 15px;
            max-width: 380px;
        }

        /* stamp + sign */
        .stamp-sign-area {
            display: flex;
            align-items: center;
            gap: 40px;
            margin: 5px 0 10px;
        }
        .stamp-box {
            font-weight: 700;
            font-size: 14px;
            color: #2b2929;
            border: 2px solid #232121;
            padding: 6px 24px;
        }
        .sign-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sign-label {
            font-weight: 700;
            font-size: 14px;
        }
        .sign-line {
            border-bottom: 2px solid #232121;
            width: 150px;
            height: 8px;
        }

        /* footer contact */
        .contact-footer {
            border: 2px solid #b64b4d;
            padding: 8px 10px;
            text-align: center;
            font-size: 11px;
            font-weight: 500;
            color: #ac4b4d;
            background: #ffffff;
            margin-top: 18px;
            line-height: 1.6;
        }

        /* bottom line decoration */
        .bottom-decor {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
        }
        .decor-left {
            width: 60px;
            border-top: 2px solid #b6a47e;
        }
        .decor-center {
            flex: 1;
            border-top: 2px dashed #9e8f73;
            margin: 0 15px;
        }
        .decor-right {
            width: 120px;
            border-top: 2px solid #b6a47e;
        }

        /* small helpers */
        hr {
            display: none;
        }
    </style>
</head>
<body>
<div class="paper">

    <!-- ========== HEADER SECTION (pixel-perfect) ========== -->
    <div class="header-zone">
        <!-- district bar -->
        <div class="district-bar">
            <div class="district-wrapper" style="position: relative; display: inline-block; margin-top: 20px;">
                <span class="district-label">District</span>
                <span class="district-name">Lahore</span>
                <div class="district-line"></div>
            </div>
        </div>

        <!-- registration fee -->
        <div class="fee-badge">Registration Fee<br>1000PKR Only</div>

        <!-- main logo (simple cross/crown representation) -->
        <div class="main-logo">
            <svg width="50" height="50" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="15" fill="#ac8e64"/><path d="M20 8 L22 15 L30 15 L24 20 L27 28 L20 23 L13 28 L16 20 L10 15 L18 15 Z" fill="#e0c396"/></svg>
        </div>

        <!-- registration form text -->
        <div class="reg-form-label">Registration Form</div>

        <!-- main title -->
        <div class="city-title">Christ Land CIty</div>
        <div class="gateway-sub">A Gateway of Luxury Living</div>

        <!-- red project band -->
        <div class="project-band">
            <span>04 MARLA (108 Sq Ft) HOUSING PROJECT FOR PAKISTANI HOMELESS CHRISTIAN FAMILIES</span>
        </div>

        <!-- reg no & security code -->
        <div class="code-row">
            <div class="code-item">Registration No.<div class="line"></div></div>
            <div class="code-item">Security Code<div class="line"></div></div>
        </div>

        <!-- developer / supervision block -->
        <div class="dev-super-row">
            <div class="dev-block">
                <span class="small-muted">Develop & Marketing by</span>
                <span class="amir-bold">AMIR SULTAN</span>
                <span class="sub-dev">GET HOME SERVICES (PVT) LTD</span>
            </div>
            <div class="super-block">
                <div class="sup-title">Under Supervision of</div>
                <div class="methodist-name">The Methodist Church <span class="pakistan">of Pakistan</span></div>
                <div class="church-logo-sim"></div>
            </div>
        </div>
    </div><!-- /header-zone -->

    <!-- ========== CONTENT ========== -->
    <div class="content-area">

        <!-- APPLICANT INFO -->
        <div class="applicant-block">
            <!-- Name -->
            <div class="field-row">
                <span class="label">Name of Applicant</span>
                <span class="underline"></span>
            </div>

            <!-- CNIC + S/O -->
            <div class="cnic-so-row">
                <div class="cnic-group">
                    <span class="label">Applicant CNIC</span>
                    <div class="cnic-boxes">
                        <div class="cnic-box"></div><div class="cnic-box"></div><div class="cnic-box"></div><div class="cnic-box"></div><div class="cnic-box"></div>
                    </div>
                </div>
                <div class="so-group">
                    <span class="label">S/o. D/O, W/O.</span>
                    <div class="so-line"></div>
                </div>
            </div>

            <!-- Current address -->
            <div class="address-line">
                <span class="label">Current Mailing Address</span>
                <span class="addr-underline"></span>
            </div>

            <!-- Permanent address -->
            <div class="address-line">
                <span class="label">Permanent Mailing Address</span>
                <span class="addr-underline"></span>
            </div>

            <!-- Occupation + Email -->
            <div class="occ-email-row">
                <div class="occ-item">
                    <span class="label">Occupation</span>
                    <span class="underline-short"></span>
                </div>
                <div class="email-item">
                    <span class="label">Email:</span>
                    <span class="underline-email"></span>
                </div>
            </div>

            <!-- Contact & Mobile -->
            <div class="contact-row">
                <div class="contact-item">
                    <span class="label">Official Contact Number.</span>
                    <span class="underline" style="width:130px"></span>
                </div>
                <div class="contact-item">
                    <span class="label">Mobile:</span>
                    <span class="underline" style="width:100px"></span>
                </div>
            </div>
        </div><!-- /applicant -->

        <!-- PAYMENT BLOCK -->
        <div class="payment-block">
            <table class="payment-table">
                <tr><td class="label-cell">Payment Method</td><td>Askari Bank Ltd</td></tr>
                <tr><td class="label-cell">Account Tittle:</td><td>Amir Sultan</td></tr>
                <tr>
                    <td class="label-cell">Account No:</td>
                    <td>
                        <div class="branch-cell">
                            <span class="accent-text">3010380 00 25 96</span>
                            <span>Branch Code:</span>
                            <span class="branch-code-box">0301</span>
                        </div>
                    </td>
                </tr>
            </table>

            <!-- DD line -->
            <div class="dd-row">
                <span class="dd-label">DD/Pay order/Cross Cheque / Cash Deposit</span>
                <span class="dd-underline"></span>
            </div>

            <!-- Amount in words + Total PKR -->
            <div class="amount-total-row">
                <div class="words-col">
                    <span class="label">Amount in words:</span>
                    <div class="words-underline"></div>
                    <div class="dated-line">
                        <span class="label">Dated:</span>
                        <span class="dated-underline"></span>
                    </div>
                </div>
                <div class="total-col">
                    <div class="total-label">Total Amount PKR</div>
                    <div class="pkr-boxes">
                        <div class="pkr-cell"></div><div class="pkr-cell"></div><div class="pkr-cell"></div><div class="pkr-cell"></div><div class="pkr-cell"></div>
                    </div>
                </div>
            </div>
        </div><!-- /payment -->

        <!-- DOCUMENTS SECTION -->
        <div class="doc-section">
            <div class="doc-left">
                <span>Documents to be attached<br>with this form</span>
            </div>
            <div class="doc-right">
                <div class="doc-images-row">
                    <div class="doc-img-placeholder"></div>
                    <div class="doc-img-placeholder"></div>
                </div>
                <div class="doc-labels">
                    <span>Copy of member CNIC</span>
                    <span>Copy of deposit slip</span>
                </div>
            </div>
        </div>

        <!-- BOOKED / DATE / SIGNATURE -->
        <div class="booked-row">
            <div class="booked-item"><span>Booked By (Code)</span><span class="line"></span></div>
            <div class="booked-item date-item"><span>Date</span><span class="line"></span></div>
            <div class="booked-item signature-item"><span>Applicant Signature</span><span class="line"></span></div>
        </div>

        <div class="office-only">For Office Use Only</div>

        <!-- Application # -->
        <div class="app-number-row">
            <span class="app-label">Christ Land City 04 Marla Home Form / Application #</span>
            <div class="app-box"></div>
        </div>

        <!-- lower name / s/o -->
        <div class="lower-name-row">
            <span class="lower-label">Name:</span>
            <span class="name-line"></span>
            <span class="lower-label">S/O,D/O,W/O:</span>
            <span class="sdo-line"></span>
        </div>

        <!-- lower CNIC -->
        <div class="lower-cnic-row">
            <span class="lower-label">Applicant CNIC:</span>
            <div class="cnic-box-group">
                <div class="cnic-small-box"></div><div class="cnic-small-box"></div><div class="cnic-small-box"></div><div class="cnic-small-box"></div><div class="cnic-small-box"></div>
            </div>
        </div>

        <!-- NOTE -->
        <div class="note-text">
            Note: Company & The Methodist Church of Pakistan reserve the right to reject your application for providing any wrong information. Company is not responsible for any cash handling with any individual/Employe
        </div>

        <!-- STAMP & SIGN -->
        <div class="stamp-sign-area">
            <div class="stamp-box">Stamp</div>
            <div class="sign-group">
                <span class="sign-label">Sign</span>
                <span class="sign-line"></span>
            </div>
        </div>

        <!-- CONTACT FOOTER (exact) -->
        <div class="contact-footer">
            Raja Javed Plaza, First Floor, Main GT Road, Opp. Gate # 02, DHA Phase 2, Islamabad<br>
            Help line # +92 330 7778851 +92 303 0366668<br>
            Email: amirsultanpak74@gmail.com
        </div>

        <!-- bottom decorative lines -->
        <div class="bottom-decor">
            <div class="decor-left"></div>
            <div class="decor-center"></div>
            <div class="decor-right"></div>
        </div>

    </div><!-- /content-area -->
</div><!-- /paper -->
</body>
</html>
