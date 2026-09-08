<form action="{{ route('admin.settings.sms') }}" method="POST">
    @csrf
    @method('POST')

    <div class="settings-layout">

        <!-- Section nav -->
        <div class="settings-sidenav">
            <span class="settings-sidenav-label">Sections</span>
            <a href="#sms-credentials" class="active"><i class="fa-solid fa-key"></i> API Credentials</a>
            <a href="#sms-sender"><i class="fa-solid fa-id-badge"></i> Sender ID</a>
            <a href="#sms-notifications"><i class="fa-solid fa-bell"></i> Notifications</a>
        </div>

        <!-- Content -->
        <div class="settings-content">

            @if ($errors->any())
                <div class="info-banner" style="background:#fff0f0;border-color:#f5c6cb;margin-bottom:20px">
                    <i class="fa-solid fa-circle-xmark" style="color:#dc3545"></i>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin:6px 0 0;padding-left:18px">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="info-banner" style="background:#f0fff4;border-color:#b7ebc8;margin-bottom:20px">
                    <i class="fa-solid fa-circle-check" style="color:#28a745"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <!-- ── API Credentials (MSG91) ── -->
            <div class="settings-section" id="sms-credentials">
                <div class="settings-section-title">
                    <i class="fa-solid fa-key"></i> API Credentials
                </div>
                <p class="settings-section-desc">
                    Enter your MSG91 credentials. Stored encrypted and never exposed in logs.
                </p>

                <div class="info-banner blue" style="margin-bottom:20px">
                    <i class="fa-solid fa-circle-info"></i>
                    <div>
                        <strong>MSG91</strong> — Find your Auth Key in the
                        <a href="https://msg91.com/in/signup" target="_blank" style="color:#0069d9;font-weight:600">MSG91 Dashboard</a>
                        under API &rarr; Auth Key.
                    </div>
                </div>

                <div class="form-grid">
                    <div class="field-group col-full">
                        <label class="field-label">Auth Key <span class="req">*</span></label>
                        <div style="position:relative">
                            <input type="password" id="msg91AuthKey" name="msg91_auth_key"
                                class="field-input monospace @error('msg91_auth_key') is-invalid @enderror"
                                value="{{ old('msg91_auth_key', $sms_settings?->msg91_auth_key) }}"
                                placeholder="{{ $sms_settings?->msg91_auth_key ? $sms_settings?->msg91_auth_key : '••••••••••••••••••••••••••••' }}">
                            <button type="button" onclick="togglePass('msg91AuthKey', this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-hint)"><i class="fa fa-eye"></i></button>
                        </div>
                        @error('msg91_auth_key')
                            <span class="field-hint" style="color:#dc3545">{{ $message }}</span>
                        @else
                            <span class="field-hint">Your MSG91 authentication key from the dashboard.</span>
                        @enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Route</label>
                        <select name="msg91_route" class="field-select">
                            <option value="4" {{ old('msg91_route', $sms_settings?->msg91_route) == 4 ? 'selected' : '' }}>Transactional (Route 4)</option>
                            <option value="1" {{ old('msg91_route', $sms_settings?->msg91_route) == 1 ? 'selected' : '' }}>Promotional (Route 1)</option>
                        </select>
                        <span class="field-hint">Use Transactional for OTP/enquiry SMS.</span>
                    </div>
                    <div class="field-group">
                        <label class="field-label">DLT Entity ID</label>
                        <input type="text" name="msg91_dlt_entity_id"
                            class="field-input monospace @error('msg91_dlt_entity_id') is-invalid @enderror"
                            placeholder="DLT-registered Entity ID"
                            value="{{ old('msg91_dlt_entity_id', $sms_settings?->msg91_dlt_entity_id) }}">
                        @error('msg91_dlt_entity_id')
                            <span class="field-hint" style="color:#dc3545">{{ $message }}</span>
                        @else
                            <span class="field-hint">Required for India. Register on TRAI DLT portal.</span>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="section-divider">

            <!-- ── Sender ID ── -->
            <div class="settings-section" id="sms-sender">
                <div class="settings-section-title">
                    <i class="fa-solid fa-id-badge"></i> Sender ID / From Name
                </div>
                <p class="settings-section-desc">
                    Configure the sender name shown to customers. This must match your DLT registration in India.
                </p>

                <div class="form-grid">
                    <div class="field-group">
                        <label class="field-label">Sender ID / Name <span class="req">*</span></label>
                        <input type="text" name="sender_id"
                            class="field-input @error('sender_id') is-invalid @enderror"
                            placeholder="INDOTR"
                            maxlength="11"
                            value="{{ old('sender_id', $sms_settings?->sender_id) }}">
                        @error('sender_id')
                            <span class="field-hint" style="color:#dc3545">{{ $message }}</span>
                        @else
                            <span class="field-hint">Max 11 characters (alphanumeric). Must be registered with your telecom operator in India.</span>
                        @enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Country Code Default</label>
                        <div class="input-wrap">
                            <span class="input-prefix">+</span>
                            <input type="text" name="default_country_code"
                                class="field-input @error('default_country_code') is-invalid @enderror"
                                placeholder="91"
                                value="{{ old('default_country_code', $sms_settings?->default_country_code ?? '91') }}">
                        </div>
                        @error('default_country_code')
                            <span class="field-hint" style="color:#dc3545">{{ $message }}</span>
                        @else
                            <span class="field-hint">Prepended to numbers that don't already include a country code.</span>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="section-divider">

            <!-- ── Notification Toggles ── -->
            <div class="settings-section" id="sms-notifications">
                <div class="settings-section-title">
                    <i class="fa-solid fa-bell"></i> Notification Events
                </div>
                <p class="settings-section-desc">
                    Choose which events trigger an SMS. The master switch must be on for any SMS to send.
                </p>

                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Enable SMS Notifications</div>
                        <div class="toggle-info-sub">Master switch — turns all SMS messaging on or off.</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="enabled" id="smsMasterToggle"
                            onchange="toggleSmsNotifs(this)"
                            {{ old('enabled', $sms_settings?->enabled) ? 'checked' : '' }}>
                        <span class="toggle-track"></span>
                    </label>
                </div>

                @php
                    $notifEvents = [
                        'notify_otp' => [
                            'OTP / Verification',
                            'Send OTP SMS for login, registration and verification.',
                        ],
                        'notify_package_enquiry' => [
                            'Package Enquiry',
                            'Send SMS to admin when a package enquiry is submitted.',
                        ],
                        'notify_callback_request' => [
                            'Callback Request',
                            'Send SMS to admin when a customer requests a callback.',
                        ],
                        'notify_general_inquiry' => [
                            'General Inquiry',
                            'Send SMS to admin on general inquiry submissions.',
                        ],
                        'notify_popup_inquiry' => [
                            'Popup Inquiry',
                            'Send SMS to admin when a popup inquiry form is submitted.',
                        ],
                    ];
                @endphp

                <div id="sms-notif-rows" style="opacity:{{ old('enabled', $sms_settings?->enabled) ? '1' : '0.4' }};pointer-events:{{ old('enabled', $sms_settings?->enabled) ? 'auto' : 'none' }};transition:opacity .2s">

                    @foreach($notifEvents as $name => [$label, $desc])
                    <div class="toggle-row">
                        <div>
                            <div class="toggle-info-label">{{ $label }}</div>
                            <div class="toggle-info-sub">{{ $desc }}</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="{{ $name }}"
                                {{ old($name, $sms_settings?->{$name}) ? 'checked' : '' }}>
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                    @endforeach

                </div>
            </div>

        </div><!-- /settings-content -->
    </div><!-- /settings-layout -->

    <div class="action-bar">
        <button type="button" class="btn-test" onclick="testSms()">
            <i class="fa fa-paper-plane"></i> Send Test SMS
        </button>
        <button type="button" class="btn-secondary-dash" onclick="window.location.reload()">Discard Changes</button>
        <button type="submit" class="btn-primary-dash">
            <i class="fa fa-save"></i> Save SMS Settings
        </button>
    </div>

