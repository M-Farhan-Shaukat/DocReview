@extends('user.layouts.app')

@section('content')
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --red: #c0392b;
            --red-dk: #962d22;
            --gold: #c8941e;
            --gold-lt: #e5c540;
            --tan: #f5dfa0;
            --dark: #1e1e1e;
            --gray-bg: #d8d8d8;
        }

        body { background: var(--gray-bg); font-family: Arial, Helvetica, sans-serif; }

        .form-container {
            background: white;
            border: 4px solid var(--dark);
            width: 850px;
            max-width: 98%;
            margin: 25px auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        /* Top Bar */
        .top-bar {
            background: var(--dark);
            height: 38px;
            position: relative;
            display: flex;
            align-items: center;
        }
        .district-box {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            padding: 4px 18px;
            font-weight: bold;
            font-size: 13.5px;
            border: 1px solid #aaa;
            clip-path: polygon(8% 0%, 92% 0%, 100% 50%, 92% 100%, 8% 100%, 0% 50%);
        }
        .district-box input {
            border: none;
            border-bottom: 2px dotted #333;
            width: 90px;
            text-align: center;
            font-weight: bold;
            background: transparent;
        }
        .reg-fee-ribbon {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--gold-lt), var(--gold));
            color: white;
            font-weight: bold;
            font-size: 11px;
            padding: 4px 20px 4px 35px;
            display: flex;
            align-items: center;
            clip-path: polygon(20% 0, 100% 0, 100% 100%, 0 100%);
        }

        /* Title Area */
        .title-area {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            gap: 15px;
        }
        .clc-logo { width: 90px; height: 90px; }
        .title-text { text-align: center; flex: 1; }
        .reg-form-label { font-size: 13px; color: #444; font-weight: bold; }
        .title { color: var(--red); font-size: 38px; font-weight: 900; letter-spacing: 1.5px; margin: 4px 0; }
        .subtitle { color: var(--gold); font-size: 15px; font-weight: bold; font-style: italic; }

        .project-info {
            background: var(--red);
            color: white;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            padding: 6px;
        }

        /* Meta Bar (Reg No & Security) */
        .meta-bar {
            background: var(--dark);
            display: flex;
            color: white;
            font-weight: bold;
            font-size: 13.5px;
        }
        .meta-item {
            flex: 1;
            padding: 8px 15px;
            border-right: 2px solid #444;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .meta-item:last-child { border-right: none; }
        .meta-input {
            flex: 1;
            background: white;
            border: none;
            padding: 4px 8px;
            font-weight: bold;
            font-size: 13px;
        }

        /* Logos */
        .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            gap: 25px;
            border-top: 3px solid var(--gold);
            border-bottom: 3px solid var(--gold);
        }
        .amir-logo { width: 240px; height: auto; }
        .amp { font-size: 42px; font-weight: 900; color: var(--dark); }
        .church-logo { width: 220px; height: auto; }

        /* Form Fields */
        .registration-form { padding: 15px 20px; }
        .field-row {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-size: 13px;
        }
        .fl { font-weight: bold; white-space: nowrap; margin-right: 6px; flex-shrink: 0; }
        .finput {
            flex: 1;
            border: none;
            border-bottom: 2px dotted #333;
            background: transparent;
            padding: 3px 4px;
            font-size: 13px;
            min-width: 50px;
        }
        .finput:focus { border-bottom: 2px solid var(--red); outline: none; }

        .cnic-boxes { display: flex; gap: 3px; align-items: center; }
        .cb {
            width: 22px;
            height: 24px;
            border: 1.5px solid #333;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }
        .cd { font-weight: bold; font-size: 16px; padding: 0 4px; }

        /* Payment */
        .payment-section {
            border: 3px solid var(--red);
            margin: 12px 0;
            padding: 0;
        }
        .pay-table {
            width: 100%;
            border-collapse: collapse;
        }
        .pay-table th, .pay-table td {
            border: 1px solid var(--red);
            padding: 6px 10px;
            font-size: 13px;
        }
        .pay-table th {
            background: var(--red);
            color: white;
            font-weight: bold;
            width: 140px;
        }
        .pay-lines { padding: 8px 12px; }
        .pay-inline { display: flex; align-items: center; gap: 8px; margin: 6px 0; }
        .total-box {
            border: 3px solid var(--red);
            padding: 6px 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: bold;
            color: var(--red);
        }

        /* Attachments */
        .attachments-row {
            display: flex;
            border: 3px solid var(--red);
            margin: 12px 0;
        }
        .attach-label {
            background: var(--red);
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            width: 180px;
            text-align: center;
            display: flex;
            align-items: center;
        }
        .attach-boxes { flex: 1; display: flex; }
        .abox {
            flex: 1;
            border-left: 3px solid var(--red);
            padding: 12px;
            text-align: center;
            background: white;
        }
        .f-input-file { width: 100%; margin-top: 6px; font-size: 12px; }

        /* Booking */
        .booking-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: bold;
            margin: 12px 0;
        }

        /* Footer */
        .footer-strip { border: 3px solid var(--red); }
        .footer-header {
            background: var(--tan);
            border-bottom: 3px solid var(--red);
            padding: 6px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
        }
        .fh-gold-box { width: 30px; height: 24px; background: var(--gold); border: 2px solid var(--gold-lt); }
        .fh-title { flex: 1; text-align: center; font-size: 14px; }
        .footer-body { display: flex; }
        .footer-fields { flex: 1; padding: 10px; }
        .footer-right-sidebar {
            width: 140px;
            border-left: 3px solid var(--red);
            display: flex;
        }
        .verif-col {
            width: 30px;
            background: white;
            writing-mode: vertical-rl;
            text-orientation: mixed;
            transform: rotate(180deg);
            font-weight: bold;
            font-size: 11px;
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stamp-sign-col { flex: 1; padding: 10px; display: flex; flex-direction: column; gap: 20px; }
        .ss-item { text-align: center; }
        .ss-line { width: 100%; border-bottom: 2px solid #333; height: 20px; }

        .note { font-size: 11.5px; margin-top: 8px; line-height: 1.4; }

        .contact-bar {
            background: white;
            color: var(--red);
            text-align: center;
            padding: 12px;
            font-size: 13.5px;
            font-weight: bold;
            border-top: 3px solid var(--red);
        }

        @media (max-width: 768px) {
            .form-container { width: 100%; }
            .title { font-size: 28px; }
            .logo-section { flex-wrap: wrap; gap: 10px; }
            .footer-body { flex-direction: column; }
            .footer-right-sidebar { width: 100%; border-left: none; border-top: 3px solid var(--red); }
            .verif-col { writing-mode: horizontal-tb; transform: none; height: 30px; width: auto; }
        }
    </style>

    <div class="form-container">
        <form method="POST" action="{{ route('user.final-form.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Top Bar -->
            <div class="top-bar">
                <div class="district-box">
                    District: <input type="text" name="district" value="{{ $user->city }}" readonly>
                </div>
                <div class="reg-fee-ribbon">Registration Fee<br>1000 PKR Only</div>
            </div>

            <!-- Title Area -->
            <div class="title-area">
                <img src="{{ asset('images/logo.PNG') }}" class="clc-logo" alt="CLC Logo">
                <div class="title-text">
                    <div class="reg-form-label">Registration Form</div>
                    <div class="title">CHRIST LAND CITY</div>
                    <div class="subtitle">A Gateway of Luxury Living</div>
                </div>
            </div>

            <div class="project-info">
                04 MARLA (1088 Sq Ft) HOUSING PROJECT FOR PAKISTANI HOMELESS CHRISTIAN FAMILIES
            </div>

            <!-- Meta Bar -->
            <div class="meta-bar">
                <div class="meta-item">
                    Registration No. <input type="text" class="meta-input" name="registration_no" value="{{ $application->unique_id }}" readonly>
                </div>
                <div class="meta-item">
                    Security Code <input type="text" class="meta-input" name="security_code" value="{{ $application->unique_id }}" readonly>
                </div>
            </div>

            <!-- Logos -->
            <div class="logo-section">
                <img src="{{ asset('images/img1.PNG') }}" class="amir-logo" alt="Amir Sultan">
                <div class="amp">&</div>
                <img src="{{ asset('images/img2.PNG') }}" class="church-logo" alt="Methodist Church">
            </div>

            <!-- Form Fields (same as your code, just spacing adjusted) -->
            <div class="registration-form">
                <div class="field-row">
                    <span class="fl">Name of Applicant</span>
                    <input type="text" class="finput" name="name" value="{{ $user->name }}" readonly>
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

@endsection
