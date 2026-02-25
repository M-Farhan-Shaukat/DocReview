@extends('admin.layouts.app')

@section('content')
    <style>
        /* ===== MODERN BEAUTIFUL UI - FULLY RESPONSIVE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #c0392b;
            --primary-dark: #962d22;
            --primary-light: #e74c3c;
            --gold: #c8941e;
            --gold-light: #e5c540;
            --gold-soft: #f1c40f;
            --cream: #fdf8f0;
            --dark: #2c3e50;
            --gray: #7f8c8d;
            --light-gray: #ecf0f1;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0,0,0,0.1);
            --shadow-hover: 0 15px 40px rgba(192,57,43,0.15);
            --border-radius: 20px;
            --border-radius-sm: 12px;
        }

        body {
            font-family: 'Inter', 'Segoe UI', 'Arial', sans-serif;
            /*background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);*/
            min-height: 100vh;
            /*padding: 20px;*/
        }

        /* Import Inter Font */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        .body-wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Download Button */
        .download-btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            font-weight: 700;
            text-decoration: none;
            border-radius: 50px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(192,57,43,0.3);
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(192,57,43,0.4);
        }

        /* ===== MODERN CARD DESIGN ===== */
        .form-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }

        .form-container:hover {
            box-shadow: var(--shadow-hover);
        }

        /* Decorative Top Bar */
        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--gold), var(--primary));
            z-index: 1;
        }

        /* ===== HEADER SECTION ===== */
        .header {
            background: linear-gradient(135deg, var(--white) 0%, var(--cream) 100%);
            padding: 20px 0 0;
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .district-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--white);
            padding: 8px 20px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid rgba(200,148,30,0.2);
        }

        .district-label {
            font-weight: 600;
            font-size: 14px;
            color: var(--dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .district-input {
            border: none;
            border-bottom: 2px solid var(--primary);
            padding: 5px 0;
            width: 100px;
            font-weight: 600;
            color: var(--dark);
            background: transparent;
            outline: none;
        }

        .reg-fee-ribbon {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--white);
            font-weight: 700;
            font-size: 14px;
            padding: 8px 25px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(200,148,30,0.3);
            position: relative;
            overflow: hidden;
        }

        .reg-fee-ribbon::before {
            content: '⭐';
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
        }

        /* Title Area */
        .title-area {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            gap: 20px;
            background: linear-gradient(135deg, rgba(192,57,43,0.02) 0%, rgba(200,148,30,0.02) 100%);
            flex-wrap: wrap;
        }

        .clc-seal-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .clc-seal-wrap::after {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            border: 2px dashed var(--gold);
            border-radius: 50%;
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .clc-logo {
            width: 85px;
            height: 85px;
            object-fit: contain;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
        }

        .title-text {
            flex: 1;
            text-align: center;
        }

        .reg-form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .title {
            color: var(--primary);
            font-size: clamp(28px, 5vw, 42px);
            font-weight: 800;
            letter-spacing: 2px;
            line-height: 1.1;
            text-shadow: 2px 2px 4px rgba(192,57,43,0.1);
            margin: 5px 0;
        }

        .subtitle {
            color: var(--gold);
            font-style: italic;
            font-size: clamp(13px, 3vw, 15px);
            font-weight: 500;
            display: inline-block;
        }

        .subtitle::before,
        .subtitle::after {
            content: '✦';
            margin: 0 8px;
            color: var(--primary);
            opacity: 0.5;
        }

        /* Project Banner */
        .project-info {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            text-align: center;
            font-weight: 600;
            font-size: clamp(11px, 2.5vw, 13px);
            padding: 12px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
        }

        .project-info::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        /* Meta Bar */
        .meta-bar {
            display: flex;
            background: var(--dark);
            padding: 15px 20px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .meta-item {
            flex: 1 1 200px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--white);
            font-weight: 500;
            font-size: 13px;
            background: rgba(255,255,255,0.1);
            padding: 8px 15px;
            border-radius: 50px;
        }

        .meta-lbl {
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.8;
            white-space: nowrap;
        }

        .meta-input {
            flex: 1;
            background: var(--white);
            border: none;
            border-radius: 30px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
            outline: none;
        }

        /* Logo Section */
        .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px 20px;
            gap: 25px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-top: 1px solid rgba(200,148,30,0.2);
            border-bottom: 1px solid rgba(200,148,30,0.2);
            flex-wrap: wrap;
        }

        .amir-logo {
            width: min(200px, 40vw);
            height: auto;
        }

        .church-logo {
            width: min(190px, 38vw);
            height: auto;
        }

        .logo-amp {
            font-size: clamp(28px, 5vw, 36px);
            font-weight: 800;
            color: var(--primary);
            position: relative;
        }

        .logo-amp::before,
        .logo-amp::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 20px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .logo-amp::before { left: -25px; }
        .logo-amp::after { right: -25px; }

        /* ===== FORM SECTION ===== */
        .registration-form {
            padding: 20px;
            background: var(--white);
        }

        /* Field Row */
        .field-row {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            gap: 10px;
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: var(--border-radius-sm);
            transition: all 0.3s;
            border: 1px solid transparent;
            flex-wrap: wrap;
        }

        .field-row:hover {
            border-color: var(--gold-light);
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .fl {
            font-weight: 600;
            font-size: 13px;
            color: var(--dark);
            text-transform: uppercase;
            letter-spacing: 0.3px;
            min-width: 120px;
        }

        .fl.so {
            color: var(--gold);
            margin-left: 5px;
        }

        .fl.gap {
            margin-left: 10px;
        }

        .finput {
            flex: 1;
            border: none;
            border-bottom: 2px solid #ddd;
            padding: 6px 5px;
            font-size: 13px;
            background: transparent;
            outline: none;
            transition: all 0.3s;
            min-width: 120px;
        }

        .finput:focus {
            border-bottom-color: var(--primary);
        }

        .finput[readonly] {
            border-bottom-color: var(--gold-light);
            background: rgba(200,148,30,0.05);
            border-radius: 4px;
            padding: 6px 10px;
        }

        /* CNIC Boxes */
        .cnic-boxes {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            background: white;
            padding: 5px 8px;
            border-radius: 8px;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.05);
            flex-wrap: wrap;
        }

        .cb {
            width: clamp(25px, 4vw, 30px);
            height: clamp(25px, 4vw, 30px);
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            text-align: center;
            font-size: clamp(12px, 3vw, 14px);
            font-weight: 700;
            color: var(--dark);
            background: white;
            outline: none;
        }

        .cb:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(192,57,43,0.1);
        }

        .cb[readonly] {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-color: var(--gold);
        }

        .cd {
            font-size: clamp(15px, 4vw, 18px);
            font-weight: 800;
            color: var(--primary);
            margin: 0 2px;
        }

        .cnic-boxes.sm .cb {
            width: clamp(20px, 3.5vw, 25px);
            height: clamp(20px, 3.5vw, 25px);
            font-size: clamp(10px, 2.5vw, 12px);
        }

        /* ===== PAYMENT SECTION ===== */
        .payment-section {
            border: none;
            margin: 20px 0;
            background: linear-gradient(135deg, #fff5f0 0%, #fff 100%);
            border-radius: var(--border-radius-sm);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(192,57,43,0.1);
        }

        .pay-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pay-table th {
            background: var(--primary);
            color: white;
            font-weight: 600;
            font-size: 13px;
            padding: 10px 12px;
            text-align: left;
            width: 130px;
        }

        .pay-table td {
            padding: 10px 12px;
            font-size: 13px;
            background: white;
            border-bottom: 1px solid #ffe0d4;
        }

        .pay-lines {
            padding: 15px;
        }

        .pay-line-text {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 12px;
            font-size: 13px;
            text-transform: uppercase;
        }

        .pay-inline {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .pay-lbl {
            font-weight: 600;
            color: var(--dark);
            min-width: 100px;
            font-size: 13px;
        }

        .pay-bottom-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .pay-dated {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            flex-wrap: wrap;
        }

        .total-box {
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            padding: 8px 20px;
            border-radius: 40px;
            color: white;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(192,57,43,0.3);
        }

        .total-box input {
            background: white;
            border: none;
            border-radius: 30px;
            padding: 4px 12px;
            width: 70px;
            font-weight: 700;
            color: var(--dark);
        }

        /* ===== ATTACHMENTS ===== */
        .attachments-row {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            border: none;
            flex-wrap: wrap;
        }

        .attach-label {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            font-weight: 600;
            font-size: 13px;
            padding: 20px;
            border-radius: var(--border-radius-sm);
            min-width: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            line-height: 1.5;
            box-shadow: 0 5px 15px rgba(192,57,43,0.2);
            flex: 1 1 160px;
        }

        .attach-boxes {
            display: flex;
            gap: 15px;
            flex: 3 1 300px;
            flex-wrap: wrap;
        }

        .abox {
            flex: 1 1 220px;
            background: #f8f9fa;
            border-radius: var(--border-radius-sm);
            padding: 15px;
            text-align: center;
            border: 2px dashed var(--gold);
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .abox:hover {
            border-color: var(--primary);
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .abox label {
            display: block;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 13px;
        }

        .file-preview {
            flex: 1;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
            border: 1px solid #eee;
            overflow: hidden;
            padding: 8px;
            min-height: 100px;
            word-break: break-word;
        }

        .file-preview img {
            max-width: 100%;
            max-height: 100px;
            object-fit: contain;
        }

        .file-preview embed {
            width: 100%;
            height: 100px;
        }

        /* ===== BOOKING ROW ===== */
        .booking-row {
            display: flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 15px;
            border-radius: var(--border-radius-sm);
            margin: 15px 0 8px;
            flex-wrap: wrap;
        }

        .bk-lbl {
            font-weight: 600;
            color: var(--dark);
            font-size: 13px;
            white-space: nowrap;
        }

        .bk-finput {
            max-width: 120px;
            border: none;
            border-bottom: 2px solid #ddd;
            padding: 5px;
            background: transparent;
            font-size: 13px;
        }

        .mgL {
            margin-left: 5px;
        }

        .office-only {
            text-align: center;
            font-size: 13px;
            font-weight: 700;
            color: var(--primary);
            margin: 15px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
        }

        .office-only::before,
        .office-only::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 80px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .office-only::before { left: 0; }
        .office-only::after { right: 0; }

        /* ===== FOOTER STRIP ===== */
        .footer-strip {
            border: 2px solid var(--primary);
            border-radius: var(--border-radius-sm);
            overflow: hidden;
            margin: 20px 0;
            background: white;
        }

        .footer-header {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 2px solid var(--primary);
            flex-wrap: wrap;
        }

        .fh-gold-box {
            width: 28px;
            height: 28px;
            background: white;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            flex-shrink: 0;
        }

        .fh-title {
            flex: 1;
            font-weight: 700;
            font-size: clamp(12px, 3vw, 14px);
            color: var(--dark);
            text-align: center;
            text-transform: uppercase;
        }

        .fh-white-box {
            width: 120px;
            flex-shrink: 0;
        }

        .fh-white-box input {
            width: 100%;
            border: 2px solid var(--primary);
            border-radius: 30px;
            padding: 5px 12px;
            font-weight: 600;
            text-align: center;
            background: white;
            font-size: 13px;
        }

        .footer-body {
            display: flex;
            background: linear-gradient(135deg, #fff, #fafafa);
            flex-wrap: wrap;
        }

        .footer-fields {
            flex: 2 1 350px;
            padding: 15px;
        }

        .footer-field-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
            flex-wrap: wrap;
        }

        .ffl {
            font-weight: 600;
            font-size: 13px;
            color: var(--dark);
            min-width: 80px;
        }

        .footer-field-row .finput {
            background: white;
            border-radius: 6px;
            padding: 6px 10px;
            border: 1px solid #eee;
            font-size: 13px;
        }

        .footer-right-sidebar {
            display: flex;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-left: 2px solid var(--gold);
            flex: 1 1 130px;
        }

        .verif-col {
            width: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.1);
        }

        .verif-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            color: white;
            font-weight: 700;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .stamp-sign-col {
            flex: 1;
            padding: 15px 8px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .ss-item {
            text-align: center;
        }

        .ss-line {
            width: 100%;
            height: 2px;
            background: white;
            margin: 6px 0;
        }

        .ss-lbl {
            color: white;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
        }

        .note {
            font-size: 11px;
            line-height: 1.6;
            color: #666;
            margin-top: 12px;
            padding: 12px;
            background: #fff9e6;
            border-radius: 8px;
            border-left: 3px solid var(--gold);
        }

        /* ===== CONTACT BAR ===== */
        .contact-bar {
            background: linear-gradient(135deg, var(--dark), #34495e);
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            line-height: 1.8;
            border-radius: var(--border-radius-sm);
            margin-top: 20px;
        }

        .contact-bar strong {
            color: var(--gold);
            font-weight: 700;
        }

        /* ===== RESPONSIVE BREAKPOINTS ===== */
        @media (max-width: 768px) {
            .top-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .district-wrapper {
                width: 100%;
            }

            .reg-fee-ribbon {
                text-align: center;
            }

            .title-area {
                justify-content: center;
                text-align: center;
            }

            .fl {
                min-width: 100%;
            }

            .field-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .finput {
                width: 100%;
            }

            .cnic-boxes {
                width: 100%;
                justify-content: center;
            }

            .pay-bottom-row {
                flex-direction: column;
                align-items: stretch;
            }

            .pay-dated {
                width: 100%;
            }

            .total-box {
                width: 100%;
                justify-content: center;
            }

            .booking-row {
                flex-direction: column;
                align-items: stretch;
            }

            .bk-finput {
                max-width: 100%;
            }

            .footer-header {
                flex-direction: column;
                text-align: center;
            }

            .footer-body {
                flex-direction: column;
            }

            .footer-right-sidebar {
                border-left: none;
                border-top: 2px solid var(--gold);
            }

            .verif-col {
                width: 100%;
                height: 28px;
            }

            .verif-text {
                writing-mode: horizontal-tb;
                transform: none;
            }

            .stamp-sign-col {
                flex-direction: row;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .title {
                font-size: 28px;
            }

            .clc-logo {
                width: 70px;
                height: 70px;
            }

            .meta-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .meta-input {
                width: 100%;
            }

            .pay-table th {
                width: 100px;
                font-size: 12px;
            }

            .pay-table td {
                font-size: 12px;
            }

            .attach-label {
                font-size: 12px;
                padding: 15px;
            }

            .note {
                font-size: 10px;
            }

            .contact-bar {
                font-size: 11px;
            }
        }

        /* Touch-friendly */
        .cb, .finput, .abox, .download-btn {
            touch-action: manipulation;
        }
    </style>

    <div class="body-wrapper">
        <div style="text-align:center;">
            <a href="{{ route('admin.form.download', $application->id) }}"
               class="download-btn">
                📥 Download PDF
            </a>
        </div>

        <div class="form-container">
            <form class="registration-form" method="POST"
                  action="{{ route('user.final-form.store') }}"
                  enctype="multipart/form-data">
                @csrf

                <!-- ===== HEADER ===== -->
                <div class="header">
                    <!-- Top Bar -->
                    <div class="top-bar">
                        <div class="district-wrapper">
                            <span class="district-label">📍 District</span>
                            <input type="text" class="district-input"
                                   name="district"
                                   readonly
                                   value="{{ $user->city }}" />
                        </div>
                        <div class="reg-fee-ribbon">
                            Registration Fee<br><strong>1000 PKR Only</strong>
                        </div>
                    </div>

                    <!-- Title Area -->
                    <div class="title-area">
                        <div class="clc-seal-wrap">
                            <img src="{{ asset('images/logo.PNG') }}" class="clc-logo" alt="Christ Land City Logo" />
                        </div>
                        <div class="title-text">
                            <div class="reg-form-label">Registration Form</div>
                            <h1 class="title">CHRIST LAND CITY</h1>
                            <div class="subtitle">A Gateway of Luxury Living</div>
                        </div>
                    </div>

                    <!-- Project Banner -->
                    <div class="project-info">
                        04 MARLA (1088 Sq Ft) HOUSING PROJECT FOR PAKISTANI HOMELESS CHRISTIAN FAMILIES
                    </div>

                    <!-- Meta Bar -->
                    <div class="meta-bar">
                        <div class="meta-item">
                            <span class="meta-lbl">📋 Reg No.</span>
                            <input type="text" class="meta-input"
                                   name="registration_no"
                                   readonly
                                   value="{{ $application->registration_no }}" />
                        </div>
                        <div class="meta-item">
                            <span class="meta-lbl">🔐 Security Code</span>
                            <input type="text" class="meta-input"
                                   name="security_code"
                                   readonly
                                   value="{{ $application->security_code }}" />
                        </div>
                    </div>

                    <!-- Logo Section -->
                    <div class="logo-section">
                        <div class="logo-left-group">
                            <img src="{{ asset('images/img1.PNG') }}" class="amir-logo" alt="Amir Sultan Get Home Services" />
                        </div>
                        <div class="logo-amp">&</div>
                        <div class="logo-right-group">
                            <img src="{{ asset('images/img2.PNG') }}" class="church-logo" alt="Methodist Church of Pakistan" />
                        </div>
                    </div>
                </div>

                <!-- ===== PERSONAL INFORMATION ===== -->
                <div class="field-row">
                    <span class="fl">👤 Name of Applicant</span>
                    <input type="text" class="finput"
                           name="name"
                           readonly
                           value="{{ $user->name }}" />
                </div>

                <!-- CNIC Row -->
                @php
                    $cnic = preg_replace('/\D/', '', $application->cnic ?? '');
                @endphp

                <div class="field-row">
                    <span class="fl">🆔 Applicant CNIC</span>

                    <div class="cnic-boxes">
                        @for($i = 0; $i < 5; $i++)
                            <input type="text" class="cb" maxlength="1"
                                   value="{{ $cnic[$i] ?? '' }}" readonly />
                        @endfor

                        <span class="cd">-</span>

                        @for($i = 5; $i < 12; $i++)
                            <input type="text" class="cb" maxlength="1"
                                   value="{{ $cnic[$i] ?? '' }}" readonly />
                        @endfor

                        <span class="cd">-</span>

                        <input type="text" class="cb" maxlength="1"
                               value="{{ $cnic[12] ?? '' }}" readonly />
                    </div>

                    <span class="fl so">S/o, D/O, W/O.</span>
                    <input type="text" class="finput"
                           value="{{ $application->guardian_name ?? '' }}" readonly />
                </div>

                <!-- Addresses -->
                <div class="field-row">
                    <span class="fl">📍 Current Mailing Address</span>
                    <input type="text" class="finput"
                           name="current_mailing_address"
                           value="{{ $application->current_mailing_address }}" readonly />
                </div>

                <div class="field-row">
                    <span class="fl">🏠 Permanent Mailing Address</span>
                    <input type="text" class="finput"
                           name="permanent_mailing_address"
                           value="{{ $application->permanent_mailing_address }}" readonly />
                </div>

                <!-- Contact Information -->
                <div class="field-row">
                    <span class="fl">💼 Occupation</span>
                    <input type="text" class="finput"
                           name="occupation"
                           value="{{ $application->occupation }}" readonly />
                    <span class="fl gap">📧 Email</span>
                    <input type="email" class="finput"
                           name="email"
                           readonly
                           value="{{ $user->email }}" />
                </div>

                <div class="field-row">
                    <span class="fl">📞 Official Contact</span>
                    <input type="tel" class="finput"
                           name="official_contact_number"
                           value="{{ $application->official_contact_number }}" readonly />
                    <span class="fl gap">📱 Mobile</span>
                    <input type="tel" class="finput"
                           name="mobile_number"
                           value="{{ $application->mobile_number }}" readonly />
                </div>

                <!-- ===== PAYMENT SECTION ===== -->
                <div class="payment-section">
                    <table class="pay-table">
                        <tr>
                            <th>Payment Method</th>
                            <td colspan="3">Askari Bank Ltd</td>
                        </tr>
                        <tr>
                            <th>Account Title</th>
                            <td colspan="3">Amir Sultan</td>
                        </tr>
                        <tr>
                            <th>Account No</th>
                            <td>3010380 00 25 96</td>
                            <th>Branch Code</th>
                            <td class="branch-val">0301</td>
                        </tr>
                    </table>
                    <div class="pay-lines">
                        <div class="pay-line-text">💳 DD/Pay order/Cross Cheque / Cash Deposit</div>
                        <div class="pay-inline">
                            <span class="pay-lbl">Amount in words:</span>
                            <input type="text" class="finput pay-finput"
                                   name="amount_in_words"
                                   readonly
                                   value="Eleven Thousand Rupees Only" />
                        </div>
                        <div class="pay-bottom-row">
                            <div class="pay-dated">
                                <span class="pay-lbl">📅 Dated:</span>
                                <input type="date" class="finput"
                                       name="payment_date"
                                       value="{{ $application->payment_date }}" readonly />
                            </div>
                            <div class="total-box">
                                <span>Total PKR</span>
                                <input type="text" class="finput short-finput"
                                       name="total_amount"
                                       readonly
                                       value="11000" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== ATTACHMENTS ===== -->
                <div class="attachments-row">
                    <div class="attach-label">
                        📎 Documents Attached
                    </div>
                    <div class="attach-boxes">
                        <div class="abox">
                            <label>📄 CNIC Copy</label>
                            <div class="file-preview">
                                @if($application->cnic_copy)
                                    @php
                                        $cnicFile = asset('storage/' . $application->cnic_copy);
                                        $cnicExt = pathinfo($application->cnic_copy, PATHINFO_EXTENSION);
                                    @endphp

                                    @if(in_array(strtolower($cnicExt), ['jpg','jpeg','png','gif','webp']))
                                        <img src="{{ $cnicFile }}" alt="CNIC" />
                                    @elseif(strtolower($cnicExt) === 'pdf')
                                        <embed src="{{ $cnicFile }}" type="application/pdf" />
                                    @else
                                        <a href="{{ $cnicFile }}" target="_blank">📎 Download File</a>
                                    @endif
                                @else
                                    <span>No file uploaded</span>
                                @endif
                            </div>
                        </div>

                        <div class="abox">
                            <label>💰 Deposit Slip</label>
                            <div class="file-preview">
                                @if($application->deposit_copy)
                                    @php
                                        $depositFile = asset('storage/' . $application->deposit_copy);
                                        $depositExt = pathinfo($application->deposit_copy, PATHINFO_EXTENSION);
                                    @endphp

                                    @if(in_array(strtolower($depositExt), ['jpg','jpeg','png','gif','webp']))
                                        <img src="{{ $depositFile }}" alt="Deposit Slip" />
                                    @elseif(strtolower($depositExt) === 'pdf')
                                        <embed src="{{ $depositFile }}" type="application/pdf" />
                                    @else
                                        <a href="{{ $depositFile }}" target="_blank">📎 Download File</a>
                                    @endif
                                @else
                                    <span>No file uploaded</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== BOOKING ROW ===== -->
                <div class="booking-row">
                    <span class="bk-lbl">📋 Booked By</span>
                    <input type="text" class="finput bk-finput"
                           name="booked_by"
                           value="{{ $application->booked_by }}" readonly />
                    <span class="bk-lbl">📅 Date</span>
                    <input type="date" class="finput bk-finput"
                           name="booking_date"
                           value="{{ $application->booking_date }}" readonly />
                    <span class="bk-lbl">✍️ Signature</span>
                    <input type="text" class="finput bk-finput"
                           name="signature"
                           value="{{ $application->signature }}" readonly />
                </div>
                <div class="office-only">⚡ For Office Use Only ⚡</div>

                <!-- ===== FOOTER STRIP ===== -->
                <div class="footer-strip">
                    <div class="footer-header">
                        <span class="fh-gold-box"></span>
                        <span class="fh-title">04 Marla Home Form</span>
                        <span class="fh-white-box">
                        <input type="text" value="{{ $application->registration_no }}" readonly />
                    </span>
                    </div>

                    <div class="footer-body">
                        <div class="footer-fields">
                            <div class="footer-field-row">
                                <span class="ffl">Name:</span>
                                <input type="text" class="finput" value="{{ $user->name }}" readonly />
                                <span class="ffl">S/O:</span>
                                <input type="text" class="finput" value="{{ $application->guardian_name }}" readonly />
                            </div>

                            <div class="footer-field-row">
                                <span class="ffl">CNIC:</span>
                                <div class="cnic-boxes sm">
                                    @for($i = 0; $i < 5; $i++)
                                        <input type="text" class="cb" value="{{ $cnic[$i] ?? '' }}" readonly />
                                    @endfor
                                    <span class="cd">-</span>
                                    @for($i = 5; $i < 12; $i++)
                                        <input type="text" class="cb" value="{{ $cnic[$i] ?? '' }}" readonly />
                                    @endfor
                                    <span class="cd">-</span>
                                    <input type="text" class="cb" value="{{ $cnic[12] ?? '' }}" readonly />
                                </div>
                            </div>

                            <div class="note">
                                <strong>Note:</strong> Company & The Methodist Church of Pakistan reserve the right to reject your application for providing any wrong information. Company is not responsible for any cash handling with any individual/Employee.
                            </div>
                        </div>

                        <div class="footer-right-sidebar">
                            <div class="verif-col">
                                <span class="verif-text">VERIFICATION</span>
                            </div>
                            <div class="stamp-sign-col">
                                <div class="ss-item">
                                    <div class="ss-line"></div>
                                    <span class="ss-lbl">Stamp</span>
                                </div>
                                <div class="ss-item">
                                    <div class="ss-line"></div>
                                    <span class="ss-lbl">Sign</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== CONTACT BAR ===== -->
                <div class="contact-bar">
                    <div>Raja Javed Plaza, First Floor, Main GT Road, Opp. Gate # 02, DHA Phase 2, Islamabad</div>
                    <div>📞 <strong>+92 330 7778851</strong> | <strong>+92 303 0366668</strong></div>
                    <div>✉️ <strong>amirsultanpak74@gmail.com</strong></div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // CNIC auto-population from hidden field
            const hiddenInput = document.getElementById('cnic_full');
            const cnicValue = hiddenInput ? hiddenInput.value : '';

            if (cnicValue) {
                const boxes = document.querySelectorAll('.cnic-boxes .cb');
                const cleanCnic = cnicValue.replace(/\D/g, '');

                boxes.forEach((box, index) => {
                    if (cleanCnic[index]) {
                        box.value = cleanCnic[index];
                    }
                    box.readOnly = true;
                });
            }
        });
    </script>
@endsection
