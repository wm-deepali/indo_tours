<form method="POST" action="{{ route('admin.settings.smtp') }}">
    @csrf
    <div class="settings-layout">

        <div class="settings-sidenav">
            <span class="settings-sidenav-label">Sections</span>
            <a href="#smtp-config" class="active"><i class="fa-solid fa-server"></i> SMTP Config</a>
            <a href="#smtp-sender"><i class="fa-solid fa-user"></i> Sender Details</a>
            <a href="#smtp-templates"><i class="fa-solid fa-envelope-open-text"></i> Email Events</a>
        </div>

        <div class="settings-content">

            <div class="info-banner blue">
                <i class="fa-solid fa-circle-info"></i>
                <div>Configure your SMTP credentials to send enquiry notifications, OTPs, and admin alerts through your
                    own mail server.</div>
            </div>

            <!-- SMTP Config -->
            <div class="settings-section" id="smtp-config">
                <div class="settings-section-title"><i class="fa-solid fa-server"></i> SMTP Configuration</div>
                <p class="settings-section-desc">Enter your mail server credentials. Works with Gmail, Mailgun,
                    SendGrid,
                    and any SMTP provider.</p>

                <div class="form-grid">

                    <div class="field-group">
                        <label class="field-label">SMTP Host <span class="req">*</span></label>
                        <input type="text" name="smtp_host" class="field-input"
                            value="{{ old('smtp_host', $smtp->smtp_host ?? '') }}" placeholder="smtp.gmail.com">
                    </div>
                    <div class="field-group">
                        <label class="field-label">SMTP Port <span class="req">*</span></label>
                        <select class="field-select" name="smtp_port">
                            <option value="465" {{ old('smtp_port', $smtp->smtp_port ?? '') == '465' ? 'selected' : '' }}>
                                465
                                (SSL)</option>
                            <option value="587" {{ old('smtp_port', $smtp->smtp_port ?? '587') == '587' ? 'selected' : '' }}>
                                587 (TLS)</option>
                            <option value="25" {{ old('smtp_port', $smtp->smtp_port ?? '') == '25' ? 'selected' : '' }}>25
                            </option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">SMTP Username <span class="req">*</span></label>
                        <input type="email" name="smtp_username" class="field-input"
                            value="{{ old('smtp_username', $smtp->smtp_username ?? '') }}">
                    </div>
                    <div class="field-group">
                        <label class="field-label">SMTP Password <span class="req">*</span></label>
                        <div class="input-wrap">
                            <input type="password" name="smtp_password" class="field-input" id="smtpPass"
                                value="{{ old('smtp_password', $smtp->smtp_password ?? '') }}">
                            <button type="button" onclick="togglePass('smtpPass', this)"
                                style="border:1px solid var(--border);border-left:none;border-radius:0 var(--radius-sm) var(--radius-sm) 0;background:var(--bg);padding:0 12px;cursor:pointer;color:var(--text-hint);flex-shrink:0"><i
                                    class="fa fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Encryption</label>
                        <select class="field-select" name="smtp_encryption">
                            <option value="tls" {{ old('smtp_encryption', $smtp->smtp_encryption ?? 'tls') == 'tls' ? 'selected' : '' }}>TLS</option>
                            <option value="ssl" {{ old('smtp_encryption', $smtp->smtp_encryption ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                            <option value="none" {{ old('smtp_encryption', $smtp->smtp_encryption ?? '') == 'none' ? 'selected' : '' }}>None</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr class="section-divider">

            <!-- Sender Details -->
            <div class="settings-section" id="smtp-sender">
                <div class="settings-section-title"><i class="fa-solid fa-user"></i> Sender Details</div>
                <p class="settings-section-desc">The name and address your customers see in their inbox.</p>

                <div class="form-grid">
                    <div class="field-group">
                        <label class="field-label">From Name</label>
                        <input type="text" name="from_name" class="field-input"
                            value="{{ old('from_name', $smtp->from_name ?? '') }}">
                    </div>
                    <div class="field-group">
                        <label class="field-label">From Email</label>
                        <input type="email" name="from_email" class="field-input"
                            value="{{ old('from_email', $smtp->from_email ?? '') }}">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Reply-To Name</label>
                        <input type="text" name="reply_to_name" class="field-input"
                            value="{{ old('reply_to_name', $smtp->reply_to_name ?? '') }}">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Reply-To Email</label>
                        <input type="email" name="reply_to_email" class="field-input"
                            value="{{ old('reply_to_email', $smtp->reply_to_email ?? '') }}">
                    </div>
                </div>
            </div>

            <hr class="section-divider">

            <!-- Email Events -->
            <div class="settings-section" id="smtp-templates">
                <div class="settings-section-title"><i class="fa-solid fa-envelope-open-text"></i> Email Notification
                    Events
                </div>
                <p class="settings-section-desc">Choose which events trigger an email to the admin.</p>

                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Package Enquiry Alert (Admin)</div>
                        <div class="toggle-info-sub">Notify admin when a customer submits a package enquiry.</div>
                    </div>
                    <label class="toggle-switch"><input type="checkbox" name="package_enquiry_alert" value="1" {{ old('package_enquiry_alert', $smtp->package_enquiry_alert ?? 1) ? 'checked' : '' }}><span
                            class="toggle-track"></span></label>
                </div>
                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Callback Request Alert (Admin)</div>
                        <div class="toggle-info-sub">Notify admin when a customer requests a callback.</div>
                    </div>
                    <label class="toggle-switch"><input type="checkbox" name="callback_request_alert" value="1" {{ old('callback_request_alert', $smtp->callback_request_alert ?? 1) ? 'checked' : '' }}><span
                            class="toggle-track"></span></label>
                </div>
                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">General Inquiry Alert (Admin)</div>
                        <div class="toggle-info-sub">Notify admin on general inquiry submissions.</div>
                    </div>
                    <label class="toggle-switch"><input type="checkbox" name="general_inquiry_alert" value="1" {{ old('general_inquiry_alert', $smtp->general_inquiry_alert ?? 1) ? 'checked' : '' }}><span
                            class="toggle-track"></span></label>
                </div>

                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Popup Inquiry Alert (Admin)</div>
                        <div class="toggle-info-sub">Notify admin when a popup inquiry form is submitted.</div>
                    </div>
                    <label class="toggle-switch"><input type="checkbox" name="popup_inquiry_alert" value="1" {{ old('popup_inquiry_alert', $smtp->popup_inquiry_alert ?? 1) ? 'checked' : '' }}><span
                            class="toggle-track"></span></label>
                </div>
                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Contact Us Alert (Admin)</div>
                        <div class="toggle-info-sub">Notify admin when the Contact Us form is submitted.</div>
                    </div>
                    <label class="toggle-switch"><input type="checkbox" name="contact_us_alert" value="1" {{ old('contact_us_alert', $smtp->contact_us_alert ?? 1) ? 'checked' : '' }}><span
                            class="toggle-track"></span></label>
                </div>
                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Password Reset</div>
                        <div class="toggle-info-sub">Send password reset link email to users.</div>
                    </div>
                    <label class="toggle-switch"><input type="checkbox" name="password_reset" value="1" {{ old('password_reset', $smtp->password_reset ?? 1) ? 'checked' : '' }}>
                        <span class="toggle-track"></span></label>
                </div>
            </div>

        </div>
    </div>

    <div class="action-bar">
        <button class="btn-secondary-dash">Discard Changes</button>
        <button class="btn-primary-dash" type="submit">
            <i class="fa fa-save"></i> Save SMTP Settings
        </button>
    </div>

</form>