@extends('admin.layouts.app')

@section('content')
<style>
    /* ===========================
   BASE
   =========================== */
    * { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --red:    #c0392b;
        --red-dk: #962d22;
        --gold:   #c8941e;
        --gold-lt:#e5c540;
        --tan:    #f5dfa0;
        --dark:   #1e1e1e;
    }

    .body-wrapper {
        font-family: "Arial", sans-serif;
        background: #d8d8d8;
        padding: 20px;
    }

    .form-container {
        background: #fff;
        border: 5px solid var(--dark);
        width: 820px;
        max-width: 98%;
        margin: 0 auto;
        overflow: hidden;
    }

    /* ===========================
       HEADER
       =========================== */
    .header { width: 100%; }

    /* --- Top Bar --- */
    .top-bar {
        display: flex;
        align-items: stretch;
        background: var(--dark);
        min-height: 36px;
        position: relative;
    }
    /* District box sits centered in the dark bar */
    .district-box {
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
        background: #fff;
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 4px 20px 4px 18px;
        height: 100%;
        z-index: 2;
        clip-path: polygon(6% 0, 94% 0, 88% 100%, 12% 100%);
        min-width: 180px;
        justify-content: center;
    }
    .district-label {
        font-weight: 700;
        font-size: 13.5px;
        color: #111;
        white-space: nowrap;
    }
    .district-input {
        border: none;
        border-bottom: 2px solid #333;
        background: transparent;
        outline: none;
        font-size: 13px;
        color: #111;
        padding: 1px 2px;
        width: 80px;
        font-weight: 600;
    }
    /* Left and right ends stay dark */
    .top-mid { flex: 1; }

    .reg-fee-ribbon {
        background: linear-gradient(135deg, var(--gold-lt), var(--gold));
        color: #fff;
        font-weight: 700;
        font-size: 11px;
        text-align: center;
        line-height: 1.4;
        padding: 3px 16px 3px 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        clip-path: polygon(12% 0, 100% 0, 100% 100%, 0% 100%);
        min-width: 155px;
    }

    /* --- Title Area --- */
    .title-area {
        display: flex;
        align-items: center;
        padding: 8px 14px 6px;
        gap: 10px;
    }
    .clc-seal-wrap { flex-shrink: 0; }
    .clc-logo { width: 82px; height: 82px; object-fit: contain; }

    .title-text { flex: 1; text-align: center; }
    .reg-form-label {
        font-size: 12px;
        color: #333;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: none;
    }
    .title {
        color: var(--red);
        font-size: 40px;
        font-weight: 900;
        letter-spacing: 2px;
        line-height: 1.05;
    }
    .subtitle {
        color: var(--gold);
        font-style: italic;
        font-size: 14px;
        font-weight: 700;
    }

    /* --- Project Banner --- */
    .project-info {
        background: var(--red);
        color: #fff;
        text-align: center;
        font-size: 11.5px;
        font-weight: 700;
        padding: 5px 8px;
        letter-spacing: 0.5px;
    }

    /* --- Meta Bar --- */
    .meta-bar {
        display: flex;
        background: var(--dark);
    }
    .meta-item {
        flex: 1;
        color: #fff;
        padding: 5px 14px;
        font-weight: 700;
        font-size: 13px;
        border-right: 1px solid #555;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .meta-item:last-child { border-right: none; }
    .meta-input {
        flex: 1;
        background: #fff;
        border: none;
        outline: none;
        font-size: 12.5px;
        color: #111;
        padding: 2px 6px;
        height: 22px;
        font-weight: 600;
    }

    /* --- Logo Section --- */
    /* img1.PNG already contains "Develop & Marketing by" text, so no extra label needed */
    .logo-section {
        display: flex;
        align-items: center;
        justify-content: center;
        border-top: 2px solid var(--gold);
        border-bottom: 2px solid var(--gold);
        padding: 6px 14px;
        gap: 16px;
        background: #fff;
    }
    .logo-left-group,
    .logo-right-group {
        display: flex;
        align-items: center;
    }
    .amir-logo   { width: 215px; max-width: 100%; height: auto; object-fit: contain; }
    .logo-amp    { font-size: 30px; font-weight: 900; color: var(--dark); flex-shrink: 0; }
    .church-logo { width: 200px; max-width: 100%; height: auto; object-fit: contain; }

    /* ===========================
       FORM — EDITABLE INPUT FIELDS
       =========================== */
    .registration-form {
        padding: 6px 14px 0;
    }

    /* Generic row */
    .field-row {
        display: flex;
        align-items: center;
        margin-bottom: 6px;
        min-height: 24px;
    }

    /* Label text */
    .fl {
        white-space: nowrap;
        font-weight: 700;
        font-size: 12.5px;
        color: #111;
        flex-shrink: 0;
        margin-right: 3px;
    }
    .fl.so  { margin-left: 10px; }
    .fl.gap { margin-left: 16px; }

    /* Editable underline input — replaces span fline */
    .finput {
        flex: 1;
        border: none;
        border-bottom: 1.5px solid #444;
        outline: none;
        background: transparent;
        font-size: 12.5px;
        font-family: inherit;
        color: #111;
        padding: 1px 3px;
        min-width: 30px;
    }
    .finput:focus { border-bottom-color: var(--red); }

    .pay-finput { flex: 1; min-width: 40px; }
    .bk-finput  { max-width: 100px; flex: 1; }
    .short-finput { width: 80px; flex: unset; }

    /* --- CNIC Boxes --- */
    .cnic-boxes {
        display: inline-flex;
        align-items: center;
        gap: 2px;
        flex-shrink: 0;
        margin: 0 2px;
    }
    .cnic-boxes.sm .cb {
        width: 15px;
        height: 15px;
        font-size: 10px;
        padding: 0;
    }
    .cb {
        display: inline-block;
        width: 19px;
        height: 19px;
        border: 1.5px solid #333;
        background: #fff;
        text-align: center;
        font-size: 12px;
        padding: 0;
        outline: none;
        font-family: inherit;
        font-weight: 700;
        color: #111;
    }
    .cb:focus { border-color: var(--red); background: #fff8f8; }
    .cd {
        font-weight: 900;
        font-size: 14px;
        padding: 0 1px;
        line-height: 1;
        color: #222;
    }

    /* ===========================
       PAYMENT SECTION
       =========================== */
    .payment-section {
        border: 2px solid var(--red);
        margin: 8px 0 8px;
    }

    .pay-table { width: 100%; border-collapse: collapse; }
    .pay-table th,
    .pay-table td {
        border: 1px solid var(--red);
        padding: 5px 9px;
        font-size: 12.5px;
        text-align: left;
    }
    .pay-table th {
        background: var(--red);
        color: #fff;
        font-weight: 700;
        width: 130px;
    }
    .pay-table td { background: #fff; }
    .branch-val { width: 55px; }

    .pay-lines { padding: 5px 10px 6px; font-size: 12.5px; }
    .pay-line-text { margin-bottom: 4px; font-weight: 600; }

    .pay-inline {
        display: flex;
        align-items: flex-end;
        gap: 5px;
        margin-bottom: 4px;
    }
    .pay-lbl { font-weight: 700; white-space: nowrap; flex-shrink: 0; }

    .pay-bottom-row {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 10px;
    }
    .pay-dated {
        display: flex;
        align-items: flex-end;
        gap: 5px;
        flex: 1;
        max-width: 200px;
    }
    .total-box {
        display: flex;
        align-items: flex-end;
        gap: 6px;
        border: 2px solid var(--red);
        padding: 3px 8px 3px;
        font-weight: 700;
        font-size: 12px;
        color: var(--red);
        white-space: nowrap;
    }

    /* ===========================
       ATTACHMENTS ROW
       =========================== */
    .attachments-row {
        display: flex;
        align-items: stretch;
        border: 2px solid var(--red);
        margin-bottom: 8px;
    }
    .attach-label {
        background: var(--red);
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        padding: 8px 10px;
        display: flex;
        align-items: center;
        text-align: center;
        min-width: 150px;
        line-height: 1.5;
        flex-shrink: 0;
    }
    .attach-boxes { display: flex; flex: 1; }
    .abox {
        flex: 1;
        border-left: 2px solid var(--red);
        padding: 8px 6px;
        text-align: center;
        font-weight: 700;
        font-size: 11.5px;
        color: var(--red);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #fff;
        gap: 4px;
    }
    .abox label {
        cursor: pointer;
    }
    .f-input-file {
        font-size: 10px;
        width: 100%;
        color: #555;
    }

    /* ===========================
       BOOKING ROW
       =========================== */
    .booking-row {
        display: flex;
        align-items: flex-end;
        gap: 4px;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 2px;
    }
    .bk-lbl { white-space: nowrap; flex-shrink: 0; }
    .bk-line { flex: 1; min-width: 60px; }
    .mgL { margin-left: 12px; }

    .office-only {
        text-align: center;
        font-size: 12px;
        font-weight: 700;
        color: #333;
        margin-bottom: 6px;
        letter-spacing: 0.5px;
    }

    /* ===========================
       FOOTER STRIP
       =========================== */
    .footer-strip {
        border: 2px solid var(--red);
        margin-bottom: 0;
    }

    /* Gold title bar */
    .footer-header {
        background: var(--tan);
        border-bottom: 2px solid var(--red);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 4px 8px;
        gap: 6px;
    }
    .fh-gold-box {
        width: 26px;
        height: 22px;
        background: var(--gold);
        flex-shrink: 0;
        display: inline-block;
        border: 1px solid var(--gold-lt);
    }
    .fh-title {
        font-weight: 700;
        font-size: 13px;
        color: var(--dark);
        flex: 1;
        text-align: center;
    }
    .fh-white-box {
        width: 80px;
        height: 22px;
        background: #fff;
        border: 1.5px solid var(--red);
        flex-shrink: 0;
        display: inline-block;
    }

    /* Footer body: fields on left, verification+stamp on right */
    .footer-body {
        display: flex;
        align-items: stretch;
    }

    .footer-fields {
        flex: 1;
        padding: 6px 10px;
    }

    .footer-field-row {
        display: flex;
        align-items: flex-end;
        gap: 6px;
        margin-bottom: 6px;
        font-size: 12.5px;
    }
    .ffl {
        white-space: nowrap;
        font-weight: 700;
        font-size: 12.5px;
        flex-shrink: 0;
    }
    .ffl.mgL { margin-left: 12px; }

    /* Footer-specific underline — flex child */
    .footer-field-row .fline { min-width: 60px; }

    /* Note */
    .note {
        font-size: 11px;
        line-height: 1.55;
        color: #222;
        margin-top: 5px;
    }

    /* Right sidebar: Verification + Stamp/Sign */
    .footer-right-sidebar {
        display: flex;
        align-items: stretch;
        border-left: 2px solid var(--red);
        flex-shrink: 0;
    }

    /* Vertical "Verification" text column */
    .verif-col {
        width: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-right: 1px solid var(--red);
        background: #fff;
    }
    .verif-text {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        color: var(--dark);
        text-transform: uppercase;
        white-space: nowrap;
    }

    /* Stamp / Sign column */
    .stamp-sign-col {
        width: 80px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        padding: 8px 6px;
        gap: 8px;
    }
    .ss-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3px;
    }
    .ss-line {
        width: 70px;
        border-bottom: 1.5px solid #333;
        display: inline-block;
    }
    .ss-lbl {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--dark);
    }

    /* ===========================
       CONTACT BAR
       =========================== */
    .contact-bar {
        background: #fff;
        color: var(--red);
        text-align: center;
        padding: 8px 14px;
        font-size: 13px;
        line-height: 1.8;
        border-top: 2px solid var(--red);
        font-weight: 600;
    }
    .contact-bar strong { font-weight: 900; }

    /* ===========================
       RESPONSIVE
       =========================== */
    @media (max-width: 680px) {
        .form-container { width: 100%; }
        .title { font-size: 26px; }
        .amir-logo, .church-logo { width: 140px; }
        .clc-logo { width: 58px; height: 58px; }
        .footer-right-sidebar { flex-direction: column; }
        .booking-row { flex-wrap: wrap; }
    }

</style>
<div class="body-wrapper">
<div class="form-container">

    <!-- ===== HEADER ===== -->
    <form class="registration-form" method="POST"
          action="{{ route('user.final-form.store') }}"
          enctype="multipart/form-data">
        @csrf
        <div class="header">
        <!-- Top Bar: District centered, gold ribbon right -->
        <div class="top-bar">
            <div class="district-box">
                <span class="district-label">District</span>
                <input type="text" class="district-input"
                       name="district"
                       readonly
                       value="{{$user->city}}" />
            </div>
            <div class="top-mid"></div>
            <div class="reg-fee-ribbon">Registration Fee<br/>1000 PKR Only</div>
        </div>

        <!-- Title Area -->
        <div class="title-area">
            <div class="clc-seal-wrap">
                <img src="{{ asset('images/logo.PNG') }}" class="clc-logo" alt="Christ Land City Logo" />
            </div>
            <div class="title-text">
                <p class="reg-form-label">Registration Form</p>
                <h1 class="title">CHRIST LAND CITY</h1>
                <p class="subtitle">A Gateway of Luxury Living</p>
            </div>
        </div>

        <!-- Project Info Banner -->
        <div class="project-info">
            04 MARLA (1088 Sq Ft) HOUSING PROJECT FOR PAKISTANI HOMELESS CHRISTIAN FAMILIES
        </div>

        <!-- Registration No. / Security Code Bar -->
        <div class="meta-bar">
            <div class="meta-item">
                <span class="meta-lbl">Registration No.</span>
                <input type="text" class="meta-input"
                       name="registration_no"
                       readonly
                       value="{{ $application->unique_id }}" />
            </div>
            <div class="meta-item">
                <span class="meta-lbl">Security Code</span>
                <input type="text" class="meta-input"
                       name="security_code"
                       readonly

                       value="{{ $application->unique_id }}" />
            </div>
        </div>

        <!-- Logo Row -->
        <div class="logo-section">
            <div class="logo-left-group">
                <img src="{{ asset('images/img1.PNG') }}" class="amir-logo" alt="Amir Sultan Get Home Services" />
            </div>
            <div class="logo-amp">&amp;</div>
            <div class="logo-right-group">
                <img src="{{ asset('images/img2.PNG') }}" class="church-logo" alt="Methodist Church of Pakistan" />
            </div>
        </div>

    </div>
    <!-- /header -->

    <!-- ===== FORM SECTION ===== -->


        <!-- Name of Applicant -->
        <div class="field-row">
            <span class="fl">Name of Applicant</span>
            <input type="text" class="finput"
                    name="name"
                   readonly
                    value="{{ $user->name }}" />
        </div>

        <!-- Applicant CNIC + S/O -->
        @php
            $cnic = preg_replace('/\D/', '', $user->cnic ?? '');
        @endphp

        <div class="field-row">
            <span class="fl">Applicant CNIC</span>
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
                    <input type="hidden" class="finput"
                           name="cnic"
                           value="{{ $user->cnic }}" />
            </div>
            <span class="fl so">S/o, D/O, W/O.</span>
            <input type="text" class="finput"
                   name="guardian_name"
                   value="{{ old('guardian_name') }}" />
        </div>

        <!-- Current Mailing Address -->
        <div class="field-row">
            <span class="fl">Current Mailing Address</span>
            <input type="text" class="finput"
                   name="current_mailing_address"
                   value="{{ old('current_mailing_address') }}" />
        </div>

        <!-- Permanent Mailing Address -->
        <div class="field-row">
            <span class="fl">Permanent Mailing Address</span>
            <input type="text" class="finput"
                   name="permanent_mailing_address"
                   value="{{ old('permanent_mailing_address') }}" />
        </div>

        <!-- Occupation + Email -->
        <div class="field-row">
            <span class="fl">Occupation</span>
            <input type="text" class="finput"
                   name="occupation"
                   value="{{ old('occupation') }}" />
            <span class="fl gap">Email</span>
            <input type="email" class="finput"
                   name="email"
                   readonly
                   value="{{ $user->email }}" />
        </div>

        <!-- Official Contact + Mobile -->
        <div class="field-row">
            <span class="fl">Official Contact Number.</span>
            <input type="tel" class="finput"
                   name="official_contact_number"
                   value="{{ old('official_contact_number') }}" />
            <span class="fl gap">Mobile</span>
            <input type="tel" class="finput"
                   name="mobile_number"
                   value="{{ old('mobile_number') }}" />
        </div>

        <!-- ===== PAYMENT SECTION ===== -->
        <div class="payment-section">
            <table class="pay-table">
                <tr>
                    <th>Payment Method</th>
                    <td colspan="3">Askari Bank Ltd</td>
                </tr>
                <tr>
                    <th>Account Tittle:</th>
                    <td colspan="3">Amir Sultan</td>
                </tr>
                <tr>
                    <th>Account No:</th>
                    <td>3010380 00 25 96</td>
                    <th>Branch Code:</th>
                    <td class="branch-val">0301</td>
                </tr>
            </table>
            <div class="pay-lines">
                <p class="pay-line-text">DD/Pay order/Cross Cheque / Cash Deposit</p>
                <div class="pay-inline">
                    <span class="pay-lbl">Amount in words:</span>
                    <input type="text" class="finput pay-finput"
                           name="amount_in_words"
                           readonly
                           value="Eleven Thousand Rupees Only" />
                </div>
                <div class="pay-bottom-row">
                    <div class="pay-dated">
                        <span class="pay-lbl">Dated:</span>
                        <input type="date" class="finput"
                               name="payment_date"
                               value="{{ old('payment_date') }}" />
                    </div>
                    <div class="total-box">
                        <span>Total Amount PKR</span>
                        <input type="text" class="finput short-finput"
                               name="total_amount"
                               readonly
                               value="11000" />/-
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== ATTACHMENTS ===== -->
        <div class="attachments-row">
            <div class="attach-label">
                Documents to be attached<br />with this form
            </div>
            <div class="attach-boxes">
                <div class="abox">
                    <label for="cnic_copy">Copy of member CNIC</label>
                    <input type="file" id="cnic_copy" name="cnic_copy" class="f-input-file"  required/>
                    <div class="file-preview" style="position:relative;width:100%;height:100px;overflow:hidden;border:1px dashed #ccc;border-radius:4px;margin-top:4px;display:flex;align-items:center;justify-content:center;font-size:12px;color:#555;">
                        Browse File
                    </div>
                </div>
                <div class="abox">
                    <label for="deposit_copy">Copy of deposit slip</label>
                    <input type="file" id="deposit_copy" name="deposit_copy" class="f-input-file" required/>
                    <div class="file-preview" style="position:relative;width:100%;height:100px;overflow:hidden;border:1px dashed #ccc;border-radius:4px;margin-top:4px;display:flex;align-items:center;justify-content:center;font-size:12px;color:#555;">
                        Browse File
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== BOOKING ROW ===== -->
        <div class="booking-row">
            <span class="bk-lbl">Booked By (Code)</span>
            <input type="text" class="finput bk-finput"
                   name="booked_by"
                   value="{{ old('booked_by') }}" />
            <span class="bk-lbl mgL">Date</span>
            <input type="date" class="finput bk-finput"
                   name="booking_date"
                   value="{{ old('booking_date') }}" />
            <span class="bk-lbl mgL">Applicant Signature</span>
            <input type="text" class="finput bk-finput"
                   name="signature"
                   value="{{ old('signature') }}" />
        </div>
        <div class="office-only">For Office Use Only</div>

        <!-- ===== FOOTER STRIP ===== -->
        <div class="footer-strip">

            <!-- Gold Title Bar -->
            <div class="footer-header">
                <span class="fh-gold-box"></span>
                <span class="fh-title">Christ Land City 04 Marla Home Form / Application #</span>
                <input type="text" class="box" value="{{$application->unique_id }}" readonly/>
            </div>

            <!-- Footer body -->
            <div class="footer-body">

                <div class="footer-fields">

                    <div class="footer-field-row">
                        <span class="ffl">Name:</span>
                        <input type="text" class="finput" value="{{$user->name}}" readonly/>
                        <span class="ffl mgL">S/O, D/O, W/O:</span>
                        <input type="text" class="finput" />
                    </div>

                    <div class="footer-field-row">
                        <span class="ffl">Applicant CNIC:</span>
                        @php
                            $cnic = preg_replace('/\D/', '', $user->cnic ?? '');
                        @endphp
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
                    </div>

                    <p class="note">
                        Note: Company &amp; The Methodist Church of Pakistan reserve the right to reject your
                        application for providing any wrong information. Company is not responsible for any
                        cash handling with any individual/Employee
                    </p>
                </div>

                <!-- Right sidebar -->
                <div class="footer-right-sidebar">
                    <div class="verif-col">
                        <span class="verif-text">Verification</span>
                    </div>
                    <div class="stamp-sign-col">
                        <div class="ss-item">
                            <span class="ss-line"></span>
                            <span class="ss-lbl">Stamp</span>
                        </div>
                        <div class="ss-item">
                            <span class="ss-line"></span>
                            <span class="ss-lbl">Sign</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ===== CONTACT BAR ===== -->
        <div class="contact-bar">
            Raja Javed Plaza, First Floor, Main GT Road, Opp. Gate # 02, DHA Phase 2, Islamabad<br />
            Help line # <strong>+92 330 7778851</strong> &nbsp; <strong>+92 303 0366668</strong><br />
            Email: <strong>amirsultanpak74@gmail.com</strong>
        </div>
        <div style="text-align:center; margin:20px 0;">
            <button type="submit"
                    style="
                background:#c0392b;
                color:#fff;
                padding:10px 30px;
                border:none;
                font-weight:700;
                cursor:pointer;
                font-size:14px;
            ">
                Submit
            </button>
        </div>
    </form>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // find all CNIC boxes (supports multiple forms)
        document.querySelectorAll('.cnic-boxes[data-cnic="true"]').forEach(cnicContainer => {
            const cnicBoxes = cnicContainer.querySelectorAll('.cb');
            const cnicHidden = cnicContainer.querySelector('.cnic-hidden');
            const form = cnicContainer.closest('form');

            // Auto-advance + backspace
            cnicBoxes.forEach((box, i) => {
                box.addEventListener('input', () => {
                    if (box.value.length === 1 && i + 1 < cnicBoxes.length) {
                        cnicBoxes[i + 1].focus();
                    }
                });
                box.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && box.value === '' && i > 0) {
                        cnicBoxes[i - 1].focus();
                    }
                });
            });

            // Populate hidden CNIC before form submission
            if(form){
                form.addEventListener('submit', () => {
                    let cnic = '';
                    cnicBoxes.forEach(box => cnic += box.value.trim());
                    cnicHidden.value = cnic;
                });
            }
        });
    });
        document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.f-input-file').forEach(input => {
            const previewDiv = input.closest('.abox').querySelector('.file-preview');

            // hide default input
            input.style.position = 'absolute';
            input.style.width = '1px';
            input.style.height = '1px';
            input.style.opacity = 0;
            input.style.zIndex = -1;

            // click on preview div triggers file input
            previewDiv.addEventListener('click', () => input.click());

            input.addEventListener('change', function () {
                previewDiv.innerHTML = ''; // clear previous

                const file = this.files[0];
                if (!file) {
                    previewDiv.textContent = 'Browse File';
                    return;
                }

                // if image, show thumbnail
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.style.maxWidth = '100%';
                    img.style.maxHeight = '100%';
                    img.style.objectFit = 'contain';
                    previewDiv.appendChild(img);
                } else {
                    // else show filename
                    const fileName = document.createElement('div');
                    fileName.textContent = file.name;
                    fileName.style.fontSize = '12px';
                    fileName.style.fontWeight = '600';
                    fileName.style.textAlign = 'center';
                    fileName.style.wordBreak = 'break-word';
                    previewDiv.appendChild(fileName);
                }
            });
        });
    });
</script>
@endsection