</form>

<script>
// ── Master toggle ────────────────────────────────────────────────────────────
function toggleSmsNotifs(checkbox) {
    const rows = document.getElementById('sms-notif-rows');
    rows.style.opacity      = checkbox.checked ? '1'    : '0.4';
    rows.style.pointerEvents = checkbox.checked ? 'auto' : 'none';
}

// ── Show/hide password ───────────────────────────────────────────────────────
function togglePass(id, btn) {
    const input = document.getElementById(id);
    const isText = input.type === 'text';
    input.type = isText ? 'password' : 'text';
    btn.querySelector('i').className = isText ? 'fa fa-eye' : 'fa fa-eye-slash';
}

// ── Test SMS (AJAX) ──────────────────────────────────────────────────────────
function testSms() {
    Swal.fire({
        title: 'Send Test SMS',
        input: 'text',
        inputLabel: 'Enter mobile number (with country code)',
        inputPlaceholder: '+91 98765 43210',
        showCancelButton: true,
        confirmButtonColor: '#303d89',
        confirmButtonText: 'Send',
    }).then(result => {
        if (!result.isConfirmed || !result.value) return;

        Swal.fire({ title: 'Sending…', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        fetch('{{ route('admin.settings.sms.test') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ mobile: result.value })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Test SMS Sent!',
                    text: data.message,
                    timer: 2500,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({ icon: 'error', title: 'Failed', text: data.message, confirmButtonColor: '#303d89' });
            }
        })
        .catch(() => {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong. Please try again.', confirmButtonColor: '#303d89' });
        });
    });
}
</script>